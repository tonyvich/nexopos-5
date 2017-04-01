tendooApp.factory( 'customersGroupsTable', ['sharedOptions', function( sharedOptions ){
    return {
        columns     :   [
            {
                text    :   '<?php echo _s( 'Nom du groupe', 'nexopos_advanced' );?>',
                namespace   :   'name'
            },
            {
                text    :   '<?php echo _s( 'Réductions', 'nexopos_advanced' );?>',
                namespace   :   'enable_discount',
                is          :   'object',
                object      :   sharedOptions.yesOrNo
            },
            {
                text    :   '<?php echo _s( 'Début des réductions', 'nexopos_advanced' );?>',
                namespace   :   'discount_start',
                is          :   'date_span'
            },
            {
                text    :   '<?php echo _s( 'Fin des réductions', 'nexopos_advanced' );?>',
                namespace   :   'discount_end',
                is          :   'date_span'
            },
            {
                text    :   '<?php echo _s( 'Type de réductions', 'nexopos_advanced' );?>',
                namespace   :   'discount_type',
                is          :   'object',
                object      :   sharedOptions.percentOrFlat
            },
            {
                text    :   '<?php echo _s( 'Valeur de la réduction', 'nexopos_advanced' );?>',
                namespace   :   'discount_value'
            },
            {
                text    :   '<?php echo _s( 'Date de création', 'nexopos_advanced' );?>',
                namespace   :   'date_creation',
                is          :   'date_span'
            },
            {
                text    :   '<?php echo _s( 'Modifié le', 'nexopos_advanced' );?>',
                namespace   :   'date_modification',
                is          :   'date_span'
            },
            {
                text    :   '<?php echo _s( 'Par', 'nexopos_advanced' );?>',
                namespace   :   'author_name'
            }
        ]
    }
}]);
