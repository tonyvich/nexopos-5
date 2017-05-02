<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once( dirname( __FILE__ ) . '/../vendor/autoload.php' );

class Media_Manager_Controller extends Tendoo_module
{
    public function __construct()
    {
        parent::__construct();
        $this->actions  =   new Media_Manager_Actions;
    }

    /**
     *  Index
     *  @param void
     *  @return void
    **/

    public function index()
    {
        $this->events->add_action( 'dashboard_footer', [ $this->actions, 'media_footer' ]);
        $this->Gui->set_title( __( 'Media Manager', 'media-managerv2' ) );
        $this->load->module_view( 'media-managerv2', 'upload' );
    }

    /**
     *  Upload
     *  @param void
     *  @return void
    **/

    public function upload()
    {
        $this->load->helper( 'url_slug' );
        $this->image                        =   new \claviska\SimpleImage();
        $config['upload_path']              =   APPPATH . '/temp/';
        // $this->config->item( 'media-manager-upload-path' );
        $config['allowed_types']            =   $this->config->item( 'mm-supported-mime' );
        $this->load->library('upload', $config);

        $path                               =   '/';
        $year                               =   date( 'Y' );
        $month                              =   date( 'm' );
        $path                               =   $this->config->item( 'mm-upload-path' ) . $year . '/' . $month . '/';
        $url                                =   upload_url() . '/' . $year . '/' . $month . '/';

        if( ! is_dir( $this->config->item( 'mm-upload-path' ) . $year ) ) {
            mkdir( $this->config->item( 'mm-upload-path' ) . $year );
            if( ! is_dir( $path ) ) {
                mkdir( $path , 0777, true );
            }
        }

        if ( $this->upload->do_upload( 'file' ) ) {
            $data       =   $this->upload->data();
            foreach( $this->events->apply_filters( 'mm-upload-sizes', $this->config->item( 'mm-upload-sizes' ) ) as $namespace => $size ) {
                if( $size === true ) {
                    $this->image->fromFile( $data[ 'full_path' ] )
                    ->resize( $data[ 'image_width' ], $data[ 'image_height' ] )
                    ->toFile( $path . url_slug( $data[ 'raw_name' ] ) . '-' . $namespace . $data[ 'file_ext' ] );
                } else {
                    if( @$size[2] == 'thumbnail' ) {
                        $this->image->fromFile( $data[ 'full_path' ] )
                        ->thumbnail( $size[0], $size[1] )
                        ->toFile( $path . url_slug( $data[ 'raw_name' ] ) . '-' . $namespace . $data[ 'file_ext' ] );
                    } else {
                        $this->image->fromFile( $data[ 'full_path' ] )
                        ->resize( $size[0], $size[1] )
                        ->toFile( $path . url_slug( $data[ 'raw_name' ] ) . '-' . $namespace . $data[ 'file_ext' ] );
                    }
                }
            }

            // Unlink Temp
            @unlink( $data[ 'full_path' ] );

            // Save to databse
            $this->db->insert( $this->events->apply_filters( 'mm-table-prefix', '' ) . 'media_managerv2', [
                'name'              =>  $data[ 'raw_name' ],
                'mime'              =>  $data[ 'image_type' ],
                'url'               =>  $url . url_slug( $data[ 'raw_name' ] ) . '#NAMESPACE#' . $data[ 'file_ext' ],
                'author'            =>  User::id(),
                'date_creation'     =>  date_now(),
            ]);
        }
    }

    /**
     *  get images
     *  @param
     *  @return
    **/

    public function get()
    {
        if ( isset( $_GET['search'] ) ){
            $this->db->like('name', $_GET['search'] );
        }
        
        $results  =   $this->db->get(
            $this->events->apply_filters( 'mm-table-prefix', '' ) . 'media_managerv2'
        )->result_array();

        foreach( $this->events->apply_filters( 'mm-upload-sizes', $this->config->item( 'mm-upload-sizes' ) ) as $namespace => $size ) {
            foreach( $results as $index => &$result ) {
                $result[ $namespace ]   =   str_replace( '#NAMESPACE#', '-' . $namespace, $result[ 'url' ] );
            }
        }

        echo json_encode( $results );
    }
}
