<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait deliveries
{
    /**
     *  Delivery Get
     *  @param int delivvery id
     *  @return json
    **/

    public function deliveries_get( $id = null )
    {
        if( $id == null ) {

            $this->db->select( '
                nexopos_deliveries.id as id,
                nexopos_deliveries.name as name,
                nexopos_deliveries.purchase_cost as purchase_cost,
                nexopos_deliveries.auto_cost as auto_cost,
                nexopos_deliveries.shipping_date as shipping_date,
                nexopos_deliveries.date_creation as date_creation,
                nexopos_deliveries.date_modification as date_modification,
                nexopos_deliveries.date_modification as date_modification,
                nexopos_deliveries.date_modification as date_modification,
                aauth_users.name        as author_name
            ' );

            $this->db->from( 'nexopos_deliveries' );
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
                $this->db->or_like( 'nexopos_deliveries.id', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_deliveries.name', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_deliveries.description', $this->get( 'search' ) );
            }

            $this->db->join( 'aauth_users', 'aauth_users.id = nexopos_deliveries.author', 'left' );
            $query      =   $this->db->get();

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_deliveries' )->num_rows()
            ], 200 );
        }

        $result     =   $this->db->where( 'id', $id )
        ->get( 'nexopos_deliveries' )
        ->result();

        return $result ? $this->response( ( array ) @$result[0], 200 ) : $this->__404();
    }

    /**
     *  delivery POST
     *  @return json
    **/

    public function deliveries_post()
    {
        if( $this->db->where( 'name', $this->post( 'name' ) )->get( 'nexopos_deliveries' )->num_rows() ) {
            $this->__alreadyExists();
        }

        $this->db->insert( 'nexopos_deliveries', [
            'name'                  =>  $this->post( 'name' ),
            'description'           =>  $this->post( 'description' ),
            'author'                =>  $this->post( 'author' ),
            'date_creation'         =>  $this->post( 'date_creation' ),
            'purchase_cost'         =>  $this->post( 'purchase_cost' ),
            'auto_cost'             =>  $this->post( 'auto_cost' ),
            'shipping_date'         =>  $this->post( 'shipping_date' ),
        ]);

        $this->__success();
    }

    /**
     *  delete
     *  @param void
     *  @return json
    **/

    public function deliveries_delete()
    {
        if( is_array( $_GET[ 'ids' ] ) ) {
            foreach( $_GET[ 'ids' ] as $id ) {
                $this->db->where( 'id', ( int ) $id )->delete( 'nexopos_deliveries' );
            }
            return $this->__success();
        }
        return $this->__failed();
    }

    /**
     *  Deliveries Update. Update a current delivery entry.
     *  @param  int entry id
     *  @return json
    **/

    public function deliveries_put( $id )
    {
        $alreadyExists      =   $this->db->where( 'name', $this->put( 'name' ) )
        ->where( 'id !=', $id )
        ->get( 'nexopos_deliveries' )
        ->num_rows();

        if( $alreadyExists ) {
            $this->__alreadyExists();
        }

        $this->db->where( 'id', $id )->update( 'nexopos_deliveries', [
            'name'                  =>  $this->put( 'name' ),
            'description'           =>  $this->put( 'description' ),
            'author'                =>  $this->put( 'author' ),
            'date_modification'     =>  $this->put( 'date_modification' ),
            'purchase_cost'         =>  $this->put( 'purchase_cost' ),
            'auto_cost'             =>  $this->put( 'auto_cost' ),
            'shipping_date'         =>  $this->put( 'shipping_date' ),
        ]);

        $this->__success();
    }
}
