<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media_ManagerV2_Assets extends Tendoo_Module
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
        $bower_url      =   '../modules/media-managerv2/bower_components/';
        $js_url         =   '../modules/media-managerv2/js/';
        $css_url        =   '../modules/media-managerv2/css/';
        $root_url       =   '../bower_components/';
        $this->enqueue->css_namespace( 'dashboard_header' );
        $this->enqueue->css( $bower_url . 'dropzone/dist/min/dropzone.min' );
        $this->enqueue->css( $bower_url . 'ng-dropzone/dist/ng-dropzone.min' );
        $this->enqueue->css( $css_url . 'media-manager' );

        $this->enqueue->js_namespace( 'dashboard_footer' );
        $this->enqueue->js( $bower_url . 'dropzone/dist/min/dropzone.min' );
        $this->enqueue->js( $bower_url . 'ng-dropzone/dist/ng-dropzone.min' );
        $this->enqueue->js( $js_url . 'media-managerv2-directive' );
    }
}
