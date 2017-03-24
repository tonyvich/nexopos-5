tendooApp.factory( 'customersTextDomain', function(){
    return  {
        title       :   '<?php echo __( 'Ajouter un client', 'nexopos_advanced' );?>',
        return      :   '<?php echo __( 'Revenir vers la liste', 'nexopos_advanced' );?>',
        returnLink  :   '<?php echo site_url([ 'dashboard', 'nexopos', 'customers' ] );?>',
        itemTitle   :   '<?php echo __( 'Nouveau client', 'nexopos_advanced' );?>',
        saveBtnText :   '<?php echo __( 'Sauvegarder', 'nexopos_advanced' );?>',
        fieldsTitle :   '<?php echo __( 'Options', 'nexopos_advanced' );?>',
        addNewLink  :   '<?php echo site_url( [ 'dashboard', 'nexopos', 'customers', 'add' ] );?>',
        listTitle   :   '<?php echo __( 'Liste des clients', 'nexopos_advanced' );?>',
        addNew      :   '<?php echo __( 'Nouveau client', 'nexopos_advanced' );?>'
    }
});
