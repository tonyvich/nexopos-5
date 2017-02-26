<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    /**
    * Storage Trait
    * Used for access to tendoo options
    *
    **/
Trait storage
{
    /**
     *  options Get
     *  @param id options id
     *  @return json
    **/

    public function storage_get()
    {
        $options    =   [];
        $datas   =   $this->db->get( 'options' )->result();
        foreach( $datas as $data ) {
            $options[ $data[ 'key' ] ]  =   $data[ 'value' ];
        }

        return $this->response( $options, 200 );
    }

    /**
     *  options POST/Update
     *  @return json
    **/

    public function storage_post()
    {
        $options        =   [];
        foreach( ( array ) $this->post( 'options' ) as $key => $option ) {
            $options[]      =   [
                'key'       =>  $key,
                'value'     =>  $option,
                'autoload'  =>  1,
                'app'       =>  'nexopos'
            ];
        }

        // Update Options first
        $options_keys    =   [];
        $datas   =   $this->db->get( 'options' )->result_array();
        foreach( $datas as $data ) {
            $options_keys[]     =   $data[ 'key' ];
        }

        // If option keys already exist, just update it
        $toUpdate           =   [];
        $toCreate           =   [];
        foreach( $options as $option ) {
            if( in_array( $option[ 'key' ], $options_keys ) ) {
                $toUpdate[] =   $option;
            } else {
                $toCreate[] =   $option;
            }
        }

        // Updating
        ( $toUpdate ) ? $this->db->update_batch( 'options', $toUpdate, 'key' ) : null;
        ( $toCreate ) ? $this->db->insert_batch( 'options', $toCreate ) : null;

        $this->__success();
    }

    /**
     *  delete
     *  @param
     *  @return
    **/

    public function storage_delete()
    {
        if( ( array ) $this->get( 'keys' ) ) {
            foreach( ( array ) $this->get( 'keys' ) as $key ) {
                $this->db->where( 'key', $key );
            }
            $this->db->delete( 'options' );
        }
    }

}
