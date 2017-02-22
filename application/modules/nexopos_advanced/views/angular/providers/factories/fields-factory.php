tendooApp.factory( 'providersFields', [ 'options', function( options ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Provider Name', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '',
        validation  :   {
            required        :   true
        }
    },{
        type    :   'text',
        label   :   '<?php echo __( 'Email', 'nexopos_advanced' );?>',
        model   :   'email',
        validation : {
            required : true,
            email : true
        }
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Numéro de téléphone', "nexopos_advanced" );?>',
        model   :   'phone',
        validation : {
            decimal : true,
            required: true
        }
    },{
        type    :   'textarea',
        label   :   '<?php echo _s( 'Description', "nexopos_advanced" );?>',
        model   :   'description',
    }]
}]);
