<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once( dirname( __FILE__ ) . '/inc/assets.php' );
include_once( dirname( __FILE__ ) . '/inc/filters.php' );
include_once( dirname( __FILE__ ) . '/inc/actions.php' );

class Media_Manager_Controller extends Tendoo_Module {
    public function __construct()
    {
        parent::__construct();
        $this->filters  =   new Media_Manager_Filters;
        $this->actions  =   new Media_Manager_Actions;
        $this->assets   =   new Media_Manager_Assets;

        $this->events->add_filter( 'admin_menus', [ $this->filters, 'admin_menus' ] );
        $this->events->add_action( 'load_dashboard', [ $this->actions, 'load_dashboard' ]);
        $this->events->add_action( 'load_dashboard', [ $this, 'dashboard' ]);
        $this->events->add_action( 'do_enable_module', [ $this->actions, 'enable_module' ]);
     
        // $this->events->add_action( 'load_dashboard', [ $this, 'dashboard' ] );
        // $this->events->add_action( 'do_enable_module', [ $this->install, 'create_tables' ] );
        // $this->events->add_action( 'do_enable_module', [ $this->actions, 'do_enable_module' ], 20 );
        // $this->events->add_action( 'do_remove_module', [ $this->install, 'remove_tables' ] );
        // $this->events->add_action( 'tendoo_settings_tables', [ $this->install, 'create_tables' ] );
    }

    /**
     *  Dashboard Init
     *  @param void
     *  @return void
    **/

    public function dashboard()
    {
        $this->events->add_action( 'dashboard_footer', [ $this->actions, 'dashboard_footer' ] );
        $this->events->add_action( 'dashboard_header', [ $this->actions, 'dashboard_header' ] );
        $this->events->add_filter( 'dashboard_dependencies', [ $this->filters, 'dependencies' ] );
        $this->actions->register_controllers();
    }
}

new Media_Manager_Controller;
