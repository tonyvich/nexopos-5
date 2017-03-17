tendooApp.factory( 'registersFields', [ 'sharedOptions', function( sharedOptions ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Caisse Name', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '<?php echo _s( 'Veuillez spécifier le nom de la caisse.', 'nexopos_advanced' );?>',
        validation  :   {
            required        :   true
        }
    },{
        type    :   'dropdown_multiselect',
        label   :   '<?php echo __( 'Utilisateurs authorisés', 'nexopos_advanced' );?>',
        model   :   'authorized_users',
        desc    :   '<?php echo _s( 'L\'accès à cette caisse peut être limitée à certains utilisateurs.', 'nexopos_advanced' );?>'
    },{
        type    :   'select',
        label   :   '<?php echo __( 'Statut', 'nexopos_advanced' );?>',
        model   :   'status',
        options :   sharedOptions.status,
        desc    :   '<?php echo _s( 'Le status donne un état de la caisse.', 'nexopos_advanced' );?>'
    },{
        type    :   'textarea',
        label   :   '<?php echo _s( 'Description', "nexopos_advanced" );?>',
        model   :   'description',
        desc    :   '<?php echo _s( 'Fournir plus de détails sur la caisse.', 'nexopos_advanced' );?>'
    }]
}]);
