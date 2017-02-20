<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NexoPOS_Main_Controller extends Tendoo_Module
{
    public function __default()
    {
        global $onNexoPOS;
        $onNexoPOS          =   true;

        $this->Gui->set_title( __( 'NexoPOS', 'nexopos_advanced' ) );
        $this->load->module_view( 'nexopos_advanced', 'main_gui' );
    }

    public function controllers( $namespace, $file_name = null )
    {
        $file_name  =   $file_name == null ? $namespace : $file_name;
        $file_name  =   str_replace( '.js', '', $file_name );
        $namespace  =   str_replace( '.js', '', $namespace );
        $this->load->module_view( 'nexopos_advanced', 'angular/' . $namespace . '/controllers/' . $file_name . '-controller' );
    }

    /**
     *  Require
     *  @param
     *  @return
    **/

    public function templates( $namespace, $view = 'main' )
    {
        $this->load->module_view(
            'nexopos_advanced',
            'angular/' . $namespace . '/templates/' . $view . '-template'
        );
    }

    /**
     *  Load Directive
     *  @param
     *  @return
    **/

    public function directives( $namespace, $view = 'main' )
    {
        $view  =   str_replace( '.js', '', $view );
        $this->load->module_view(
            'nexopos_advanced',
            'angular/' . $namespace . '/directives/' . $view . '-directive'
        );
    }

    /**
     *  Load Directive
     *  @param
     *  @return
    **/

    public function factories( $namespace, $view = 'main' )
    {
        $view  =   str_replace( '.js', '', $view );
        $this->load->module_view(
            'nexopos_advanced',
            'angular/' . $namespace . '/factories/' . $view . '-factory'
        );
    }

    /**
     *  Load Directive
     *  @param
     *  @return
    **/

    public function services( $namespace, $view = 'main' )
    {
        $view  =   str_replace( '.js', '', $view );
        $this->load->module_view(
            'nexopos_advanced',
            'angular/' . $namespace . '/services/' . $view . '-service'
        );
    }

    /**
     *  Shared
     *  @param
     *  @return
    **/

    public function shared_factories( $file )
    {
        $file  =   str_replace( '.js', '', $file );
        $this->load->module_view(
            'nexopos_advanced',
            'angular/shared/factories/' . $file . '-factory'
        );
    }

    /**
     *  Shared
     *  @param
     *  @return
    **/

    public function shared_config( $file )
    {
        $file  =   str_replace( '.js', '', $file );
        $this->load->module_view(
            'nexopos_advanced',
            'angular/shared/config/' . $file . '-config'
        );
    }

    /**
     *  Shared
     *  @param
     *  @return
    **/

    public function shared_directives( $file )
    {
        $file  =   str_replace( '.js', '', $file );
        $this->load->module_view(
            'nexopos_advanced',
            'angular/shared/directives/' . $file . '-directive'
        );
    }

    /**
     *  Shared
     *  @param
     *  @return
    **/

    public function shared_services( $file )
    {
        $file  =   str_replace( '.js', '', $file );
        $this->load->module_view(
            'nexopos_advanced',
            'angular/shared/services/' . $file . '-service'
        );
    }

    /*
    *  Shared
    *  @param
    *  @return
   **/

   public function shared_templates( $file )
   {
       $file  =   str_replace( '.js', '', $file );
       $this->load->module_view(
           'nexopos_advanced',
           'angular/shared/templates/' . $file . '-template'
       );
   }
}
