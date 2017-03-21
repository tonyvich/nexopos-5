<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait items
{
    /**
     *  category Get
     *  @param int category id
     *  @return json
    **/

    public function items_get( $id = null )
    {

        // return $result ? $this->response( ( array ) @$result[0], 200 ) : $this->__404();
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
