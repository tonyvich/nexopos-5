<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait units
{
    /**
     *  unit Get
     *  @param int unit id
     *  @return json
    **/

    public function units_get( $id = null )
    {
        if( $id == null ) {

            $this->db->select( '
                nexopos_units.id as id,
                nexopos_units.name as name,
                nexopos_units.code as code,
                nexopos_units.date_creation as date_creation,
                nexopos_units.date_modification as date_modification,
                nexopos_units.author as author,
                aauth_users.name        as author_name
            ' );

            $this->db->from( 'nexopos_units' );
            // Order Request
            if( $this->get( 'order_by' ) ) {
                $this->db->order_by( $this->get( 'order_by' ), $this->get( 'order_type' ) );
            }

            if( $this->get( 'limit' ) ) {
                $this->db->limit( $this->get( 'limit' ), $this->get( 'current_page' ) );
            }

            $this->db->join( 'aauth_users', 'aauth_users.id = nexopos_units.author' );
            $query      =   $this->db->get();

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_units' )->num_rows()
            ], 200 );
        }

        $result     =   $this->db->where( 'id', $id )->get( 'nexopos_units' )->result();
        return $this->response( $result[0], 200 );
    }

    /**
     *  unit POST
     *  @return json
    **/

    public function units_post()
    {
        if( $this->db->where( 'name', $this->post( 'name' ) )->get( 'nexopos_units' )->num_rows() ) {
            $this->__failed();
        }

        $this->db->insert( 'nexopos_units', [
            'name'                  =>  $this->post( 'name' ),
            'code'                  =>  $this->post( 'code' ),
            'description'           =>  $this->post( 'description' ),
            'author'                =>  $this->post( 'author' ),
            'date_creation'         =>  $this->post( 'date_creation' )
        ]);

        $this->__success();
    }

    public function units_delete()
    {
        if( is_array( $_GET[ 'ids' ] ) ) {
            foreach( $_GET[ 'ids' ] as $id ) {
                $this->db->where( 'id', ( int ) $id )->delete( 'nexopos_units' );
            }
            return $this->__success();
        }
        return $this->__failed();
    }
}
