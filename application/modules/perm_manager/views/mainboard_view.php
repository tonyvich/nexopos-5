<?php 
    defined('BASEPATH') or exit('No direct script access allowed');

    $this->Gui->col_width(1, 4);

    $this->Gui->add_meta(array(
        'namespace'        =>    'role_list',
        'title'            =>    __('Role List', 'perm_manager'),
        'col_id'        =>    1,
        'footer'        =>    array(),
        'type'            =>    'box'
    ));

    $group_array        =    array();
    foreach ( force_array ( $groups ) as $group) {
        ob_start();
?> 
    <table class="table">
        <thead>
            <tr><th><?php echo __('Permission','perm_manager');?></th><th><?php echo __('Action','perm_manager');?></th><tr>
        </thead>
        <tbody>
<?php
        $permissions    =    $this->users->auth->list_perms( $group->id );
        foreach ( $permissions as $perm ) {
            $colors        =    array( 'bg-red' , 'bg-green' , 'bg-yellow' , 'bg-blue' );
?>
            <tr><td><span class="label bg-blue"><?php echo $perm->perm_name; ?></span></td><td><a href="<?php echo site_url( array( 'dashboard' , 'perm_manager' , 'delete' , $group->name, $perm->perm_name ) ) ?>"> Delete </a></td></tr>
<?php
        }
?>
        </tbody>
    </table>
<?php
        $label_permissions    =    ob_get_clean();
        $group_array[]    =    array(
            $group->name,
            $label_permissions
        );
    }

    $this->Gui->add_item(array(
        'type'            =>    'table',
        'cols'            =>    array( __('Role name', 'aauth'), __('Permissions', 'aauth') ),
        'rows'            =>    $group_array
    ), 'role_list', 1);

    $this->Gui->output();
