tendooApp.factory( 'customersFields', [ 'options', function( options ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Nom du client', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '',
        validation  :   {
            required        :   true
        }
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Prénom', "nexopos_advanced" );?>',
        model   :   'surname',
        desc    :   '',
        validation  :   {
            required        :   true
        }
    },{
        type    :   'select',
        label   :   '<?php echo __( 'Sexe', 'nexopos_advanced' );?>',
        model   :   'sex',
        options     :   options.maleOrFemale,
        validation : {
            required : true
        }
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Téléphone', "nexopos_advanced" );?>',
        model   :   'phone',
        validation  :   {
            digit       :   true,
            required    :   true
        }
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Adresse email', "nexopos_advanced" );?>',
        model   :   'email',
        validation  :   {
            email      :   true,
            required   :   true
        }
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Adresse', "nexopos_advanced" );?>',
        model   :   'address',
        validation  :   {
            required    :   true
        }
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Boite postale', "nexopos_advanced" );?>',
        model   :   'pobox',
        validation  :   {
            required    :   true
        }
    },{
        type    :   'select',
        label   :   '<?php echo __( 'Groupe parent', 'nexopos_advanced' );?>',
        model   :   'ref_group',
        options     :   options.percentOrFlat,
        validation : {
            required : true
        }
    },{
        type        :   'textarea',
        label       :   '<?php echo __( 'Description', 'nexopos_advanced' );?>',
        model       :   'description',
    }]
}]);
