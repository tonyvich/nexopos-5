<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait stores
{
    /**
     *  store Get
     *  @param int store id
     *  @return json
    **/

    public function stores_get( $id = null )
    {
        if( $id == null ) {

            $this->db->select( '
                aauth_users.name        as author_name,
                nexopos_stores.id as id,
                nexopos_stores.name as name,
                nexopos_stores.description as description,
                nexopos_stores.image as image,
                nexopos_stores.authorized_users as authorized_users,
                nexopos_stores.status as status,
                nexopos_stores.author as author,
                nexopos_stores.date_creation as date_creation,
                nexopos_stores.date_modification as date_modification
            ' );

            $this->db->from( 'nexopos_stores' );

            // Exclude
            if( $this->get( 'exclude' ) ) {
                $this->db->where( 'nexopos_stores.id !=', $this->get( 'exclude' ) );
            }

            // Order Request
            if( $this->get( 'order_by' ) ) {
                $this->db->order_by( $this->get( 'order_by' ), $this->get( 'order_type' ) );
            }

            if( $this->get( 'limit' ) ) {
                $this->db->limit( $this->get( 'limit' ), $this->get( 'current_page' ) );
            }

            $this->db->join( 'aauth_users', 'aauth_users.id = nexopos_stores.author' );

            $query      =   $this->db->get();

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_stores' )->num_rows()
            ], 200 );
        }

        $result     =   $this->db->where( 'id', $id )->get( 'nexopos_stores' )->result();

        return $result ? $this->response( ( array ) @$result[0], 200 ) : $this->__404();
    }

    /**
     *  store POST
     *  @return json
    **/

    public function stores_post()
    {
        if( $this->db->where( 'name', $this->post( 'name' ) )->get( 'nexopos_stores' )->num_rows() ) {
            $this->__alreadyExists();
        }

        $this->db->insert( 'nexopos_stores', [
            'name'                  =>  $this->post( 'name' ),
            'description'           =>  $this->post( 'description' ),
            'author'                =>  $this->post( 'author' ),
            'authorized_users'      =>  $this->post( 'authorized_users' ),
            'status'                =>  $this->post( 'status' ),
            'image'                 =>  $this->post( 'image' ),
            'date_creation'         =>  $this->post( 'date_creation' ),
        ]);

        $this->__success();
    }

    public function stores_delete()
    {
        if( is_array( $_GET[ 'ids' ] ) ) {
            foreach( $_GET[ 'ids' ] as $id ) {
                $this->db->where( 'id', ( int ) $id )->delete( 'nexopos_stores' );
            }
            return $this->__success();
        }
        return $this->__failed();
    }

    /**
     *  Categorie Update
     *  @param int store id
     *  @return json
    **/

    public function stores_put( $id )
    {
        $alreadyExists      =   $this->db->where( 'name', $this->put( 'name' ) )
        ->where( 'id !=', $id )
        ->get( 'nexopos_stores' )
        ->num_rows();

        if( $alreadyExists ) {
            $this->__alreadyExists();
        }

        $this->db->where( 'id', $id )->update( 'nexopos_stores', [
            'name'                  =>  $this->put( 'name' ),
            'description'           =>  $this->put( 'description' ),
            'author'                =>  $this->put( 'author' ),
            'status'                =>  $this->put( 'status' ),
            'authorized_users'      =>  $this->put( 'authorized_users' ),
            'image'                 =>  $this->put( 'image' ),
            'date_modification'     =>  $this->put( 'date_modification' ),
        ]);

        $this->__success();
    }


}
