tendooApp.factory( 'taxesTable', ['sharedOptions', function( sharedOptions ){
    return {
        columns     :   [
            {
                text    :   '<?php echo _s( 'Nom', 'nexopos_advanced' );?>',
                namespace   :   'name'
            },
            {
                text    :   '<?php echo _s( 'Type', 'nexopos_advanced' );?>',
                namespace   :   'tax_type',
                is          :   'object',
                object      :   sharedOptions.percentOrFlat
            },
            {
                text    :   '<?php echo _s( 'Valeur', 'nexopos_advanced' );?>',
                namespace   :   'tax_percent'
            },
            {
                text    :   '<?php echo _s( 'Valeur', 'nexopos_advanced' );?>',
                namespace   :   'tax_amount',
                is          :   'money'
            },
            {
                text    :   '<?php echo _s( 'Date de creation', 'nexopos_advanced' );?>',
                namespace   :   'date_creation',
                is          :   'date_span'
            },
            {
                text        :   '<?php echo _s( 'Date de modification', 'nexopos_advanced' );?>',
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
