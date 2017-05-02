<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait expenses_categories
{
    /**
     *  customersGroups Get
     *  @param int delivvery id
     *  @return json
    **/

    public function expenses_categories_get( $id = null )
    {
        if( $id == null ) {

            $this->db->select( '
                nexopos_expenses_categories.id as id,
                nexopos_expenses_categories.name as name,
                nexopos_expenses_categories.description as description,
                nexopos_expenses_categories.date_creation as date_creation,
                nexopos_expenses_categories.date_modification as date_modification,
                aauth_users.name        as author_name
            ' );

            $this->db->from( 'nexopos_expenses_categories' );
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
                $this->db->or_like( 'nexopos_expenses_categories.id', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_expenses_categories.name', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_expenses_categories.description', $this->get( 'search' ) );
            }

            $this->db->join( 'aauth_users', 'aauth_users.id = nexopos_expenses_categories.author' );
            $query      =   $this->db->get();

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_expenses_categories' )->num_rows()
            ], 200 );
        }

        $result     =   $this->db->where( 'id', $id )->get( 'nexopos_expenses_categories' )->result();
        return $this->response( $result[0], 200 );
    }

    /**
     *  Customer Groups POST
     *  @return json
    **/

    public function expenses_categories_post()
    {
        if( $this->db->where( 'name', $this->post( 'name' ) )->get( 'nexopos_expenses_categories' )->num_rows() ) {
            $this->__alreadyExists();
        }

        $this->db->insert( 'nexopos_expenses_categories', [
            'name'                  =>  $this->post( 'name' ),
            'description'           =>  $this->post( 'description' ),
            'author'                =>  $this->post( 'author' ),
            'date_creation'         =>  $this->post( 'date_creation' ),
        ]);

        $this->__success();
    }

    /**
     *  delete
     *  @param void
     *  @return json
    **/

    public function expenses_categories_delete()
    {
        if( is_array( $_GET[ 'ids' ] ) ) {
            foreach( $_GET[ 'ids' ] as $id ) {
                $this->db->where( 'id', ( int ) $id )->delete( 'nexopos_expenses_categories' );
            }
            return $this->__success();
        }
        return $this->__failed();
    }

    /**
     *  expenses_categories Update. Update a current expenses category entry.
     *  @param  int entry id
     *  @return json
    **/

    public function expenses_categories_put( $id )
    {
        $alreadyExists      =   $this->db->where( 'name', $this->put( 'name' ) )
        ->where( 'id !=', $id )
        ->get( 'nexopos_expenses_categories' )
        ->num_rows();

        if( $alreadyExists ) {
            $this->__alreadyExists();
        }

        $this->db->where( 'id', $id )->update( 'nexopos_expenses_categories', [
            'name'                  =>  $this->put( 'name' ),
            'description'           =>  $this->put( 'description' ),
            'author'                =>  $this->put( 'author' ),
            'date_modification'     =>  $this->put( 'date_modification' ),
        ]);

        $this->__success();
    }
}
