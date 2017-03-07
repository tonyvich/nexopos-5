<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media_Manager_Controller extends Tendoo_Module
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  index of the media Manager
     *  @param void
     *  @return void
    **/

    public function index()
    {
        echo 'Hello World';
    }
}
