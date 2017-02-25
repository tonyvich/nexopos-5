tendooApp.factory( 'providersEditTextDomain', function(){
    return  {
        title   :   '<?php echo __( 'Modifier un Fournisseur', 'nexopos_advanced' );?>',
        return  :   '<?php echo __( 'Revenir vers la liste', 'nexopos_advanced' );?>',
        returnLink  :   '<?php echo site_url([ 'dashboard', 'nexopos', 'providers' ] );?>',
        itemTitle  :   '<?php echo __( 'Nom du Fournisseur', 'nexopos_advanced' );?>',
        saveBtnText :   '<?php echo __( 'Sauvegarder', 'nexopos_advanced' );?>',
        fieldsTitle :   '<?php echo __( 'Options', 'nexopos_advanced' );?>',
        addNewLink  :   '<?php echo site_url( [ 'dashboard', 'nexopos', 'providers', 'add' ] );?>',
        listTitle   :   '<?php echo __( 'Liste des Fournisseur', 'nexopos_advanced' );?>',
        addNew  :   '<?php echo __( 'Modifier Fournisseur', 'nexopos_advanced' );?>'
    }
});
