tendooApp.factory( 'registersFields', [ 'options', function( options ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Caisse Name', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '',
        validation  :   {
            required        :   true
        }
    },{
        type    :   'dropdown_multiselect',
        label   :   '<?php echo __( 'Utilisateurs authorisés', 'nexopos_advanced' );?>',
        model   :   'authorized_users',
        options :   [{id : 1, label: 'test'},{id : 2, label : 'test2'}]
    },{
        type    :   'textarea',
        label   :   '<?php echo _s( 'Description', "nexopos_advanced" );?>',
        model   :   'description',
        desc    :   '<?php echo _s( 'Fournir plus de détails sur la caisse.', 'nexopos_advanced' );?>'
    }]
}]);
