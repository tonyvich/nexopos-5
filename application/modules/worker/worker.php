<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WorkerCTRL extends Tendoo_Module
{
    public function __construct()
    {
        parent::__construct();
        $this->events->add_action( 'dashboard_footer', [ $this, 'dash_footer' ] );
    }

    function dash_footer()
    {
    }
}
new WorkerCTRL;
