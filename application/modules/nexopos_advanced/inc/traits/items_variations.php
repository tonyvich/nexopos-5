<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait items_variations
{
    /**
     *  category Get
     *  @param int category id
     *  @return json
    **/

    public function items_variations_get( $id = null, $filter = null )
    {
        if( $id == null ) {

            $this->db->select( '
                nexopos_items_variations.id as id,
                nexopos_items_variations.sale_price as sale_price,
                nexopos_items_variations.special_price as special_price,
                nexopos_items_variations.purchase_price as purchase_price,
                nexopos_items_variations.discount_start as discount_start,
                nexopos_items_variations.discount_end as discount_end,
                nexopos_items_variations.sku as sku,
                nexopos_items_variations.barcode_type as barcode_type,
                nexopos_items_variations.barcode as barcode,
                nexopos_items_variations.weight as weight,
                nexopos_items_variations.height as height,
                nexopos_items_variations.size as size,
                nexopos_items_variations.color as color,
                nexopos_items_variations.length as length,
                nexopos_items_variations.width as width,
                nexopos_items_variations.capacity as capacity,
                nexopos_items_variations.volume as volume,
                nexopos_items_variations.expiration_date as expiration_date,
                nexopos_items_variations.enable_special_price as enable_special_price,
                nexopos_items_variations.special_price_starts as special_price_starts,
                nexopos_items_variations.special_price_ends as special_price_ends,
                nexopos_items_variations.ref_item as ref_item,
                nexopos_items_variations.available_quantity as available_quantity,
                nexopos_items_variations.featured_image as featured_image,
                nexopos_items_variations.barcode_action as barcode_action,
            ' );

            $this->db->from( 'nexopos_items_variations' );
            // Order Request
            if( $this->get( 'order_by' ) ) {
                $this->db->order_by( $this->get( 'order_by' ), $this->get( 'order_type' ) );
            }

            // exclude an entry
            if( $this->get( 'exclude' ) ) {
                $this->db->where( 'nexopos_items_variations.id !=', $this->get( 'exclude' ) );
            }

            if( $this->get( 'limit' ) ) {
                $this->db->limit( $this->get( 'limit' ), $this->get( 'limit' ) * $this->get( 'current_page' ) );
            }

            // $this->db->join( 'aauth_users', 'aauth_users.id = nexopos_items_variations.author' );

            $query      =   $this->db->get();

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_items_variations' )->num_rows()
            ], 200 );
        }

        if( $filter != null ) {
            $result     =   $this->db->where( $filter, $id );
        } else {
            $result     =   $this->db->where( 'id', $id );
        }

        // exclude an entry
        if( $this->get( 'exclude' ) ) {
            $this->db->where( 'id !=', $this->get( 'exclude' ) );
        }

        $result     =   $this->db->get( 'nexopos_items_variations' )->result();

        return $this->response( ( Object ) @$result[0], 200 );
    }

    /**
     *  category POST
     *  @return json
    **/

    public function items_variations_post()
    {
        // Success
        return $this->__success();
    }

    public function items_variations_delete()
    {
        if( is_array( $_GET[ 'ids' ] ) ) {
            foreach( $_GET[ 'ids' ] as $id ) {
                $this->db->where( 'id', ( int ) $id )->delete( 'nexopos_items_variations' );
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

    public function items_variations_put( $id )
    {

    }


}
