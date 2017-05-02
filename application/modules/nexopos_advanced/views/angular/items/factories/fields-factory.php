tendooApp.factory( 'itemsFields', [ '$location', 'sharedOptions', function( $location, sharedOptions ){
    return [
        {
            type    :   'hidden',
            model   :   'name',
            validation  :   {
                required    :   true
            },
            desc    :   '<?php echo _s( 'Le nom du produit permet de le distinguer des autres produits.', 'nexopos_advanced' );?>',
            label   :   '<?php echo _s( 'Nom du produit', 'nexopos' );?>'
        },
        {
            type    :   'select',
            label   :   '<?php echo _s( 'Catégorie', "nexopos_advanced" );?>',
            model   :   'ref_category',
            desc    :   '<?php echo _s( 'Attribuer un produit à une catégorie permet de regroupe les produits similaires.', 'nexopos_advanced' );?>',
            validation  :   {
                required        :   true
            },
            buttons     :   [{
                class   :   'default',
                click   :   function( item ) {
                   return $location.url( 'categories/add?fallback=items/add/' + item.namespace );
                },
                icon    :   'fa fa-plus'
            }]
        },{
            type    :   'select',
            label   :   '<?php echo _s( 'Unité', "nexopos_advanced" );?>',
            model   :   'ref_unit',
            desc    :   '<?php echo _s( 'Choisir une valeur de mesure pour le produit.', 'nexopos_advanced' );?>',
            validation  :   {
                required        :   true
            },
            buttons     :   [{
                class   :   'default',
                click   :   function( item ) {
                    return $location.url( 'units/add?fallback=items/add/' + item.namespace );
                },
                icon    :   'fa fa-plus'
            }]
        },{
            type    :   'select',
            label   :   '<?php echo _s( 'Taxe', "nexopos_advanced" );?>',
            model   :   'ref_tax',
            desc    :   '<?php echo _s( 'Le prix de vente variera en fonction de la taxe que vous appliquerez au produit.', 'nexopos_advanced' );?>',
            validation  :   {
                required        :   true
            },
            buttons     :   [{
                class   :   'default',
                click   :   function( item ) {
                    return $location.url( 'taxes/add?fallback=items/add/' + item.namespace );
                },
                icon    :   'fa fa-plus'
            }]
        },{
            type    :   'select',
            label   :   '<?php echo _s( 'Rayon', "nexopos_advanced" );?>',
            model   :   'ref_department',
            desc    :   '<?php echo _s( 'Vous permet de regrouper les produits par rayon (ou département).', 'nexopos_advanced' );?>',
            buttons     :   [{
                class   :   'default',
                click   :   function( item ) {
                    return $location.url( 'departments/add?fallback=items/add/' + item.namespace );
                },
                icon    :   'fa fa-plus'
            }]
        },{
            type    :   'select',
            label   :   '<?php echo _s( 'Status', "nexopos_advanced" );?>',
            model   :   'status',
            desc    :   '<?php echo _s( 'Rendre le produit disponible pour la vente.', 'nexopos_advanced' );?>',
            validation  :   {
                required        :   true
            },
            options     :   sharedOptions.yesOrNo
        }

    ]
}]);
