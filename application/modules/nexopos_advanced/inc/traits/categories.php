<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait categories
{
    /**
     *  category Get
     *  @param int category id
     *  @return json
    **/

    public function categories_get( $id = null )
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
                $this->db->limit( $this->get( 'limit' ), $this->get( 'current_page' ) );
            }

            $this->db->join( 'aauth_users', 'aauth_users.id = nexopos_deliveries.author' );
            $query      =   $this->db->get();

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_deliveries' )->num_rows()
            ], 200 );
        }

        $result     =   $this->db->where( 'id', $id )->get( 'nexopos_categories' )->result();
        return $this->reponse( $result, 200 );
    }

    /**
     *  category POST
     *  @return json
    **/

    public function categories_post()
    {
        if( $this->db->where( 'name', $this->post( 'name' ) )->get( 'nexopos_categories' )->num_rows() ) {
            $this->__failed();
        }

        $this->db->insert( 'nexopos_categories', [
            'name'                  =>  $this->post( 'name' ),
            'description'           =>  $this->post( 'description' ),
            'author'                =>  $this->post( 'author' ),
            'ref_parent'            =>  $this->post( 'ref_parent' ),
        ]);

        $this->__success();
    }
}
