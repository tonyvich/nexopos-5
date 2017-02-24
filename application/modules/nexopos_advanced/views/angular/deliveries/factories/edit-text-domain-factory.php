tendooApp.factory( 'deliveriesEditTextDomain', function(){
    return  {
        title       :   '<?php echo __( 'Modifier une livraison', 'nexopos_advanced' );?>',
        return      :   '<?php echo __( 'Revenir vers la liste', 'nexopos_advanced' );?>',
        returnLink  :   '<?php echo site_url([ 'dashboard', 'nexopos', 'deliveries' ] );?>',
        itemTitle   :   '<?php echo __( 'Nom de la livraison', 'nexopos_advanced' );?>',
        saveBtnText :   '<?php echo __( 'Modifier', 'nexopos_advanced' );?>',
        fieldsTitle :   '<?php echo __( 'Options', 'nexopos_advanced' );?>',
        addNewLink  :   '<?php echo site_url( [ 'dashboard', 'nexopos', 'deliveries', 'add' ] );?>',
        listTitle   :   '<?php echo __( 'Liste des livraisons', 'nexopos_advanced' );?>',
        addNew      :   '<?php echo __( 'Modifier la livraison', 'nexopos_advanced' );?>'
    }
});
