tendooApp.factory( 'categoriesTextDomain', function(){
    return  {
        title   :   '<?php echo __( 'Créer une catégorie', 'nexopos_advanced' );?>',
        return  :   '<?php echo __( 'Revenir vers la liste', 'nexopos_advanced' );?>',
        returnLink  :   '<?php echo site_url([ 'dashboard', 'nexopos', 'categories' ] );?>',
        itemTitle  :   '<?php echo __( 'nouvelle catégorie', 'nexopos_advanced' );?>',
        saveBtnText :   '<?php echo __( 'Sauvegarder', 'nexopos_advanced' );?>',
        fieldsTitle :   '<?php echo __( 'Options', 'nexopos_advanced' );?>',
        addNewLink  :   '<?php echo site_url( [ 'dashboard', 'nexopos', 'categories', 'add' ] );?>',
        listTitle   :   '<?php echo __( 'Liste des catégories', 'nexopos_advanced' );?>',
        addNew  :   '<?php echo __( 'Nouvelle catégorie', 'nexopos_advanced' );?>'
    }
});
