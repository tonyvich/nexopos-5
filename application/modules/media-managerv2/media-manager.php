<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once( dirname( __FILE__ ) . '/inc/filters.php' );
include_once( dirname( __FILE__ ) . '/inc/actions.php' );
include_once( dirname( __FILE__ ) . '/inc/assets.php' );
class Media_ManagerV2_Main extends Tendoo_Module
{
    public function __construct()
    {
        parent::__construct();
        $this->actions  =   new Media_ManagerV2_Actions;
        $this->filters  =   new Media_ManagerV2_Filters;
        $this->assets   =   new Media_ManagerV2_Assets;
        $this->assets->register();
        $this->load->module_config( 'media-manager' );
        $this->events->add_filter( 'admin_menus', [ $this->filters, 'admin_menus' ]);
        $this->events->add_filter( 'dashboard_dependencies', [ $this->filters, 'dependencies' ]);
        $this->events->add_action( 'load_dashboard', [ $this->actions, 'load_dashboard' ]);
        $this->events->add_action( 'do_enable_module', [ $this->actions, 'enable_module' ]);
    }
}

new Media_ManagerV2_Main;
