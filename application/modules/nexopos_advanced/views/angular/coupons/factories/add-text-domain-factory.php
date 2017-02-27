tendooApp.factory( 'couponsTextDomain', function(){
    return  {
        title       :   '<?php echo __( 'Créer un coupon', 'nexopos_advanced' );?>',
        return      :   '<?php echo __( 'Revenir vers la liste', 'nexopos_advanced' );?>',
        returnLink  :   '<?php echo site_url([ 'dashboard', 'nexopos', 'coupons' ] );?>',
        itemTitle   :   '<?php echo __( 'Nouveau coupon', 'nexopos_advanced' );?>',
        saveBtnText :   '<?php echo __( 'Sauvegarder', 'nexopos_advanced' );?>',
        fieldsTitle :   '<?php echo __( 'Options', 'nexopos_advanced' );?>',
        addNewLink  :   '<?php echo site_url( [ 'dashboard', 'nexopos', 'coupons', 'add' ] );?>',
        listTitle   :   '<?php echo __( 'Liste des coupons', 'nexopos_advanced' );?>',
        addNew      :   '<?php echo __( 'Nouveau Coupon', 'nexopos_advanced' );?>'
    }
});
