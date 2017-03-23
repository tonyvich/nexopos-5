<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait registers
{
    /**
     *  register Get
     *  @param int register id
     *  @return json
    **/

    public function registers_get( $id = null )
    {
        if( $id == null ) {

            $this->db->select( '
                aauth_users.name        as author_name,
                nexopos_registers.id as id,
                nexopos_registers.name as name,
                nexopos_registers.description as description,
                nexopos_registers.authorized_users as authorized_users,
                nexopos_registers.status as status,
                nexopos_registers.used_by as used_by,
                nexopos_registers.author as author,
                nexopos_registers.date_creation as date_creation,
                nexopos_registers.date_modification as date_modification
            ' );

            $this->db->from( 'nexopos_registers' );

            // Exclude
            if( $this->get( 'exclude' ) ) {
                $this->db->where( 'nexopos_registers.id !=', $this->get( 'exclude' ) );
            }

            // Order Request
            if( $this->get( 'order_by' ) ) {
                $this->db->order_by( $this->get( 'order_by' ), $this->get( 'order_type' ) );
            }

            if( $this->get( 'limit' ) ) {
                $this->db->limit( $this->get( 'limit' ), $this->get( 'current_page' ) );
            }

            // Search
            if( $this->get( 'search' ) ) {
                $this->db->like( 'aauth_users.name', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_registers.id', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_registers.name', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_registers.description', $this->get( 'search' ) );
            }

            $this->db->join( 'aauth_users', 'aauth_users.id = nexopos_registers.author' );

            $query      =   $this->db->get();

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_registers' )->num_rows()
            ], 200 );
        }

        $result     =   $this->db->where( 'id', $id )->get( 'nexopos_registers' )->result();

        return $result ? $this->response( ( array ) @$result[0], 200 ) : $this->__404();
    }

    /**
     *  register POST
     *  @return json
    **/

    public function registers_post()
    {
        if( $this->db->where( 'name', $this->post( 'name' ) )->get( 'nexopos_registers' )->num_rows() ) {
            $this->__alreadyExists();
        }

        $this->db->insert( 'nexopos_registers', [
            'name'                  =>  $this->post( 'name' ),
            'description'           =>  $this->post( 'description' ),
            'author'                =>  $this->post( 'author' ),
            'authorized_users'      =>  $this->post( 'authorized_users' ),
            'date_creation'         =>  $this->post( 'date_creation' ),
            'status'                =>  $this->post( 'status' )
        ]);

        $this->__success();
    }

    public function registers_delete()
    {
        if( is_array( $_GET[ 'ids' ] ) ) {
            foreach( $_GET[ 'ids' ] as $id ) {
                $this->db->where( 'id', ( int ) $id )->delete( 'nexopos_registers' );
            }
            return $this->__success();
        }
        return $this->__failed();
    }

    /**
     *  Categorie Update
     *  @param int register id
     *  @return json
    **/

    public function registers_put( $id )
    {
        $alreadyExists      =   $this->db->where( 'name', $this->put( 'name' ) )
        ->where( 'id !=', $id )
        ->get( 'nexopos_registers' )
        ->num_rows();

        if( $alreadyExists ) {
            $this->__alreadyExists();
        }

        $this->db->where( 'id', $id )->update( 'nexopos_registers', [
            'name'                  =>  $this->put( 'name' ),
            'description'           =>  $this->put( 'description' ),
            'author'                =>  $this->put( 'author' ),
            'authorized_users'      =>  $this->put( 'authorized_users' ),
            'status'                =>  $this->put( 'status' ),
            'date_modification'     =>  $this->put( 'date_modification' )
        ]);

        $this->__success();
    }


}
