<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PermManagerController extends Tendoo_Module 
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  Mainboard 
     *  @param void
     *  @return void
    **/

    public function mainboard()
    {
       
        $this->events->add_action( 'dashboard_footer', 
            function() {
                get_instance()->load->module_view( 'perm_manager', 'mainboard_footer' );
            }
        );
        $this->Gui->set_title ( 'Permission Manager' );
        $this->load->module_view('perm_manager', 'mainboard_view');
    }

    /**
     *  Get  Return permission to a JSON format
     *  @param void
     *  @return JSON
    **/

    public function get(){
        
        $data = $this->users->auth->list_groups();
        foreach ( $data as &$d){
            $perms = $this->users->auth->list_perms( $d->id );
            $d->permissions = $perms;
        }
        $data[ 'roles' ] = $data;
        $data[ 'permissions' ] =  $this->users->auth->list_perms();
        echo json_encode( $data );
    }
}