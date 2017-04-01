tendooApp.factory( 'couponsTable', [ 'sharedOptions', function( sharedOptions ){
    return {
        columns     :   [
            {
                text    :   '<?php echo _s( 'Nom', 'nexopos_advanced' );?>',
                namespace   :   'name'
            },
            {
                text    :   '<?php echo _s( 'Type', 'nexopos_advanced' );?>',
                namespace   :   'discount_type',
                is          :   'object',
                object      :   sharedOptions.percentOrFlat
            },
            {
                text    :   '<?php echo _s( 'Montant', 'nexopos_advanced' );?>',
                namespace   :   'discount_amount',
                is          :   'money'
            },
            {
                text    :   '<?php echo _s( 'Pourcentage', 'nexopos_advanced' );?>',
                namespace   :   'discount_percent'
            },
            {
                text    :   '<?php echo _s( 'Début', 'nexopos_advanced' );?>',
                namespace   :   'start_date',
                is          :   'date_span'
            },
            {
                text    :   '<?php echo _s( 'Fin', 'nexopos_advanced' );?>',
                namespace   :   'end_date',
                is          :   'date_span'
            },
            {
                text    :   '<?php echo _s( "Limite", 'nexopos_advanced' );?>', // limite d'utilisation
                namespace   :   'usage_limit'
            },
            {
                text    :   '<?php echo _s( 'Date de creation', 'nexopos_advanced' );?>',
                namespace   :   'date_creation',
                is          :   'date_span'
            },
            {
                text    :   '<?php echo _s( 'Date de modification', 'nexopos_advanced' );?>',
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
