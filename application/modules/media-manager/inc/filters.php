<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media_Manager_Filters extends Tendoo_Module
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  Register admin menu
     *  @param array admin menu
     *  @return array
    **/

    public function admin_menus( $menus )
    {
        $menus  =   array_insert_after( 'dashboard', $menus, 'media-manager', [
            array(
                'title'     =>      __( 'Media Manager', 'media-manager' ),
                'href'      =>      site_url([ 'dashboard', 'media-manager/items' ])
            )
        ]);

        return $menus;
    }

    /**
     *  Angular Dashboard dependency
     *  @param array
     *  @return array
    **/

    public function dependencies( $deps )
    {
        $deps[]     =   'ngRoute';
        $deps[]     =   'ngResource';
        $deps[]     =   'oc.lazyLoad';
        $deps[]     =   'ui-notification';
        $deps[]     =   'ui.bootstrap';
        $deps[]     =   'ae-datetimepicker';
        $deps[]     =   'oitozero.ngSweetAlert';
        return $deps;
    }
}
