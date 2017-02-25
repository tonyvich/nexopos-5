tendooApp.factory( 'expensesCategoriesEditTextDomain', function(){
    return  {
        title       :   '<?php echo __( 'Modifier une catégorie de dépense', 'nexopos_advanced' );?>',
        return      :   '<?php echo __( 'Revenir vers la liste', 'nexopos_advanced' );?>',
        returnLink  :   '<?php echo site_url([ 'dashboard', 'nexopos', 'expenses-categories' ] );?>',
        itemTitle   :   '<?php echo __( 'Nom de la catégorie', 'nexopos_advanced' );?>',
        saveBtnText :   '<?php echo __( 'Modifier', 'nexopos_advanced' );?>',
        fieldsTitle :   '<?php echo __( 'Options', 'nexopos_advanced' );?>',
        addNewLink  :   '<?php echo site_url( [ 'dashboard', 'nexopos', 'expenses-categories', 'add' ] );?>',
        listTitle   :   '<?php echo __( 'Liste des catégories', 'nexopos_advanced' );?>',
        addNew      :   '<?php echo __( 'Modifier la catégories', 'nexopos_advanced' );?>'
    }
});
