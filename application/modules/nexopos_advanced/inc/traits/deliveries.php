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
            // Order Request
            if( $this->get( 'order_by' ) ) {
                $this->db->order_by( $this->get( 'order_by' ), $this->get( 'order_type' ) );
            }

            if( $this->get( 'limit' ) ) {
                $this->db->limit( $this->get( 'limit' ), $this->get( 'current_page' ) );
            }

            $query      =   $this->db->get( 'nexopos_deliveries' );

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_deliveries' )->num_rows()
            ], 200 );
        }

        $result     =   $this->db->where( 'id', $id )->get( 'nexopos_deliveries' )->result();
        return $this->reponse( $result, 200 );
    }

    /**
     *  delivery POST
     *  @return json
    **/

    public function deliveries_post()
    {
        if( $this->db->where( 'name', $this->post( 'name' ) )->get( 'nexopos_deliveries' )->num_rows() ) {
            $this->__failed();
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
}
