tendooApp.factory( 'sharedEntryActions', function(){
    return [
        {
            namespace   :   'edit',
            name        :   '<?php echo _s( 'Modifier', 'nexopos_advanced' );?>',
            path        :   '/deliveries/edit/'
        },{
            namespace   :   'delete',
            name        :   '<?php echo _s( 'Supprimer', 'nexopos_advanced' );?>'
        }
    ];
});
