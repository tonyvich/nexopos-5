tendooApp.factory( 'categoriesFields', [ 'options', function( options ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Categories Name', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '',
        validation  :   {
            required        :   true
        }
    },{
        type    :   'select',
        label   :   '<?php echo __( 'Catégorie Parente', 'nexopos_advanced' );?>',
        model   :   'ref_parent',
        options     :   options.yesOrNo,
        desc    :   '<?php echo _s( 'Une catégorie peut appartenir à une autre Exemple : Femmes > Robes > Soirées.', 'nexopos_advanced' );?>'
    },{
        type    :   'image_select',
        label   :   '<?php echo _s( 'Image Descriptive', "nexopos_advanced" );?>',
        model   :   'image_url',
        desc    :   '<?php echo _s( 'Veuillez une image à cette catégorie.', 'nexopos_advanced' );?>'
    },{
        type    :   'textarea',
        label   :   '<?php echo _s( 'Description', "nexopos_advanced" );?>',
        model   :   'description',
        desc    :   '<?php echo _s( 'Fournir plus de détails sur la catégorie.', 'nexopos_advanced' );?>'
    }]
}]);
