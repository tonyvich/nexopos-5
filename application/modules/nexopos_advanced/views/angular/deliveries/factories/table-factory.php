tendooApp.factory( 'deliveriesTable', ['sharedOptions', function( sharedOptions ){
    return {
        columns     :   [
            {
                text    :   '<?php echo _s( 'Intitulé', 'nexopos_advanced' );?>',
                namespace   :   'name',
                width       :   200
            },
            {
                text        :   '<?php echo _s( 'Coût d\'achat', 'nexopos_advanced' );?>',
                namespace   :   'purchase_cost',
                is          :   'money',
                width       :   150
            },
            {
                text    :   '<?php echo _s( 'Coût Automatique', 'nexopos_advanced' );?>',
                namespace   :   'auto_cost',
                is          :   'object',
                object      :   sharedOptions.yesOrNo,
                width       :   130
            },
            {
                text    :   '<?php echo _s( 'Livré le', 'nexopos_advanced' );?>',
                namespace   :   'shipping_date',
                is          :   'date_span',
                width       :   160
            },
            {
                text    :   '<?php echo _s( 'Crée le', 'nexopos_advanced' );?>',
                namespace   :   'date_creation',
                is          :   'date_span',
                width       :   160
            },
            {
                text    :   '<?php echo _s( 'Modifié le', 'nexopos_advanced' );?>',
                namespace   :   'date_modification',
                is          :   'date_span',
                width       :   160
            },
            {
                text    :   '<?php echo _s( 'Par', 'nexopos_advanced' );?>',
                namespace   :   'author_name',
                width       :   80
            }
        ]
    }
}]);
