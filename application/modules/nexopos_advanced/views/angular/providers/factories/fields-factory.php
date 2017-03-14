tendooApp.factory( 'providersFields', [ 'sharedOptions', function( sharedOptions ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Provider Name', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '<?php echo _s( 'Veuillez spécifier le nom du fournisseur.', 'nexopos_advanced' );?>',
        validation  :   {
            required        :   true
        }
    },{
        type    :   'text',
        label   :   '<?php echo __( 'Email', 'nexopos_advanced' );?>',
        model   :   'email',
        desc    :   '<?php echo _s( 'Email du fournisseur.', 'nexopos_advanced' );?>',
        validation : {
            email : true
        }
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Numéro de téléphone', "nexopos_advanced" );?>',
        model   :   'phone',
        desc    :   '<?php echo _s( 'Numéro de téléphone du fournisseur.', 'nexopos_advanced' );?>',
        validation : {
            decimal : true
        }
    },{
        type    :   'textarea',
        label   :   '<?php echo _s( 'Description', "nexopos_advanced" );?>',
        model   :   'description',
        desc    :   '<?php echo _s( 'Description pour le fournisseur', 'nexopos_advanced' );?>',
    }]
}]);
