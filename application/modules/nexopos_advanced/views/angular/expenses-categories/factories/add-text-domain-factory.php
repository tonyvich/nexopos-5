tendooApp.factory( 'expensesCategoriesTextDomain', function(){
    return  {
        title       :   '<?php echo __( 'Créer une Catégorie de dépense', 'nexopos_advanced' );?>',
        return      :   '<?php echo __( 'Revenir vers la liste', 'nexopos_advanced' );?>',
        returnLink  :   '<?php echo site_url([ 'dashboard', 'nexopos', 'expenses-categories' ] );?>',
        itemTitle   :   '<?php echo __( 'nouvelle Catégorie', 'nexopos_advanced' );?>',
        saveBtnText :   '<?php echo __( 'Sauvegarder', 'nexopos_advanced' );?>',
        fieldsTitle :   '<?php echo __( 'Options', 'nexopos_advanced' );?>',
        addNewLink  :   '<?php echo site_url( [ 'dashboard', 'nexopos', 'expenses-categories', 'add' ] );?>',
        listTitle   :   '<?php echo __( 'Liste des Catégories', 'nexopos_advanced' );?>',
        addNew      :   '<?php echo __( 'Nouvelle Catégorie', 'nexopos_advanced' );?>'
    }
});
