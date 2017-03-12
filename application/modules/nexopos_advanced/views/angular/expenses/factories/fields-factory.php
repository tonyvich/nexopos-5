tendooApp.factory( 'expensesFields', [ 'options', function( options ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Expense Name', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '<?php echo _s( 'Veuillez fournir une pour cette dépense.', 'nexopos_advanced' );?>',
        validation  :   {
            required        :   true
        }
    },{
        type        :   'text',
        label       :   '<?php echo __( 'Montant', 'nexopos_advanced' );?>',
        model       :   'amount',
        desc        :   '<?php echo _s( 'Veuillez définir la valeur qui correspond à cette dépense.', 'nexopos_advanced' );?>',
        validation  :   {
            required : true,
            decimal  : true
        }
    },{
        type        :   'text',
        label       :   '<?php echo __( 'Image', 'nexopos_advanced' );?>',
        model       :   'image_url',
        desc        :   '<?php echo _s( 'Si cette dépense dispose d\'un document scanner, vous pouvez l\'attacher à ce formulaire.', 'nexopos_advanced' );?>',
        validation  :   {
            required : true,
        }
    },{
        type        :   'select',
        label       :   '<?php echo __( 'Catégorie', 'nexopos_advanced' );?>',
        model       :   'ref_category',
        desc        :   '<?php echo _s( 'Veuillez assigner cette dépense à une catégorie.', 'nexopos_advanced' );?>',
        options     :    options.yesOrNo,
        validation  :    {
            required   :   true
        }
    },{
        type        :   'textarea',
        label       :   '<?php echo __( 'Description', 'nexopos_advanced' );?>',
        model       :   'description',
        desc        :   '<?php echo _s( 'Détails sur la dépense.', 'nexopos_advanced' );?>',
    }]
}]);
