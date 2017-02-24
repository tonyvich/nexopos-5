tendooApp.factory( 'expensesFields', [ 'options', function( options ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Expense Name', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '',
        validation  :   {
            required        :   true
        }
    },{
        type        :   'text',
        label       :   '<?php echo __( 'Montant', 'nexopos_advanced' );?>',
        model       :   'amount',
        validation  :   {
            required : true,
            decimal  : true
        }
    },{
        type        :   'text',
        label       :   '<?php echo __( 'Image', 'nexopos_advanced' );?>',
        model       :   'image_url',
        validation  :   {
            required : true,
        }
    },{
        type        :   'select',
        label       :   '<?php echo __( 'Catégorie', 'nexopos_advanced' );?>',
        model       :   'ref_category',
        options     :    options.yesOrNo,
        validation  :    {
            required   :   true
        }
    },{
        type        :   'textarea',
        label       :   '<?php echo __( 'Description', 'nexopos_advanced' );?>',
        model       :   'description',
    }]
}]);
