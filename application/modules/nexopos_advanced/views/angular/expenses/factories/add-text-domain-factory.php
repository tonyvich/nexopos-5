tendooApp.factory( 'expensesTextDomain', function(){
    return  {
        title       :   '<?php echo __( 'Créer une Dépense', 'nexopos_advanced' );?>',
        return      :   '<?php echo __( 'Revenir vers la liste', 'nexopos_advanced' );?>',
        returnLink  :   '<?php echo site_url([ 'dashboard', 'nexopos', 'expenses' ] );?>',
        itemTitle   :   '<?php echo __( 'nouvelle dépense', 'nexopos_advanced' );?>',
        saveBtnText :   '<?php echo __( 'Sauvegarder', 'nexopos_advanced' );?>',
        fieldsTitle :   '<?php echo __( 'Options', 'nexopos_advanced' );?>',
        addNewLink  :   '<?php echo site_url( [ 'dashboard', 'nexopos', 'expenses', 'add' ] );?>',
        listTitle   :   '<?php echo __( 'Liste des dépenses', 'nexopos_advanced' );?>',
        addNew      :   '<?php echo __( 'Nouvelle Dépense', 'nexopos_advanced' );?>'
    }
});
