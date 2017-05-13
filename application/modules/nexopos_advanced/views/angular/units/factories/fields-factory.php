tendooApp.factory( 'unitsFields', [ 'sharedOptions', function( sharedOptions ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Taxes Name', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '<?php echo _s( 'Veuillez spécifier un titre pour cette unité.', 'nexopos_advanced' );?>',
        validation  :   {
            required        :   true
        }
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Code', "nexopos_advanced" );?>',
        model   :   'code',
        desc        :   '<?php echo _s( 'veuillez spécifier le code de l\'unité.', 'nexopos_advanced' );?>'
    },{
        type        :   'text',
        label       :   '<?php echo _s( 'Quantité retranchée', "nexopos_advanced" );?>',
        model       :   'quantite_retranchee',
        desc        :   '<?php echo _s( 'Le nombre de quantité retranchée du stock', 'nexopos_advanced' );?>',
        validation  :   {
            number  :   true
        } 
    },{
        type    :   'textarea',
        label   :   '<?php echo _s( 'Description', "nexopos_advanced" );?>',
        model   :   'description',
        desc        :   '<?php echo _s( 'Fournir une description à l\'unité.', 'nexopos_advanced' );?>'
    }]
}]);
