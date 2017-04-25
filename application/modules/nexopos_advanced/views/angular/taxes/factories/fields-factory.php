tendooApp.factory( 'taxesFields', [ 'sharedOptions', function( sharedOptions ){
    console.log( sharedOptions );
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Taxes Name', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '',
        validation  :   {
            required        :   true
        }
    },{
        type    :   'select',
        label   :   '<?php echo __( 'Type de la taxe', 'nexopos_advanced' );?>',
        model   :   'tax_type',
        options     :   sharedOptions.percentOrFlat,
        validation : {
            required : true
        },
        desc        :   '<?php echo _s( 'Veuillez choisir le type de la taxe.', 'nexopos_advanced' );?>'
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Pourcentage', "nexopos_advanced" );?>',
        model   :   'tax_percent',
        validation : {
            decimal : true,
        },
        desc        :   '<?php echo _s( 'Pour une taxe calculée en pourcentage', 'nexopos_advanced' );?>',
        hide        :   function( item ) {
            return item.tax_type != 'percent' ? true : false;
        }
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Montant', "nexopos_advanced" );?>',
        model   :   'tax_amount',
        validation : {
            decimal : true,
        },
        desc        :   '<?php echo _s( 'Pour une taxe fixe en montant', 'nexopos_advanced' );?>',
        hide        :   function( item ) {
            return item.tax_type != 'flat' ? true : false;
        }
    },{
        type    :   'textarea',
        label   :   '<?php echo _s( 'Description', "nexopos_advanced" );?>',
        model   :   'description',
        desc        :   '<?php echo _s( 'Fournir une description à la taxe.', 'nexopos_advanced' );?>'
    }]
}]);
