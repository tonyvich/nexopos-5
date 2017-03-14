tendooApp.factory( 'customersFields', [ 'sharedOptions', function( sharedOptions ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Nom du client', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '<?php echo _s( 'Veuillez fournir le nom du client', 'nexopos_advanced' );?>',
        validation  :   {
            required        :   true
        }
    },{
        type    :   'select',
        label   :   '<?php echo __( 'Groupe parent', 'nexopos_advanced' );?>',
        model   :   'ref_group',
        desc    :   '<?php echo _s( 'Veuillez déterminer à quel groupe appartient le client.', 'nexopos_advanced' );?>',
        options     :   sharedOptions.percentOrFlat,
        validation : {
            required : true
        }
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Prénom', "nexopos_advanced" );?>',
        model   :   'surname',
        desc    :   '<?php echo _s( 'Prénom du client. ce champ n\'est pas obligatoire.', 'nexopos_advanced' );?>'
    },{
        type    :   'select',
        label   :   '<?php echo __( 'Sexe', 'nexopos_advanced' );?>',
        model   :   'sex',
        options     :   sharedOptions.maleOrFemale,desc    :   '<?php echo _s( 'Vous pouvez définir le genre du client.', 'nexopos_advanced' );?>',
        validation : {
            required : true
        }
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Téléphone', "nexopos_advanced" );?>',
        model   :   'phone',
        desc    :   '<?php echo _s( 'Numéro de téléphone du client.', 'nexopos_advanced' );?>',
        validation  :   {
            number       :   true
        }
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Adresse email', "nexopos_advanced" );?>',
        model   :   'email',
        desc    :   '<?php echo _s( 'Veuillez fournir une adresse email pour le client.', 'nexopos_advanced' );?>',
        validation  :   {
            email      :   true
        }
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Adresse', "nexopos_advanced" );?>',
        model   :   'address',
        desc    :   '<?php echo _s( 'Adresse du client.', 'nexopos_advanced' );?>'
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Boite postale', "nexopos_advanced" );?>',
        model   :   'pobox',
        desc    :   '<?php echo _s( 'Boiet postale du client.', 'nexopos_advanced' );?>'
    },{
        type        :   'textarea',
        label       :   '<?php echo __( 'Description', 'nexopos_advanced' );?>',
        model       :   'description',
    }]
}]);
