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
                'value'     =>  $value,
                'autoload'  =>  1,
                'app'       =>  'nexopos'
            ];
        }

        // Update Options first
        $options_keys    =   [];
        $datas   =   $this->db->get( 'options' )->result();
        foreach( $datas as $data ) {
            $options_keys[]     =   $data[ 'key' ];
        }

        // If option keys already exist, just update it
        $toUpdate           =   [];
        $toCreate           =   [];
        foreach( $options as $option ) {
            if( in_array( $options[ 'key' ], $options_keys ) ) {
                $toUpdate[] =   $option;
            } else {
                $toCreate[] =   $option;
            }
        }

        // Updating
        $this->db->update_batch( 'options', $toUpdate, 'key' );
        $this->db->insert_batch( 'options', $toCreate );
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
