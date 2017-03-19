<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
        $this->Gui->set_title( __( 'Media Manager', 'media-manager' ) );
        $this->load->module_view( 'media-manager', 'upload' );
    }
}
