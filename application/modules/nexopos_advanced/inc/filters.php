<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NexoPOS_Filters extends Tendoo_Module
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  Angular Dashboard dependency
     *  @param array
     *  @return array
    **/

    public function dependencies( $deps )
    {
        $deps[]     =   'ngRoute';
        // $deps[]     =   'ngAnimate';
        $deps[]     =   'ngResource';
        $deps[]     =   'oc.lazyLoad';
        $deps[]     =   'ui-notification';
        $deps[]     =   'ui.bootstrap';
        $deps[]     =   'ae-datetimepicker';
        $deps[]     =   'oitozero.ngSweetAlert';
        $deps[]     =   'ngNumeraljs';
        $deps[]     =   'amo.multiselect';
        $deps[]     =   'LocalStorageModule';
        return $deps;
    }

    /**
     * replace default tendoo spinner
     * @param void
     * @return string
    **/
    
    public function nexopos_spinner()
    {
        return '<div class="sp-40 sp-circle-light sp-margin-5 nexopos-spinner"></div>';
    }
}
