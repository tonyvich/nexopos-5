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
            // Order Request
            if( $this->get( 'order_by' ) ) {
                $this->db->order_by( $this->get( 'order_by' ), $this->get( 'order_type' ) );
            }

            if( $this->get( 'limit' ) ) {
                $this->db->limit( $this->get( 'limit' ), $this->get( 'current_page' ) );
            }

            $query      =   $this->db->get( 'nexopos_categories' );

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_categories' )->num_rows()
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
