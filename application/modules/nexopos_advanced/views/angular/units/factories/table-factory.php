tendooApp.factory( 'unitTable', function(){
    return {
        columns     :   [
            {
                text    :   '<?php echo _s( 'Nom', 'nexopos_advanced' );?>',
                namespace   :   'name'
            },{
                text    :   '<?php echo _s( 'Code', 'nexopos_advanced' );?>',
                namespace   :   'code'
            },{
                text    :   '<?php echo _s( 'Date de creation', 'nexopos_advanced' );?>',
                namespace   :   'date_creation',
                is          :   'date_span'
            },{
                text    :   '<?php echo _s( 'Date de modification', 'nexopos_advanced' );?>',
                namespace   :   'date_modification',
                is          :   'date_span'
            },{
                text    :   '<?php echo _s( 'Par', 'nexopos_advanced' );?>',
                namespace   :   'author_name'
            }
        ]
    }
});
