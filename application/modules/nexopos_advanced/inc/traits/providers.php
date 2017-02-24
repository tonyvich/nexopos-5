<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait providers
{
    /**
     *  provider Get
     *  @param int provider id
     *  @return json
    **/

    public function providers_get( $id = null )
    {
        if( $id == null ) {
            
            $this->db->select( '
                nexopos_providers.id as id,
                nexopos_providers.name as name,
                nexopos_providers.email as email,
                nexopos_providers.phone as phone,
                nexopos_providers.description as description,
                nexopos_providers.date_creation as date_creation,
                nexopos_providers.date_modification as date_modification,
                nexopos_providers.author as author,
                aauth_users.name        as author_name
            ' );

            $this->db->from( 'nexopos_providers' );
            // Order Request
            if( $this->get( 'order_by' ) ) {
                $this->db->order_by( $this->get( 'order_by' ), $this->get( 'order_type' ) );
            }

            if( $this->get( 'limit' ) ) {
                $this->db->limit( $this->get( 'limit' ), $this->get( 'current_page' ) );
            }

            $this->db->join( 'aauth_users', 'aauth_users.id = nexopos_providers.author' );
            $query      =   $this->db->get();

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_providers' )->num_rows()
            ], 200 );
        }

        $result     =   $this->db->where( 'id', $id )->get( 'nexopos_providers' )->result();
        return $this->response( $result[0], 200 );
    }

    /**
     *  provider POST
     *  @return json
    **/

    public function providers_post()
    {
        if( $this->db->where( 'name', $this->post( 'name' ) )->get( 'nexopos_providers' )->num_rows() ) {
            $this->__failed();
        }

        $this->db->insert( 'nexopos_providers', [
            'name'                  =>  $this->post( 'name' ),
            'email'                 =>  $this->post( 'email' ),
            'description'           =>  $this->post( 'description' ),
            'author'                =>  $this->post( 'author' ),
            'date_creation'         =>  $this->post( 'date_creation' ),
            'phone'                 =>  $this->post( 'phone' ),
        ]);

        $this->__success();
    }

    public function providers_delete()
    {
        if( is_array( $_GET[ 'ids' ] ) ) {
            foreach( $_GET[ 'ids' ] as $id ) {
                $this->db->where( 'id', ( int ) $id )->delete( 'nexopos_providers' );
            }
            return $this->__success();
        }
        return $this->__failed();
    }
}
