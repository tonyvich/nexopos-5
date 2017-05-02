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

            if( $this->get( 'variations' ) == 'true' ) {
                
                $this->db->select( '
                    nexopos_categories.name as category_name,
                    nexopos_departments.name as department_name,
                    nexopos_taxes.name as tax_name,
                    nexopos_items.id as id,7
                    nexopos_items.name as name,
                    nexopos_items.namespace as namespace,
                    nexopos_items.status as status,
                    nexopos_items.date_creation as date_creation,
                    nexopos_items.date_modification as date_modification,
                    nexopos_items_variations.name as variation_name,
                    nexopos_items_variations.sale_price as sale_price,
                    nexopos_items_variations.purchase_price as purchase_price,
                    nexopos_items_variations.available_quantity as available_quantity,
                    nexopos_items_variations.sold_quantity as sold_quantity,
                    nexopos_items_variations.defective_quantity as defective_quantity,
                    aauth_users.name        as author_name
                ' );


                $this->db->from( 'nexopos_items' );

                $this->db->join( 'nexopos_items_variations', 'nexopos_items_variations.ref_item = nexopos_items.id' );
                $this->db->join( 'nexopos_categories', 'nexopos_items.ref_category = nexopos_categories.id' );
                $this->db->join( 'nexopos_departments', 'nexopos_items.ref_department = nexopos_departments.id' );
                $this->db->join( 'nexopos_taxes', 'nexopos_items.ref_tax = nexopos_taxes.id' );

                // Order Request
                if( $this->get( 'order_by' ) ) {
                    $this->db->order_by( $this->get( 'order_by' ), $this->get( 'order_type' ) );
                }

                if( $this->get( 'limit' ) ) {
                    $this->db->limit( $this->get( 'limit' ), $this->get( 'limit' ) * $this->get( 'current_page' ) );
                }

                $this->db->join( 'aauth_users', 'aauth_users.id = nexopos_items.author' );
                $this->db->join( 'nexopos_categories', 'nexopos_items.ref_category = nexopos_categories.id' );
                $this->db->join( 'nexopos_departments', 'nexopos_items.ref_department = nexopos_departments.id' );
                $this->db->join( 'nexopos_taxes', 'nexopos_items.ref_tax = nexopos_taxes.id' );

                $query      =   $this->db->get();

                return $this->response([
                    'entries'   =>  $query->result(),
                    'num_rows'  =>  $this->db->get( 'nexopos_items' )->num_rows()
                ], 200 );

            } else {

                $this->db->select( '
                    nexopos_categories.name as category_name,
                    nexopos_departments.name as department_name,
                    nexopos_taxes.name as tax_name,
                    nexopos_items.id as id,
                    nexopos_items.name as name,
                    nexopos_items.namespace as namespace,
                    nexopos_items.status as status,
                    nexopos_items.date_creation as date_creation,
                    nexopos_items.date_modification as date_modification,
                    aauth_users.name        as author_name,
                    (SELECT COUNT(*) from `' . $this->db->dbprefix . 'nexopos_items_variations` WHERE `ref_item`  = `' . $this->db->dbprefix . 'nexopos_items`.`id`) as variation_quantity,
                    (SELECT SUM( available_quantity ) from `' . $this->db->dbprefix . 'nexopos_items_variations` WHERE `ref_item`  = `' . $this->db->dbprefix . 'nexopos_items`.`id`) as available_quantity,
                    (SELECT SUM( defective_quantity ) from `' . $this->db->dbprefix . 'nexopos_items_variations` WHERE `ref_item`  = `' . $this->db->dbprefix . 'nexopos_items`.`id`) as defective_quantity,
                    (SELECT SUM( sold_quantity ) from `' . $this->db->dbprefix . 'nexopos_items_variations` WHERE `ref_item`  = `' . $this->db->dbprefix . 'nexopos_items`.`id`) as sold_quantity
                ' );

                $this->db->from( 'nexopos_items' );

                // Order Request
                if( $this->get( 'order_by' ) ) {
                    $this->db->order_by( $this->get( 'order_by' ), $this->get( 'order_type' ) );
                }

                if( $this->get( 'limit' ) ) {
                    $this->db->limit( $this->get( 'limit' ), $this->get( 'limit' ) * $this->get( 'current_page' ) );
                }

                $this->db->join( 'aauth_users', 'aauth_users.id = nexopos_items.author' );
                $this->db->join( 'nexopos_categories', 'nexopos_items.ref_category = nexopos_categories.id' );
                $this->db->join( 'nexopos_departments', 'nexopos_items.ref_department = nexopos_departments.id' );
                $this->db->join( 'nexopos_taxes', 'nexopos_items.ref_tax = nexopos_taxes.id' );

                $query      =   $this->db->get();

                return $this->response([
                    'entries'   =>  $query->result(),
                    'num_rows'  =>  $this->db->get( 'nexopos_items' )->num_rows()
                ], 200 );

            }
        }

        if( $filter != null ) {
            $result     =   $this->db->where( $filter, $id );
        } else {
            $result     =   $this->db->where( 'id', $id );
        }

        $result     =   $this->db->get( 'nexopos_items' )->result();

        // If we're loading specific item, then we can also load variations when the item is already loaded.
        if( $id != null && $result ) {
            
            // get variations
            $result[0]->variations      =   $this->db->where( 'ref_item', $id )
            ->get( 'nexopos_items_variations' )
            ->result_array();

            foreach( $result[0]->variations as &$variation ) {
                $variation[ 'stock' ]           =   $this->db->where( 'ref_variation', $variation[ 'id' ] )
                ->get( 'nexopos_items_variations_stock' )
                ->result_array();

                $variation[ 'images' ]          =   $this->db->where( 'ref_variation', $variation[ 'id' ] )
                ->get( 'nexopos_items_variations_galleries' )
                ->result_array();

                // $variation[ 'metas' ]           =   $this->db->where( 'ref_variation', $variation[ 'id' ] )
                // ->get( 'nexopos_variations_metas' );
            }            
        }

        return ( $result ) ? $this->response( $result[0], 200 ) : $this->__404();
    }

    /**
     *  category POST
     *  @return json
    **/

    public function items_post()
    {
        $raw_options                =   $this->db->get( 'options' )->result_array(); 
        $options                    =   [];
        foreach( $raw_options as $raw_option ) {
            $options[ $raw_option[ 'KEY' ] ]  =   $raw_option[ 'VALUE' ];
        }

        if( @$options[ 'generated_barcodes' ] !=  null ) {
            $generated_barcodes      =  json_decode( $options[ 'generated_barcodes' ], true );
        } else {
            $generated_barcodes      =   [];
        }

        // loading barcode library
        $this->load->module_library( 'nexopos_advanced', 'nexopos_barcode_library' );

        $variation_errors       =   [];
        // Initial Checks
        foreach( $this->post( 'variations' ) as &$variation ) {
            $sku_checks     =   $this->db->where( 'sku', $variation[ 'sku' ] )
            ->get( 'nexopos_items_variations' )->result_array();

            // if barcode generation is disabled
            if( $variation[ 'generate_barcode' ] != 'yes' ) {
                $barcode_checks     =   $this->db->where( 'barcode', $variation[ 'barcode' ] )
                ->get( 'nexopos_items_variations' )->result_array();

                // if the submited barcode doesn't exist
                if( ! $barcode_checks ) {
                    $generated_barcodes[]    =   $variation[ 'barcode' ];
                }
            } else {
                // let generate a barcode
                $random_barcode         =   $this->nexopos_barcode_library->generate_barcode();
                if( $random_barcode ) {
                    $generated_barcodes[]        =   $random_barcode;
                    $variation[ 'barcode' ]     =   $random_barcode;
                }

                $barcode_checks     =   [];
            }

            if( $sku_checks || $barcode_checks ) {
                $variation_errors[]     =   [
                    'variation'     =>      $variation, 
                    'sku'           =>      $sku_checks,
                    'barcode'       =>      $barcode_checks
                ];
            }            
        }

        if( $variation_errors ) {
            return $this->response( $variation_errors, 403 );
        }

        // since all variation has been checked, the barcode saved is now updated
        $this->db->where( 'KEY', 'generated_barcodes' )->update( 'options', [
            'VALUE'     =>  json_encode( $generated_barcodes )
        ]);

        $this->db->insert( 'nexopos_items',[
            'name'              =>  $this->post( 'name' ),
            'namespace'         =>  $this->post( 'namespace' ),
            'ref_category'      =>  $this->post( 'ref_category' ),
            'ref_tax'          =>  $this->post( 'ref_tax' ),
            'ref_unit'          =>  $this->post( 'ref_unit' ),
            'ref_department'    =>  $this->post( 'ref_department' ),
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

        $variations                 =   $this->post( 'variations' );
        // saving variations
        foreach( $variations as $variation ) {

            $variation_data     =   [
                'ref_item'      =>  $last_entry[0][ 'id' ]
            ];

            // Looping fields
            foreach( $variation as $name     =>  $field ) {
                // exclude from variation fields
                if( ! in_array( $name, [ 'images', 'stock', 'models' ] ) ) {
                    $variation_data[ $name ]    =   $field;
                }
            }

            // Special treatment for names
            // if the variation name is not set, then we'll use the parent name
            $variation_data[ 'name' ]       =   strlen( $variation_data[ 'name' ] ) == 0 ? $this->post( 'name' ) : $variation_data[ 'name' ];

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

            // Available Stock
            $available_quantity                =   0;
            foreach( $variation[ 'stock' ] as $key     =>  $stock ) {
                $variation[ 'stock' ][ $key ][ 'author' ]          =   $this->post( 'author' );
                $variation[ 'stock' ][ $key ][ 'stock_type' ]      =   'supplying';
                $variation[ 'stock' ][ $key ][ 'ref_variation' ]   =   $last_variation_entry[0][ 'id' ];
                $available_quantity            +=  $stock[ 'quantity' ];
            }

            // Update available quantity
            $this->db->where( 'id', $last_variation_entry[0][ 'id' ] )
            ->update( 'nexopos_items_variations', [
                'available_quantity'    =>  $available_quantity
            ]);

            // Should not be empty
            $this->db->insert_batch( 'nexopos_items_variations_stock', $variation[ 'stock' ] );

            // if there are images
            foreach( $variation[ 'images' ] as $key     =>  $images ) {
                // Since it's not required, it may be empty, in such case, we don't save it
                if( $images[ 'image' ] ) {
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
