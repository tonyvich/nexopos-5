tendooApp.factory( 'departmentsTable',[ 'sharedOptions', function(){
    return {
        columns     :   [
            {
                text    :   '<?php echo _s( 'Intitulé', 'nexopos_advanced' );?>',
                namespace   :   'name'
            },
            {
                text    :   '<?php echo _s( 'Crée le', 'nexopos_advanced' );?>',
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
