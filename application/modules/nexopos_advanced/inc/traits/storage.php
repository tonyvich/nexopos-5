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

    public function storage_get( $key = null )
    {
        if( $key != null ) 
        {
            // Get Key parameter
            $this->db->where('key',$key);

            //Get value parameter
            if ($this->get( 'value' )) { 
                $this->db->where('value',$this->get( 'value' ));
            }

            // Fetching data
            $query        =    $this->db->get('options');

            //Response
            return $this->response ([
                'entries'   =>  $query->result()
            ], 200 );
        } else {
            $result = $this->db->get('options')->result();

            return $this->response([
                'entries'   =>  $result,
                'num_rows'  =>  $this->db->get( 'nexopos_categories' )->num_rows()
            ], 200 );
        }
        return null;
    }

    /**
     *  options POST
     *  @return json
    **/

    public function storage_post()
    {
        if( $this->db->where( 'key', $this->post( 'key' ) )->get( 'options' )->num_rows() ) {
            $this->__failed();
        }

        $this->db->insert( 'options', [
            'key'                   =>  $this->post( 'key' ),
            'value'                 =>  $this->post( 'value' ),
            'autoload'              =>  $this->post( 'autoload' ),
            'user'                  =>  $this->post( 'user' ),
            'app'                   =>  $this->post( 'app' ),
        ]);

        $this->__success();
    }

    public function storage_delete()
    {
        if( is_array( $_GET[ 'ids' ] ) ) {
            foreach( $_GET[ 'ids' ] as $id ) {
                $this->db->where( 'id', ( int ) $id )->delete( 'options' );
            }
            return $this->__success();
        }
        return $this->__failed();
    }

    /**
     *  Options Update
     *  @param int category id
     *  @return json
    **/

    public function storage_put( $id )
    {
        $alreadyExists      =   $this->db->where( 'key', $this->put( 'key' ) )
        ->where( 'id !=', $id )
        ->get( 'options' )
        ->num_rows();

        if( $alreadyExists ) {
            $this->__failed();
        }

        $this->db->where( 'id', $id )->update( 'options', [
            'key'                   =>  $this->put( 'key' ),
            'value'                 =>  $this->put( 'value' ),
            'autoload'              =>  $this->put( 'autoload' ),
            'user'                  =>  $this->put( 'user' ),
            'app'                   =>  $this->put( 'app' ),
        ]);

        $this->__success();
    }

}
