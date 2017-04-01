tendooApp.factory( 'customersGroupsTable', ['sharedOptions', function( sharedOptions ){
    return {
        columns     :   [
            {
                text    :   '<?php echo _s( 'Nom', 'nexopos_advanced' );?>',
                namespace   :   'name',
                width :          150
            },
            {
                text    :   '<?php echo _s( 'Réductions', 'nexopos_advanced' );?>',
                namespace   :   'enable_discount',
                is          :   'object',
                object      :   sharedOptions.yesOrNo
            },
            {
                text    :   '<?php echo _s( 'Début réductions', 'nexopos_advanced' );?>',
                namespace   :   'discount_start',
                is          :   'date_span',
                width       :   160
            },
            {
                text    :   '<?php echo _s( 'Fin réductions', 'nexopos_advanced' );?>',
                namespace   :   'discount_end',
                is          :   'date_span',
                width       :   160
            },
            {
                text    :   '<?php echo _s( 'Type réductions', 'nexopos_advanced' );?>',
                namespace   :   'discount_type',
                is          :   'object',
                object      :   sharedOptions.percentOrFlat,
                width       :   100
            },
            {
                text    :   '<?php echo _s( 'Valeur réduction', 'nexopos_advanced' );?>',
                namespace   :   'discount_value',
                width       :   120
            },
            {
                text    :   '<?php echo _s( 'Date de création', 'nexopos_advanced' );?>',
                namespace   :   'date_creation',
                is          :   'date_span',
                width       :    150
            },
            {
                text    :   '<?php echo _s( 'Modifié le', 'nexopos_advanced' );?>',
                namespace   :   'date_modification',
                is          :   'date_span',
                width       :   150
            },
            {
                text    :   '<?php echo _s( 'Par', 'nexopos_advanced' );?>',
                namespace   :   'author_name',
                width       :   80
            }
        ]
    }
}]);
