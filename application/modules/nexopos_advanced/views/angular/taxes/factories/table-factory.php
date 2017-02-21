tendooApp.factory( 'taxTable', function(){
    return {
        columns     :   [
            {
                text    :   '<?php echo _s( 'Identifiant', 'nexopos_advanced' );?>',
                namespace   :   'id'
            },
            {
                text    :   '<?php echo _s( 'Nom', 'nexopos_advanced' );?>',
                namespace   :   'name'
            },
            {
                text    :   '<?php echo _s( 'Type', 'nexopos_advanced' );?>',
                namespace   :   'type'
            },
            {
                text    :   '<?php echo _s( 'Valeur', 'nexopos_advanced' );?>',
                namespace   :   'value'
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
                namespace   :   'author'
            }
        ]
    }
});
