<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait coupons
{
    /**
     *  customersGroups Get
     *  @param int delivvery id
     *  @return json
    **/

    public function coupons_get( $id = null )
    {
        if( $id == null ) {

            $this->db->select( '
                nexopos_coupons.id as id,
                nexopos_coupons.name as name,
                nexopos_coupons.description as description,
                nexopos_coupons.code as code,
                nexopos_coupons.usage_limit as usage_limit,
                nexopos_coupons.start_date as start_date,
                nexopos_coupons.end_date as end_date,
                nexopos_coupons.discount_type as discount_type,
                nexopos_coupons.discount_percent as discount_percent,
                nexopos_coupons.discount_amount as discount_amount,
                nexopos_coupons.date_creation as date_creation,
                nexopos_coupons.date_modification as date_modification,
                aauth_users.name        as author_name
            ' );

            $this->db->from( 'nexopos_coupons' );
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
                $this->db->or_like( 'nexopos_coupons.id', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_coupons.name', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_coupons.description', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_coupons.usage_limit', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_coupons.start_date', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_coupons.end_date', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_coupons.discount_type', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_coupons.discount_percent', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_coupons.discount_amount', $this->get( 'search' ) );
            }

            $this->db->join( 'aauth_users', 'aauth_users.id = nexopos_coupons.author' );
            $query      =   $this->db->get();

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_coupons' )->num_rows()
            ], 200 );
        }

        $result     =   $this->db->where( 'id', $id )->get( 'nexopos_coupons' )->result();

        return $result ? $this->response( ( array ) @$result[0], 200 ) : $this->__404();
    }

    /**
     *  Customer Groups POST
     *  @return json
    **/

    public function coupons_post()
    {
        if( $this->db->where( 'name', $this->post( 'name' ) )->get( 'nexopos_coupons' )->num_rows() ) {
            $this->__alreadyExists();
        }

        $this->db->insert( 'nexopos_coupons', [
            'name'                  =>  $this->post( 'name' ),
            'description'           =>  $this->post( 'description' ),
            'author'                =>  $this->post( 'author' ),
            'date_creation'         =>  $this->post( 'date_creation' ),
            'code'                  =>  $this->post( 'code' ),
            'start_date'            =>  $this->post( 'start_date' ),
            'end_date'              =>  $this->post( 'end_date' ),
            'usage_limit'           =>  $this->post( 'usage_limit' ),
            'discount_amount'       =>  $this->post( 'discount_amount' ),
            'discount_percent'      =>  $this->post( 'discount_percent' ),
            'discount_type'         =>  $this->post( 'discount_type' )
        ]);

        $this->__success();
    }

    /**
     *  delete
     *  @param void
     *  @return json
    **/

    public function coupons_delete()
    {
        if( is_array( $_GET[ 'ids' ] ) ) {
            foreach( $_GET[ 'ids' ] as $id ) {
                $this->db->where( 'id', ( int ) $id )->delete( 'nexopos_coupons' );
            }
            return $this->__success();
        }
        return $this->__failed();
    }

    /**
     *  coupons Update. Update a cuurent entry.
     *  @param  int entry id
     *  @return json
    **/

    public function coupons_put( $id )
    {
        $alreadyExists      =   $this->db->where( 'name', $this->put( 'name' ) )
        ->where( 'id !=', $id )
        ->get( 'nexopos_coupons' )
        ->num_rows();

        if( $alreadyExists ) {
            $this->__alreadyExists();
        }

        $this->db->where( 'id', $id )->update( 'nexopos_coupons', [
            'name'                  =>  $this->put( 'name' ),
            'description'           =>  $this->put( 'description' ),
            'author'                =>  $this->put( 'author' ),
            'date_modification'     =>  $this->put( 'date_modification' ),
            'code'                  =>  $this->put( 'code' ),
            'start_date'            =>  $this->put( 'start_date' ),
            'end_date'              =>  $this->put( 'end_date' ),
            'usage_limit'           =>  $this->put( 'usage_limit' ),
            'discount_amount'       =>  $this->put( 'discount_amount' ),
            'discount_percent'      =>  $this->put( 'discount_percent' ),
            'discount_type'         =>  $this->put( 'discount_type' )
        ]);

        $this->__success();
    }
}
