<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This class is designed for the management of tendoo permission

class PermManagerModule extends Tendoo_Module 
{

    public function __construct() 
    {
        parent::__construct();
        $this->events->add_action( 'load_dashboard', [ $this, 'dashboard_loader' ] );
        $this->events->add_filter( 'admin_menus', [ $this, 'menus' ], 20);
    }

    public function dashboard_loader()
    {
        include_once( dirname( __FILE__ ) . '/inc/controller.php' );
        $this->Gui->register_page_object( 'perm_manager', new PermManagerController );
    }

    /**
     * Setting module Menu
     */
    
    public function menus( $menus )
    {
        if( User::can( 'manage_core' ) ) {
            if( @$menus[ 'settings' ] != null ) {
                $menus  =   array_insert_before( 'modules', $menus, 'perm_manager', [
                    [
                        'title' =>  'Permission Manager',
                        'href'   =>  site_url( array( 'dashboard', 'perm_manager', 'mainboard' ) ),
                        'icon'  =>  'fa fa-file'
                    ]
                ]);
            }            
        }
        return $menus;
    }
}
new PermManagerModule;