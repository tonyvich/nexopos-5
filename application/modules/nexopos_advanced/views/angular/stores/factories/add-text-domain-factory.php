tendooApp.factory( 'storesAddTextDomain', function(){
    return  {
        title   :   '<?php echo __( 'Créer une boutique', 'nexopos_advanced' );?>',
        return  :   '<?php echo __( 'Revenir vers la liste', 'nexopos_advanced' );?>',
        returnLink  :   '<?php echo site_url([ 'dashboard', 'nexopos', 'stores' ] );?>',
        itemTitle  :   '<?php echo __( 'Nouvelle boutique', 'nexopos_advanced' );?>',
        saveBtnText :   '<?php echo __( 'Sauvegarder', 'nexopos_advanced' );?>',
        fieldsTitle :   '<?php echo __( 'Options', 'nexopos_advanced' );?>',
        addNewLink  :   '<?php echo site_url( [ 'dashboard', 'nexopos', 'stores', 'add' ] );?>',
        listTitle   :   '<?php echo __( 'Liste des boutiques', 'nexopos_advanced' );?>',
        addNew  :   '<?php echo __( 'Nouvelle boutique', 'nexopos_advanced' );?>'
    }
});
