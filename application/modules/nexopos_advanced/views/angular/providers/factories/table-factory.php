tendooApp.factory( 'providerTable', function(){
    return {
        columns     :   [
            {
                text    :   '<?php echo _s( 'Nom', 'nexopos_advanced' );?>',
                namespace   :   'name'
            },
            {
                text    :   '<?php echo _s( 'Adresse mail', 'nexopos_advanced' );?>',
                namespace   :   'email'
            },
            {
                text    :   '<?php echo _s( 'Numéro de téléphone', 'nexopos_advanced' );?>',
                namespace   :   'phone'
            },
            {
                text    :   '<?php echo _s( 'Description', 'nexopos_advanced' );?>',
                namespace   :   'description'
            },
            {
                text    :   '<?php echo _s( 'Date de creation', 'nexopos_advanced' );?>',
                namespace   :   'date_creation'
            },
            {
                text    :   '<?php echo _s( 'Date de modification', 'nexopos_advanced' );?>',
                namespace   :   'date_modification'
            },
            {
                text    :   '<?php echo _s( 'Par', 'nexopos_advanced' );?>',
                namespace   :   'author_name'
            }
        ]
    }
});
