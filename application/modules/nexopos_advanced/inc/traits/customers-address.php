<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait customers_address
{
    /**
     *  customers_address Get
     *  @param int customers id
     *  @return json
    **/

    public function customers_address_get( $id = null )
    {
        if( $id == null ) {

            $this->db->select( '
                nexopos_customers_address.id as id,
                nexopos_customers_address.company as company,
                nexopos_customers_address.first_address as first_address,
                nexopos_customers_address.second_address as second_address,
                nexopos_customers_address.pobox as pobox,
                nexopos_customers_address.town as town,
                nexopos_customers_address.country as country,
                nexopos_customers_address.state as state,
                nexopos_customers_address.type as type,
                nexopos_customers.name as customer_name,
            ' );

            $this->db->from( 'nexopos_customers_address' );
            // Order Request
            if( $this->get( 'order_by' ) ) {
                $this->db->order_by( $this->get( 'order_by' ), $this->get( 'order_type' ) );
            }

            if( $this->get( 'limit' ) ) {
                $this->db->limit( $this->get( 'limit' ), $this->get( 'limit' ) * $this->get( 'current_page' ) );
            }

            $this->db->join( 'nexopos_customers', 'nexopos_customers.id = nexopos_customers_address.ref_customer' );
            $query      =   $this->db->get();

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_customers_address' )->num_rows()
            ], 200 );
        }

        $result     =   $this->db->where( 'id', $id )->get( 'nexopos_customers_address' )->result();

        return $result ? $this->response( ( array ) @$result[0], 200 ) : $this->__404();
    }

    /**
     *  Customers_address POST
     *  @return json
    **/

    public function customers_address_post()
    {
        $table_prefix       =   $this->db->dbprefix;
        $query = $this->db->query("SELECT max(id) as ID FROM ".$table_prefix."nexopos_customers");
        $result = $query->row(0);
        $this->db->insert( 'nexopos_customers_address', [
            'company'               =>  $this->post( 'company' ),
            'first_address'         =>  $this->post( 'first_address' ),
            'second_address'        =>  $this->post( 'second_address' ),
            'pobox'                 =>  $this->post( 'pobox' ),
            'town'                  =>  $this->post( 'town' ),
            'country'               =>  $this->post( 'country' ),
            'state'                 =>  $this->post( 'state' ),
            'ref_customer'          =>  $result->ID,
            'type'                  =>  $this->post( 'type' )
        ]);

        $this->__success();
    }

    /**
     *  delete
     *  @param void
     *  @return json
    **/

    public function customers_address_delete()
    {
        if( is_array( $_GET[ 'ids' ] ) ) {
            foreach( $_GET[ 'ids' ] as $id ) {
                $this->db->where( 'id', ( int ) $id )->delete( 'nexopos_customers_address' );
            }
            return $this->__success();
        }
        return $this->__failed();
    }

    /**
     *  customers_address Update. Update a cuurent entry.
     *  @param  int entry id
     *  @return json
    **/

    public function customers_address_put( $id )
    {
        $this->db->where( 'ref_customer', $id )->update( 'nexopos_customers_address', [
            'company'               =>  $this->put( 'company' ),
            'first_address'         =>  $this->put( 'first_address' ),
            'second_address'        =>  $this->put( 'second_address' ),
            'pobox'                 =>  $this->put( 'pobox' ),
            'town'                  =>  $this->put( 'town' ),
            'country'               =>  $this->put( 'country' ),
            'state'                 =>  $this->put( 'state' ),
            'ref_customer'          =>  $this->put( 'ref_customer' ),
            'type'                  =>  $this->put( 'type' ),
        ]);

        $this->__success();
    }
}
