tendooApp.factory( 'departmentsFields', [ 'options', function( options ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Nom du rayon', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '',
        validation  :   {
            required        :   true
        }
    },{
        type    :   'text',
        label   :   '<?php echo __( 'Image', 'nexopos_advanced' );?>',
        model   :   'image_url',
        desc    :   '<?php echo _s( 'Vous pouvez ajouter une représentation graphique d\'un rayon', 'nexopos_advanced' );?>',
        validation  :   {
            url     :   true
        }
    },{
        type        :   'textarea',
        label       :   '<?php echo __( 'Description', 'nexopos_advanced' );?>',
        model       :   'description',
        desc        :   '<?php echo _s( 'Vous pouvez définir une date à laquelle la livraison a été ou sera livrée.', 'nexopos_advanced' );?>'
    }]
}]);
