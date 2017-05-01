tendooApp.factory( 'itemsTable', [ 'sharedOptions', function( sharedOptions ){
    return {
        columns     :   [
            {
                text    :   '<?php echo _s( 'Variation', 'nexopos_advanced' );?>',
                namespace   :   'variation_name'
            },
            {
                text    :   '<?php echo _s( 'Prix de vente', 'nexopos_advanced' );?>',
                namespace   :   'sale_price',
                is          :   'money',
                width       :   110
            },
            {
                text    :   '<?php echo _s( 'Prix d\'achat', 'nexopos_advanced' );?>',
                namespace   :   'purchase_price',
                is          :   'money',
                width       :   120
            },
            {
                text    :   '<?php echo _s( 'Qte', 'nexopos_advanced' );?>',
                namespace   :   'available_quantity',
                width       :   50
            },
            {
                text    :   '<?php echo _s( 'Sold', 'nexopos_advanced' );?>',
                namespace   :   'sold_quantity',
                width       :   50
            },
            {
                text    :   '<?php echo _s( 'Damaged', 'nexopos_advanced' );?>',
                namespace   :   'defective_quantity',
                width       :   50
            },
            {
                text    :   '<?php echo _s( 'Type', 'nexopos_advanced' );?>',
                namespace   :   'namespace'
            },{
                text    :   '<?php echo _s( 'Statut', 'nexopos_advanced' );?>',
                namespace   :   'status',
                width   :   100
            },
            {
                text    :   '<?php echo _s( 'Crée le', 'nexopos_advanced' );?>',
                namespace   :   'date_creation',
                is          :   'date_span',
                width       :   120
            },
            {
                text    :   '<?php echo _s( 'Modifié le', 'nexopos_advanced' );?>',
                namespace   :   'date_modification',
                is          :   'date_span',
                width       :   120
            },
            {
                text    :   '<?php echo _s( 'Par', 'nexopos_advanced' );?>',
                namespace   :   'author_name',
                width       :   80
            }
        ]
    }
}]);
