tendooApp.factory( 'expensesEditTextDomain', function(){
    return  {
        title       :   '<?php echo __( 'Modifier une dépense', 'nexopos_advanced' );?>',
        return      :   '<?php echo __( 'Revenir vers la liste', 'nexopos_advanced' );?>',
        returnLink  :   '<?php echo site_url([ 'dashboard', 'nexopos', 'expenses' ] );?>',
        itemTitle   :   '<?php echo __( 'Nom de la dépense', 'nexopos_advanced' );?>',
        saveBtnText :   '<?php echo __( 'Modifier', 'nexopos_advanced' );?>',
        fieldsTitle :   '<?php echo __( 'Options', 'nexopos_advanced' );?>',
        addNewLink  :   '<?php echo site_url( [ 'dashboard', 'nexopos', 'expenses', 'add' ] );?>',
        listTitle   :   '<?php echo __( 'Liste des dépenses', 'nexopos_advanced' );?>',
        addNew      :   '<?php echo __( 'Modifier la dépense', 'nexopos_advanced' );?>'
    }
});
