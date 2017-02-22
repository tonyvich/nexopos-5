tendooApp.factory( 'customerGroupsTextDomain', function(){
    return  {
        title       :   '<?php echo __( 'Créer un Groupe de client', 'nexopos_advanced' );?>',
        return      :   '<?php echo __( 'Revenir vers la liste', 'nexopos_advanced' );?>',
        returnLink  :   '<?php echo site_url([ 'dashboard', 'nexopos', 'customer-groups' ] );?>',
        itemTitle   :   '<?php echo __( 'Nouveau groupe de client', 'nexopos_advanced' );?>',
        saveBtnText :   '<?php echo __( 'Sauvegarder', 'nexopos_advanced' );?>',
        fieldsTitle :   '<?php echo __( 'Options', 'nexopos_advanced' );?>',
        addNewLink  :   '<?php echo site_url( [ 'dashboard', 'nexopos', 'customer-groups', 'add' ] );?>',
        listTitle   :   '<?php echo __( 'Liste des Groupes client', 'nexopos_advanced' );?>',
        addNew      :   '<?php echo __( 'Nouveau Groupe', 'nexopos_advanced' );?>'
    }
});
