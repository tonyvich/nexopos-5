<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once( dirname( __FILE__ ) . '/inc/filters.php' );
include_once( dirname( __FILE__ ) . '/inc/controller.php' );
include_once( dirname( __FILE__ ) . '/inc/actions.php' );

class Media_Manager_Main extends Tendoo_Module
{
    public function __construct()
    {
        parent::__construct();
        $this->filters  =   new Media_Manager_Filters;
        $this->actions  =   new Media_Manager_Actions;

        $this->events->add_filter( 'admin_menus', [ $this->filters, 'admin_menus' ] );
        $this->events->add_action( 'load_dashboard', [ $this->actions, 'load_dashboard' ]);
        $this->events->add_action( 'do_enable_module', [ $this->actions, 'enable_module' ]);
    }
}
new Media_Manager_Main;
