tendooApp.factory( 'categoryTable', function(){
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
                text    :   '<?php echo _s( 'Parent', 'nexopos_advanced' );?>',
                namespace   :   'ref_parent'
            },
            {
                text    :   '<?php echo _s( 'Image', 'nexopos_advanced' );?>',
                namespace   :   'image_url'
            },
            {
                text    :   '<?php echo _s( 'Description', 'nexopos_advanced' );?>',
                namespace   :   'description'
            },
            {
                text    :   '<?php echo _s( 'Par', 'nexopos_advanced' );?>',
                namespace   :   'author'
            }
        ]
    }
});
