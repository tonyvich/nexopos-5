<?php 
    defined('BASEPATH') or exit('No direct script access allowed');
    
    $this->Gui->col_width(1, 4);

    $this->Gui->add_meta(array(
        'namespace'        =>    'add_role',
        'title'            =>    __('Add a permission to a role', 'perm_manager'),
        'col_id'           =>    1,
        'gui_saver'        =>    true,
        'footer'           =>    array(
            'submit' => array(
                'label'  => __('Save'),
            )            
        ),
        'custom'           =>    array( 
            'action'           =>    site_url(array( 'dashboard', 'perm_manager', 'add_permission' )),
        ),
        'type'             =>    'box',
    ));

    $this->Gui->add_item( array(
        'type'    => 'select',
        'label'   => __('Role','perm_manager'),
        'options' => $sel_group,
        'name'    => 'group_par'
    ), 'add_role',1);

    $this->Gui->add_item( array(
        'type'    => 'select',
        'label'   => __('Permission','perm_manager'),
        'options' => $sel_permission,
        'name'    => 'perms_par'
    ), 'add_role',1);

    $this->Gui->output();