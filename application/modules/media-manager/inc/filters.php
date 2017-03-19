<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media_Manager_Filters extends Tendoo_Module
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  Admin Menus
     *  @param array
     *  @return array
    **/

    public function admin_menus( $menus )
    {
        $menus  =   array_insert_before( 'modules', $menus, 'media-manager', [
            [
                'title'     =>  __( 'Media Manager', 'media-manager' ),
                'href'      =>  site_url([ 'dashboard', 'media-manager' ])
            ]
        ]);

        return $menus;
    }
}
