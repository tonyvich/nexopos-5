tendooApp.factory( 'itemsTable', [ 
    'sharedOptions', 
    'sharedRawToOptions', 
    'itemsTypes', 
    function( 
        sharedOptions, 
        sharedRawToOptions,
        itemsTypes
    ){
    return {
        columns     :   [
            {
                text    :   '<?php echo _s( 'Produit / Var.', 'nexopos_advanced' );?>',
                namespace   :   'name',
                is      :   'filter',
                filter      :   ( value, filter, col, entry ) => {
                    return value + ' (' + entry.variation_quantity + ')';
                }
            },
            {
                text    :   '<?php echo _s( 'Categorie', 'nexopos_advanced' );?>',
                namespace   :   'category_name',
                width       :   150
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
                text    :   '<?php echo _s( 'Type', 'nexopos_advanced' );?>',
                namespace   :   'namespace',
                is          :   'object',
                object      :   sharedRawToOptions( itemsTypes, 'namespace', 'text' )
            },
            /** 
            {
                text    :   '<?php echo _s( 'Statut', 'nexopos_advanced' );?>',
                namespace   :   'status',
                width   :   100
            },**/
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
