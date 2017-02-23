<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait customers
{
    /**
     *  customersGroups Get
     *  @param int delivvery id
     *  @return json
    **/

    public function customers_get( $id = null )
    {
        if( $id == null ) {

            $this->db->select( '
                nexopos_customers.id as id,
                nexopos_customers.name as name,
                nexopos_customers.surname as surname,
                nexopos_customers.sex as sex,
                nexopos_customers.phone as phone,
                nexopos_customers.email as email,
                nexopos_customers.address as address,
                nexopos_customers.pobox as pobox,
                nexopos_customers.description as description,
                nexopos_customers.date_creation as date_creation,
                nexopos_customers.date_modification as date_modification,
                nexopos_customers_groups.name as group_name,
                aauth_users.name        as author_name
            ' );

            $this->db->from( 'nexopos_customers' );
            // Order Request
            if( $this->get( 'order_by' ) ) {
                $this->db->order_by( $this->get( 'order_by' ), $this->get( 'order_type' ) );
            }

            if( $this->get( 'limit' ) ) {
                $this->db->limit( $this->get( 'limit' ), $this->get( 'current_page' ) );
            }

            $this->db->join( 'nexopos_customers_groups', 'nexopos_customers_groups.id = nexopos_customers.ref_group' );
            $this->db->join( 'aauth_users', 'aauth_users.id = nexopos_customers.author' );
            $query      =   $this->db->get();

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_customers' )->num_rows()
            ], 200 );
        }

        $result     =   $this->db->where( 'id', $id )->get( 'nexopos_customers' )->result();
        return $this->reponse( $result, 200 );
    }

    /**
     *  Customer Groups POST
     *  @return json
    **/

    public function customers_post()
    {
        if( $this->db->where( 'name', $this->post( 'name' ) )->get( 'nexopos_customers' )->num_rows() ) {
            $this->__failed();
        }

        $this->db->insert( 'nexopos_customers', [
            'name'                  =>  $this->post( 'name' ),
            'surname'               =>  $this->post( 'surname' ),
            'sex'                   =>  $this->post( 'sex' ),
            'phone'                 =>  $this->post( 'phone' ),
            'email'                 =>  $this->post( 'email' ),
            'address'               =>  $this->post( 'address' ),
            'pobox'                 =>  $this->post( 'pobox' ),
            'ref_group'             =>  $this->post( 'ref_group' ),
            'description'           =>  $this->post( 'description' ),
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

    public function customers_delete()
    {
        if( is_array( $_GET[ 'ids' ] ) ) {
            foreach( $_GET[ 'ids' ] as $id ) {
                $this->db->where( 'id', ( int ) $id )->delete( 'nexopos_customers' );
            }
            return $this->__success();
        }
        return $this->__failed();
    }
}
