tendooApp.factory( 'itemsTable', function(){
    return {
        columns     :   [
            {
                text    :   '<?php echo _s( 'Nom', 'nexopos_advanced' );?>',
                namespace   :   'name'
            },
            {
                text    :   '<?php echo _s( 'Type', 'nexopos_advanced' );?>',
                namespace   :   'namespace'
            }, {
                text        :   '<?php echo _s( 'Variations', 'nexopos_advanced' );?>',
                namespace   :   'variations_nbr',
                width   :   120
            },{
                text    :   '<?php echo _s( 'Statut', 'nexopos_advanced' );?>',
                namespace   :   'status',
                width   :   100
            },
            {
                text    :   '<?php echo _s( 'Crée le', 'nexopos_advanced' );?>',
                namespace   :   'date_creation',
                width       :   170
            },
            {
                text    :   '<?php echo _s( 'Modifié le', 'nexopos_advanced' );?>',
                namespace   :   'date_modification',
                width       :   170
            },
            {
                text    :   '<?php echo _s( 'Par', 'nexopos_advanced' );?>',
                namespace   :   'author_name',
                width       :   80
            }
        ]
    }
});
