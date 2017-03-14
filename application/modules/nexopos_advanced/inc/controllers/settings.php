<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NexoPOS_Settings_Controller extends Tendoo_Module
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  General Settings
     *  @param void
     *  @return void
    **/

    public function general()
    {
        $this->Gui->set_title( sprintf( __( '%s &rsaquo; Réglages &rsaquo; Généraux' ), $this->config->item( 'nexopos-name' ) ) );
        $this->load->module_view( 'nexopos_advanced', 'settings.general' );
    }

    /**
     *  Register Settings
     *  @param void
     *  @return void
    **/

    public function registers()
    {
        $this->Gui->set_title( sprintf( __( '%s &rsaquo; Réglages &rsaquo; Caisses Enregistreuses' ), $this->config->item( 'nexopos-name' ) ) );
        $this->load->module_view( 'nexopos_advanced', 'settings.registers' );
    }

    /**
     *  Store Settings
     *  @param void
     *  @return void
    **/

    public function stores()
    {
        $this->Gui->set_title( sprintf( __( '%s &rsaquo; Réglages &rsaquo; Boutiques' ), $this->config->item( 'nexopos-name' ) ) );
        $this->load->module_view( 'nexopos_advanced', 'settings.stores' );
    }

}
