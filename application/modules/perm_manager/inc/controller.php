<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PermManagerController extends Tendoo_Module 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function mainboard()
    {
        $groups = $this->users->auth->list_groups();

        // setting a group array for select

        $sel_group = array();
        foreach ( force_array ( $groups ) as $group) {
            $sel_group[ $group->name ] = $group->name;
        }

        // setting a permission array for select

        $sel_permission = array();
        $permissions = $this->users->auth->list_perms();
        foreach ( force_array ( $permissions ) as $permission ) {
            $sel_permission[ $permission->name ] = $permission->name;
        }

        $this->Gui->set_title ( 'Permission Manager' );
        $this->load->module_view('perm_manager', 'mainboard_view', array( 
                'groups'          => $groups,
                'sel_group'       => $sel_group,
                'sel_permission'  => $sel_permission
            )
        );
    }

    public function delete($group, $perm){
        if($this->users->auth->deny_group( $group, $perm )){
            $this->mainboard();
        }
    }

    public function add_permission (){
        $group       = $this->input->post('group_par');
        $permission  = $this->input->post('perms_par');
        if($this->users->auth->allow_group( $group, $permission )){
            $this->mainboard();
        }
    }
}