tendooApp.factory( 'customersTable', function(){
    return {
        columns     :   [
            {
                text    :   '<?php echo _s( 'Nom', 'nexopos_advanced' );?>',
                namespace   :   'name'
            },
            {
                text    :   '<?php echo _s( 'Prénom', 'nexopos_advanced' );?>',
                namespace   :   'surname'
            },
            {
                text    :   '<?php echo _s( 'Sexe', 'nexopos_advanced' );?>',
                namespace   :   'sex'
            },
            {
                text    :   '<?php echo _s( 'Téléphone', 'nexopos_advanced' );?>',
                namespace   :   'phone'
            },
            {
                text    :   '<?php echo _s( 'Adresse mail', 'nexopos_advanced' );?>',
                namespace   :   'email'
            },
            {
                text    :   '<?php echo _s( 'Adresse', 'nexopos_advanced' );?>',
                namespace   :   'address'
            },
            {
                text    :   '<?php echo _s( 'Boite postale', 'nexopos_advanced' );?>',
                namespace   :   'pobox'
            },
            {
                text    :   '<?php echo _s( 'Groupe', 'nexopos_advanced' );?>',
                namespace   :   'customer_group_name'
            },
            {
                text    :   '<?php echo _s( 'Créé le', 'nexopos_advanced' );?>',
                namespace   :   'date_creation'
            },
            {
                text    :   '<?php echo _s( 'Modifié le', 'nexopos_advanced' );?>',
                namespace   :   'date_modification'
            },
            {
                text    :   '<?php echo _s( 'Par', 'nexopos_advanced' );?>',
                namespace   :   'author_name'
            }
        ]
    }
});
