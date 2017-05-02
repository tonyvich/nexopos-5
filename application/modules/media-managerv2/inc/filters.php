<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media_ManagerV2_Filters extends Tendoo_Module
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
        $menus  =   array_insert_before( 'modules', $menus, 'media-managerv2', [
            [
                'title'     =>  __( 'Media Manager V2', 'media-managerv2' ),
                'href'      =>  site_url([ 'dashboard', 'media-managerv2' ])
            ]
        ]);

        return $menus;
    }

    /**
     *  Dashboard Dependencies
     *  @param array dependencies
     *  @return array
    **/

    public function dependencies( $dependencies )
    {
        ! in_array( 'thatisuday.dropzone', $dependencies ) ? $dependencies[]  =   'thatisuday.dropzone' : null;
        return $dependencies;
    }
}
