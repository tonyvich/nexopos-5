<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait expenses
{
    /**
     *  expenses Get
     *  @param int expense id
     *  @return json
    **/

    public function expenses_get( $id = null )
    {
        if( $id == null ) {

            $this->db->select( '
                nexopos_expenses.id as id,
                nexopos_expenses.name as name,
                nexopos_expenses.amount as amount,
                nexopos_expenses.image_url as image_url,
                nexopos_expenses.description as description,
                nexopos_expenses.date_creation as date_creation,
                nexopos_expenses.date_modification as date_modification,
                nexopos_expenses_categories.name as expense_category_name,
                aauth_users.name        as author_name
            ' );

            $this->db->from( 'nexopos_expenses' );
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
                $this->db->or_like( 'nexopos_expenses.id', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_expenses.name', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_expenses.description', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_expenses_categories.name', $this->get( 'search' ) );
            }

            $this->db->join( 'nexopos_expenses_categories', 'nexopos_expenses_categories.id = nexopos_expenses.ref_category' );
            $this->db->join( 'aauth_users', 'aauth_users.id = nexopos_expenses.author' );
            $query      =   $this->db->get();

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_expenses' )->num_rows()
            ], 200 );
        }

        $result     =   $this->db->where( 'id', $id )->get( 'nexopos_expenses' )->result();
        return $this->response( $result[0], 200 );
    }

    /**
     *  Customer Groups POST
     *  @return json
    **/

    public function expenses_post()
    {
        if( $this->db->where( 'name', $this->post( 'name' ) )->get( 'nexopos_expenses' )->num_rows() ) {
            $this->__alreadyExists();
        }

        $this->db->insert( 'nexopos_expenses', [
            'name'                  =>  $this->post( 'name' ),
            'amount'                =>  $this->post( 'amount' ),
            'image_url'             =>  $this->post( 'image_url' ),
            'ref_category'          =>  $this->post( 'ref_category' ),
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

    public function expenses_delete()
    {
        if( is_array( $_GET[ 'ids' ] ) ) {
            foreach( $_GET[ 'ids' ] as $id ) {
                $this->db->where( 'id', ( int ) $id )->delete( 'nexopos_expenses' );
            }
            return $this->__success();
        }
        return $this->__failed();
    }

    /**
     *  expenses Update. Update a current expenses entry.
     *  @param  int entry id
     *  @return json
    **/

    public function expenses_put( $id )
    {
        $alreadyExists      =   $this->db->where( 'name', $this->put( 'name' ) )
        ->where( 'id !=', $id )
        ->get( 'nexopos_expenses' )
        ->num_rows();

        if( $alreadyExists ) {
            $this->__alreadyExists();
        }

        $this->db->where( 'id', $id )->update( 'nexopos_expenses', [
            'name'                  =>  $this->put( 'name' ),
            'amount'                =>  $this->put( 'amount' ),
            'image_url'             =>  $this->put( 'image_url' ),
            'ref_category'          =>  $this->put( 'ref_category' ),
            'description'           =>  $this->put( 'description' ),
            'author'                =>  $this->put( 'author' ),
            'date_modification'     =>  $this->put( 'date_modification' )
        ]);

        $this->__success();
    }
}
