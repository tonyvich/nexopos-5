tendooApp.factory( 'storesFields', [ 'sharedOptions', function( sharedOptions ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Nom', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '<?php echo _s( 'Nom de la boutique', 'nexopos_advanced' );?>',
        validation  :   {
            required        :   true
        }
    },{
        type    :   'dropdown_multiselect',
        label   :   '<?php echo __( 'Utilisateurs autorisés', 'nexopos_advanced' );?>',
        model   :   'authorized_users',
        options :   [{id : 1, label: 'test'}],
        desc    :   '<?php echo _s( 'L\'accès à une boutique peut être restreinte à un nombre définit d\'utilisateurs.', 'nexopos_advanced' );?>'
    },{
        type    :   'select',
        label   :   '<?php echo __( 'Statut', 'nexopos_advanced' );?>',
        model   :   'status',
        options :   sharedOptions.status,
        validation  :  {
            required   :  true
        },
        desc            :   '<?php echo _s( 'Etat de la boutique', 'nexopos_advanced' );?>'
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Image', "nexopos_advanced" );?>',
        model   :   'image',
        desc    :   '<?php echo _s( 'miniature de la boutique', 'nexopos_advanced' );?>'
    },{
        type    :   'textarea',
        label   :   '<?php echo _s( 'Description', "nexopos_advanced" );?>',
        model   :   'description',
        desc    :   '<?php echo _s( 'Description de la boutique.', 'nexopos_advanced' );?>'
    }]
}]);
