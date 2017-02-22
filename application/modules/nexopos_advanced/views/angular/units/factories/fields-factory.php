tendooApp.factory( 'unitsFields', [ 'options', function( options ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Taxes Name', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '',
        validation  :   {
            required        :   true
        }
    },{
        type    :   'textarea',
        label   :   '<?php echo _s( 'Description', "nexopos_advanced" );?>',
        model   :   'description',
        desc        :   '<?php echo _s( 'Fournir une description à la taxe.', 'nexopos_advanced' );?>'
    }]
}]);
