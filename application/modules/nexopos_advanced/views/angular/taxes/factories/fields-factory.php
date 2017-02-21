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
        model   :   'ref_parent',
        options     :   options.percentOrFlat,
        validation : {
            required : true
        }
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Valeur', "nexopos_advanced" );?>',
        model   :   'value',
        validation : {
            decimal : true
        }
    },{
        type    :   'textarea',
        label   :   '<?php echo _s( 'Description', "nexopos_advanced" );?>',
        model   :   'description',
    }]
}]);
