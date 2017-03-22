<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait items
{
    /**
     *  category Get
     *  @param int category id
     *  @return json
    **/

    public function items_get( $id = null, $filter = null )
    {
        if( $id == null ) {

            $this->db->select( '
                nexopos_items.id as id,
                nexopos_items.name as name,
                nexopos_items.namespace as namespace,
                nexopos_items.status as status,
                nexopos_items.date_creation as date_creation,
                nexopos_items.date_modification as date_modification,
                aauth_users.name        as author_name,
                (SELECT COUNT(*) from `' . $this->db->dbprefix . 'nexopos_items_variations` WHERE `ref_item`  = `' . $this->db->dbprefix . 'nexopos_items`.`id`) as variations_nbr
            ' );

            $this->db->from( 'nexopos_items' );
            // Order Request
            if( $this->get( 'order_by' ) ) {
                $this->db->order_by( $this->get( 'order_by' ), $this->get( 'order_type' ) );
            }

            if( $this->get( 'limit' ) ) {
                $this->db->limit( $this->get( 'limit' ), $this->get( 'current_page' ) );
            }

            $this->db->join( 'aauth_users', 'aauth_users.id = nexopos_items.author' );

            $query      =   $this->db->get();

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_items' )->num_rows()
            ], 200 );
        }

        if( $filter != null ) {
            $result     =   $this->db->where( $filter, $id );
        } else {
            $result     =   $this->db->where( 'id', $id );
        }

        $result     =   $this->db->get( 'nexopos_items' )->result();

        return $this->response( $result[0], 200 );
    }

    /**
     *  category POST
     *  @return json
    **/

    public function items_post()
    {
        $this->db->insert( 'nexopos_items',[
            'name'              =>  $this->post( 'name' ),
            'namespace'         =>  $this->post( 'namespace' ),
            'ref_category'      =>  $this->post( 'ref_category' ),
            'ref_taxe'          =>  $this->post( 'ref_taxe' ),
            'ref_unit'          =>  $this->post( 'ref_unit' ),
            'status'            =>  $this->post( 'status' ),
            'author'            =>  $this->post( 'author' ),
            'date_creation'     =>  $this->post( 'date_creation' ),
        ]);

        // get Latest id
        $last_entry             =    $this->db->order_by( 'id', 'desc' )
        ->get( 'nexopos_items' )->result_array();

        // Can submit item
        // item with error can't be submited
        $item_status            =   'yes';

        // saving variations
        foreach( $this->post( 'variations' ) as $variation ) {

            $variation_data     =   [
                'ref_item'      =>  $last_entry[0][ 'id' ]
            ];

            foreach( $variation as $name     =>  $field ) {
                // exclude from variation fields
                if( ! in_array( $name, [ 'images', 'stock' ] ) ) {
                    $variation_data[ $name ]    =   $field;
                }
            }

            // Checks if the sku and the barcode already exists
            // if the sku and barcode already exists, then the item won't be ready for sale.
            $query      =   $this->db->where( 'sku', $variation_data[ 'sku' ] )
            ->or_where( 'barcode', $variation_data[ 'barcode' ] )
            ->get( 'nexopos_items_variations' )
            ->result_array();

            if( $query ) {
                $item_status      =   'has_errors'; // if an item has an error, then it's can't be available for sale
            }

            $this->db->insert( 'nexopos_items_variations', $variation_data );

            // Get Latest variation save
            $last_variation_entry             =    $this->db->order_by( 'id', 'desc' )
            ->get( 'nexopos_items_variations' )->result_array();

            foreach( $variation[ 'stock' ] as $key     =>  $stock ) {
                $variation[ 'stock' ][ $key ][ 'author' ]          =   $this->post( 'author' );
                $variation[ 'stock' ][ $key ][ 'stock_type' ]      =   'supplying';
                $variation[ 'stock' ][ $key ][ 'ref_variation' ]   =   $last_variation_entry[0][ 'id' ];
            }

            // Should not be empty
            $this->db->insert_batch( 'nexopos_items_variations_stock', $variation[ 'stock' ] );

            // if there are images
            foreach( $variation[ 'images' ] as $key     =>  $images ) {
                // Since it's not required, it may be empty, in such case, we don't save it
                if( $images[ 'gallery' ] ) {
                    $images[ 'ref_variation' ]      =   $last_variation_entry[0][ 'id' ];

                    // inset individually since it can be empty. It's inserted only when it's not empty
                    $this->db->insert( 'nexopos_items_variations_galleries', $images );
                }
            }
        }

        // update item status
        $this->db->where( 'id', $last_entry[0][ 'id' ] )->update( 'nexopos_items', [
            'status'    =>  $item_status
        ]);

        // Success
        return $this->__success();
    }

    public function items_delete()
    {
        if( is_array( $_GET[ 'ids' ] ) ) {
            foreach( $_GET[ 'ids' ] as $id ) {
                $this->db->where( 'id', ( int ) $id )->delete( 'nexopos_items' );
            }
            return $this->__success();
        }
        return $this->__failed();
    }

    /**
     *  Categorie Update
     *  @param int category id
     *  @return json
    **/

    public function items_put( $id )
    {

    }


}
