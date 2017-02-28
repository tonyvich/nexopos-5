<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once( dirname( __FILE__ ) . '/controllers/nexopos.php' );
include_once( dirname( __FILE__ ) . '/controllers/angular.php' );

class NexoPOS_Actions extends Tendoo_Module
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  register Controller
     *  @param  void
     *  @return void
    **/

    public function register_controllers()
    {
        $this->Gui->register_page_object( 'nexopos', new NexoPOS_Main_Controller );
        $this->Gui->register_page_object( 'angular', new NexoPOS_Angular_Controller );
    }

    /**
     *  Do enable module
     *  @param string module namespace
     *  @return void
    **/

    public function do_enable_module( $module )
    {
        if( $module == 'nexopos_advanced' ) {
            global $Options;

            if( @$Options[ 'nexopos_tour' ] == null ) {
                redirect([ 'dashboard', 'nexopos', 'setup', 'welcome' ]);
            }
        }
    }


    public function dashboard_footer()
    {
        $this->load->module_view( 'nexopos_advanced', 'dashboard/footer' );
    }

    /**
     *  Dashboard header. Create base tag
     *  @param void
     *  @return void
    **/

    public function dashboard_header()
    {
        echo '<base href="' . site_url( [ 'dashboard', 'nexopos', $this->uri->segment(3) ] ). '"/>';
    }
}
