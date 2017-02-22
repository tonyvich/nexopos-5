tendooApp.factory( 'customersGroupsTable', function(){
    return {
        columns     :   [
            {
                text    :   '<?php echo _s( 'Nom du groupe', 'nexopos_advanced' );?>',
                namespace   :   'name'
            },
            {
                text    :   '<?php echo _s( 'Réductions', 'nexopos_advanced' );?>',
                namespace   :   'enable_discount'
            },
            {
                text    :   '<?php echo _s( 'Début des réductions', 'nexopos_advanced' );?>',
                namespace   :   'discount_start'
            },
            {
                text    :   '<?php echo _s( 'Fin des réductions', 'nexopos_advanced' );?>',
                namespace   :   'discount_end'
            },
            {
                text    :   '<?php echo _s( 'Type de réductions', 'nexopos_advanced' );?>',
                namespace   :   'discount_type'
            },
            {
                text    :   '<?php echo _s( 'Valeur de la réduction', 'nexopos_advanced' );?>',
                namespace   :   'discount_value'
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
