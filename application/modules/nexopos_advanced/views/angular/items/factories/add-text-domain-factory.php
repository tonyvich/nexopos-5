tendooApp.factory( 'itemsTextDomain', function(){
    return  {
        title       :   '<?php echo __( 'Créer un coupon', 'nexopos_advanced' );?>',
        return      :   '<?php echo __( 'Revenir vers la liste', 'nexopos_advanced' );?>',
        returnLink  :   '<?php echo site_url([ 'dashboard', 'nexopos', 'items' ] );?>',
        itemTitle   :   '<?php echo __( 'Nouvel article', 'nexopos_advanced' );?>',
        saveBtnText :   '<?php echo __( 'Sauvegarder', 'nexopos_advanced' );?>',
        fieldsTitle :   '<?php echo __( 'Options', 'nexopos_advanced' );?>',
        addNewLink  :   '<?php echo site_url( [ 'dashboard', 'nexopos', 'items', 'types' ] );?>',
        listTitle   :   '<?php echo __( 'Liste des produits', 'nexopos_advanced' );?>',
        addNew      :   '<?php echo __( 'Ajouter un produit', 'nexopos_advanced' );?>'
    }
});
