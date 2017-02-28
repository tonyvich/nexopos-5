tendooApp.factory( 'couponsTable', function(){
    return {
        columns     :   [
            {
                text    :   '<?php echo _s( 'Nom', 'nexopos_advanced' );?>',
                namespace   :   'name'
            },
            {
                text    :   '<?php echo _s( 'Type de réductions', 'nexopos_advanced' );?>',
                namespace   :   'discount_type'
            },
            {
                text    :   '<?php echo _s( 'Montant de la réduction', 'nexopos_advanced' );?>',
                namespace   :   'discount_amount'
            },
            {
                text    :   '<?php echo _s( 'Pourcentage de la réduction', 'nexopos_advanced' );?>',
                namespace   :   'discount_percent'
            },
            {
                text    :   '<?php echo _s( 'Début des réductions', 'nexopos_advanced' );?>',
                namespace   :   'start_date'
            },
            {
                text    :   '<?php echo _s( 'Fin des réductions', 'nexopos_advanced' );?>',
                namespace   :   'end_date'
            },
            {
                text    :   '<?php echo _s( "Limite d'utilisation", 'nexopos_advanced' );?>',
                namespace   :   'usage_limit'
            },
            {
                text    :   '<?php echo _s( 'Date de création', 'nexopos_advanced' );?>',
                namespace   :   'date_creation'
            },
            {
                text    :   '<?php echo _s( 'Modifié le', 'nexopos_advanced' );?>',
                namespace   :   'date_modification'
            },
            {
                text    :   '<?php echo _s( 'Par', 'nexopos_advanced' );?>',
                namespace   :   'author_name'
            }
        ]
    }
});
