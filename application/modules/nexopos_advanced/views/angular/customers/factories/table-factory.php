tendooApp.factory( 'customersTable', [ 'sharedOptions', function( sharedOptions ){
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
                text    :   '<?php echo _s( 'Statut', 'nexopos_advanced' );?>',
                namespace   :   'status'
            },
            {
                text    :   '<?php echo _s( 'Sexe', 'nexopos_advanced' );?>',
                namespace   :   'sex',
                is          :   'object',
                object      :   sharedOptions.maleOrFemale
            },
            {
                text    :   '<?php echo _s( 'Téléphone', 'nexopos_advanced' );?>',
                namespace   :   'phone'
            },
            {
                text    :   '<?php echo _s( 'Groupe', 'nexopos_advanced' );?>',
                namespace   :   'customer_group_name'
            },
            {
                text    :   '<?php echo _s( 'Date de création', 'nexopos_advanced' );?>',
                namespace   :   'date_creation',
                is          :   'date_span'
            },
            {
                text    :   '<?php echo _s( 'Modifié le', 'nexopos_advanced' );?>',
                namespace   :   'date_modification',
                is          :   'date_span'
            },
            {
                text    :   '<?php echo _s( 'Par', 'nexopos_advanced' );?>',
                namespace   :   'author_name'
            }
        ]
    }
}]);
