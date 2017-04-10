tendooApp.factory( 'customersGroupsEditTextDomain', function(){
    return  {
        title       :   '<?php echo __( 'Modifier un Groupe de client', 'nexopos_advanced' );?>',
        return      :   '<?php echo __( 'Revenir vers la liste', 'nexopos_advanced' );?>',
        returnLink  :   '<?php echo site_url([ 'dashboard', 'nexopos', 'customers-groups' ] );?>',
        itemTitle   :   '<?php echo __( 'Nom du groupe', 'nexopos_advanced' );?>',
        saveBtnText :   '<?php echo __( 'Sauvegarder', 'nexopos_advanced' );?>',
        fieldsTitle :   '<?php echo __( 'Options', 'nexopos_advanced' );?>',
        addNewLink  :   '<?php echo site_url( [ 'dashboard', 'nexopos', 'customers-groups', 'add' ] );?>',
        listTitle   :   '<?php echo __( 'Liste des groupes de client', 'nexopos_advanced' );?>',
        addNew      :   '<?php echo __( 'Modifier le groupe', 'nexopos_advanced' );?>'
    }
});
