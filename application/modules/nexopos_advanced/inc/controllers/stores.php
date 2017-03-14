<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NexoPOS_Stores_Controller extends Tendoo_Module
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  Catch all call to the store controller
     *  @param string store name
     *  @return array arguments
    **/

    public function __call( $name, $arguments )
    {
        var_dump( $name, $arguments );
    }
}
