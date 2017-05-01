<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait departments
{
    /**
     *  Delivery Get
     *  @param int delivvery id
     *  @return json
    **/

    public function departments_get( $id = null )
    {
        if( $id == null ) {

            $this->db->select( '
                nexopos_departments.id as id,
                nexopos_departments.name as name,
                nexopos_departments.description as description,
                nexopos_departments.image_url as image_url,
                nexopos_departments.author as author,
                nexopos_departments.date_creation as date_creation,
                nexopos_departments.date_modification as date_modification,
                aauth_users.name        as author_name
            ' );

            $this->db->from( 'nexopos_departments' );
            // Order Request
            if( $this->get( 'order_by' ) ) {
                $this->db->order_by( $this->get( 'order_by' ), $this->get( 'order_type' ) );
            }

            if( $this->get( 'limit' ) ) {
                $this->db->limit( $this->get( 'limit' ), $this->get( 'limit' ) * $this->get( 'current_page' ) );
            }

            // Search
            if( $this->get( 'search' ) ) {
                $this->db->like( 'aauth_users.name', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_departments.id', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_departments.name', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_departments.description', $this->get( 'search' ) );
            }

            $this->db->join( 'aauth_users', 'aauth_users.id = nexopos_departments.author' );
            $query      =   $this->db->get();

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_departments' )->num_rows()
            ], 200 );
        }

        $result     =   $this->db->where( 'id', $id )->get( 'nexopos_departments' )->result();

        return $result ? $this->response( ( array ) @$result[0], 200 ) : $this->__404();
    }

    /**
     *  delivery POST
     *  @return json
    **/

    public function departments_post()
    {
        if( $this->db->where( 'name', $this->post( 'name' ) )->get( 'nexopos_departments' )->num_rows() ) {
            $this->__alreadyExists();
        }

        $this->db->insert( 'nexopos_departments', [
            'name'                  =>  $this->post( 'name' ),
            'description'           =>  $this->post( 'description' ),
            'image_url'             =>  $this->post( 'image_url' ),
            'author'                =>  $this->post( 'author' ),
            'date_creation'         =>  $this->post( 'date_creation' )
        ]);

        $this->__success();
    }

    /**
     *  delete
     *  @param void
     *  @return json
    **/

    public function departments_delete()
    {
        if( is_array( $_GET[ 'ids' ] ) ) {
            foreach( $_GET[ 'ids' ] as $id ) {
                $this->db->where( 'id', ( int ) $id )->delete( 'nexopos_departments' );
            }
            return $this->__success();
        }
        return $this->__failed();
    }

    /**
     *  departments Update. Update a current delivery entry.
     *  @param  int entry id
     *  @return json
    **/

    public function departments_put( $id )
    {
        $alreadyExists      =   $this->db->where( 'name', $this->put( 'name' ) )
        ->where( 'id !=', $id )
        ->get( 'nexopos_departments' )
        ->num_rows();

        if( $alreadyExists ) {
            $this->__alreadyExists();
        }

        $this->db->where( 'id', $id )->update( 'nexopos_departments', [
            'name'                  =>  $this->put( 'name' ),
            'image_url'                  =>  $this->put( 'image_url' ),
            'description'           =>  $this->put( 'description' ),
            'author'                =>  $this->put( 'author' ),
            'date_modification'     =>  $this->put( 'date_modification' ),
        ]);

        $this->__success();
    }
}
