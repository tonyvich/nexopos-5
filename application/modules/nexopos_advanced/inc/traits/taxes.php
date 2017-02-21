<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait taxes
{
    /**
     *  tax Get
     *  @param int tax id
     *  @return json
    **/

    public function taxes_get( $id = null )
    {
        if( $id == null ) {
            // Order Request
            if( $this->get( 'order_by' ) ) {
                $this->db->order_by( $this->get( 'order_by' ), $this->get( 'order_type' ) );
            }

            if( $this->get( 'limit' ) ) {
                $this->db->limit( $this->get( 'limit' ), $this->get( 'current_page' ) );
            }

            $query      =   $this->db->get( 'nexopos_taxes' );

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_taxes' )->num_rows()
            ], 200 );
        }

        $result     =   $this->db->where( 'id', $id )->get( 'nexopos_taxes' )->result();
        return $this->reponse( $result, 200 );
    }

    /**
     *  tax POST
     *  @return json
    **/

    public function taxes_post()
    {
        if( $this->db->where( 'name', $this->post( 'name' ) )->get( 'nexopos_taxes' )->num_rows() ) {
            $this->__failed();
        }

        $this->db->insert( 'nexopos_taxes', [
            'name'                  =>  $this->post( 'name' ),
            'value'                 =>  $this->post( 'value' ),
            'description'           =>  $this->post( 'description' ),
            'author'                =>  $this->post( 'author' ),
            'date_creation'         =>  $this->post( 'date_creation' ),
            'type'                  =>  $this->post( 'type' ),
        ]);

        $this->__success();
    }
}
