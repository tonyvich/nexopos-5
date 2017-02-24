tendooApp.factory( 'unitsEditTextDomain', function(){
    return  {
        title   :   '<?php echo __( 'Modifier une unité', 'nexopos_advanced' );?>',
        return  :   '<?php echo __( 'Revenir vers la liste', 'nexopos_advanced' );?>',
        returnLink  :   '<?php echo site_url([ 'dashboard', 'nexopos', 'units' ] );?>',
        itemTitle  :   '<?php echo __( 'Nom unité', 'nexopos_advanced' );?>',
        saveBtnText :   '<?php echo __( 'Sauvegarder', 'nexopos_advanced' );?>',
        fieldsTitle :   '<?php echo __( 'Options', 'nexopos_advanced' );?>',
        addNewLink  :   '<?php echo site_url( [ 'dashboard', 'nexopos', 'units', 'add' ] );?>',
        listTitle   :   '<?php echo __( 'Liste des unités', 'nexopos_advanced' );?>',
        addNew  :   '<?php echo __( "Modifier l unité", 'nexopos_advanced' );?>'
    }
});
