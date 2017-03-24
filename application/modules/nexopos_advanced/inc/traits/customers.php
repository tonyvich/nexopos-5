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
                nexopos_customers.description as description,
                nexopos_customers.status as status,
                nexopos_customers.sex as sex,
                nexopos_customers.phone as phone,
                nexopos_customers.email as email,
                nexopos_customers_groups.name as customer_group_name,
                nexopos_customers.date_creation as date_creation,
                nexopos_customers.date_modification as date_modification,
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

            // Search
            if( $this->get( 'search' ) ) {
                $this->db->like( 'aauth_users.name', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_customers.id', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_customers.name', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_customers.description', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_customers.surname', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_customers.sex', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_customers.phone', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_customers.email', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_customers_groups.name', $this->get( 'search' ) );
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

        return $result ? $this->response( ( array ) @$result[0], 200 ) : $this->__404();
    }

    /**
     *  Customer Groups POST
     *  @return json
    **/

    public function customers_post()
    {
        if( $this->db->where( 'name', $this->post( 'name' ) )->get( 'nexopos_customers' )->num_rows() ) {
            $this->__alreadyExists();
        }

        // Saving customer general informations
        $this->db->insert( 'nexopos_customers', [
            'name'                  =>  $this->post( 'name' ),
            'surname'               =>  $this->post( 'surname' ),
            'description'           =>  $this->post( 'description' ),
            'sex'                   =>  $this->post( 'sex' ),
            'status'                =>  $this->post( 'status' ),
            'phone'                 =>  $this->post( 'phone' ),
            'email'                 =>  $this->post( 'email' ),
            'ref_group'             =>  $this->post( 'ref_group' ),
            'author'                =>  $this->post( 'author' ),
            'date_creation'         =>  $this->post( 'date_creation' )
        ]);

        // Getting ID of the last insertion
        $table_prefix       =   $this->db->dbprefix;
        $query = $this->db->query("SELECT max(id) as ID FROM ".$table_prefix."nexopos_customers");
        $result = $query->row(0);

        // getting billing and delivery indormations
        $variations = $this->post( 'variations' );
        $data = $variations[0]; 
        
        // Saving customer billing informations
        $this->db->insert('nexopos_customers_address',[
            'company'        => $data[ 'billing_company' ],
            'first_address'  => $data[ 'billing_first_address' ],
            'second_address' => $data[ 'billing_second_address' ],
            'pobox'          => $data[ 'billing_pobox' ],
            'country'        => $data[ 'billing_country' ],
            'town'           => $data[ 'billing_town' ],
            'state'          => $data[ 'billing_state' ],
            'ref_customer'   => $result->ID,
            'type'           => 'billing'
        ]);

        // saving customer delivery informations
        $this->db->insert('nexopos_customers_address',[
            'company'        => $data[ 'delivery_company' ],
            'first_address'  => $data[ 'delivery_first_address' ],
            'second_address' => $data[ 'delivery_second_address'],
            'pobox'          => $data[ 'delivery_pobox' ],
            'country'        => $data[ 'delivery_country' ],
            'town'           => $data[ 'delivery_town' ],
            'state'          => $data[ 'delivery_state' ],
            'ref_customer'   => $result->ID,
            'type'           => 'delivery'
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

    /**
     *  customers Update. Update a cuurent entry.
     *  @param  int entry id
     *  @return json
    **/

    public function customers_put( $id )
    {
        $alreadyExists      =   $this->db->where( 'name', $this->put( 'name' ) )
        ->where( 'id !=', $id )
        ->get( 'nexopos_customers' )
        ->num_rows();

        if( $alreadyExists ) {
            $this->__alreadyExists();
        }

        $this->db->where( 'id', $id )->update( 'nexopos_customers', [
            'name'                  =>  $this->put( 'name' ),
            'surname'               =>  $this->put( 'surname' ),
            'description'           =>  $this->put( 'description' ),
            'status'                =>  $this->put( 'status' ),
            'author'                =>  $this->put( 'author' ),
            'sex'                   =>  $this->put( 'sex' ),
            'phone'                 =>  $this->put( 'phone' ),
            'email'                 =>  $this->put( 'email' ),
            'ref_group'             =>  $this->put( 'ref_group' ),
            'date_modification'     =>  $this->put( 'date_modification' )
        ]);

        $this->__success();
    }
}
