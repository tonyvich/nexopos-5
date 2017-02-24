tendooApp.factory( 'categoryTable', function(){
    return {
        columns     :   [
            {
                text    :   '<?php echo _s( 'Nom', 'nexopos_advanced' );?>',
                namespace   :   'name'
            },{
                text    :   '<?php echo _s( 'Parent', 'nexopos_advanced' );?>',
                namespace   :   'parent_name'
            },{
                text    :   '<?php echo _s( 'Image', 'nexopos_advanced' );?>',
                namespace   :   'image_url'
            },{
                text    :   '<?php echo _s( 'Par', 'nexopos_advanced' );?>',
                namespace   :   'author_name'
            }
        ]
    }
});
