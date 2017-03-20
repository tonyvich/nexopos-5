<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media_Manager_Assets extends Tendoo_Module
{
    public function __construct()
    {
        parent::__construct();

    }

    /**
     *  Register
     *  @param void
     *  @return void
    **/

    public function register()
    {
        $bower_url      =   '../modules/media-manager/bower_components/';
        $js_url         =   '../modules/media-manager/js/';
        $css_url        =   '../modules/media-manager/css/';
        $root_url       =   '../bower_components/';
        $this->enqueue->css_namespace( 'dashboard_header' );
        $this->enqueue->css( $bower_url . 'dropzone/dist/min/dropzone.min' );
        $this->enqueue->css( $bower_url . 'ng-dropzone/dist/ng-dropzone.min' );

        $this->enqueue->js_namespace( 'dashboard_footer' );
        $this->enqueue->js( $bower_url . 'dropzone/dist/min/dropzone.min' );
        $this->enqueue->js( $bower_url . 'ng-dropzone/dist/ng-dropzone.min' );
    }
}
