tendooApp.factory( 'taxesFields', [ 'options', function( options ){
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
        model   :   'type',
        options     :   options.percentOrFlat,
        validation : {
            required : true
        },
        desc        :   '<?php echo _s( 'Veuillez choisir le type de la taxe.', 'nexopos_advanced' );?>'
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Valeur', "nexopos_advanced" );?>',
        model   :   'value',
        validation : {
            decimal : true,
            required: true
        },
        desc        :   '<?php echo _s( 'Veuillez définir la valeur de la taxe. Vous devez définir une valeur qui correspond au type de taxe choisi plus tôt.', 'nexopos_advanced' );?>'
    },{
        type    :   'textarea',
        label   :   '<?php echo _s( 'Description', "nexopos_advanced" );?>',
        model   :   'description',
        desc        :   '<?php echo _s( 'Fournir une description à la taxe.', 'nexopos_advanced' );?>'
    }]
}]);
