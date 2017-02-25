tendooApp.factory( 'expensesCategoriesFields', [ 'options', function( options ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Expense Category Name', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '',
        validation  :   {
            required        :   true
        }
    },{
        type        :   'textarea',
        label       :   '<?php echo __( 'Description', 'nexopos_advanced' );?>',
        model       :   'description',
    }]
}]);
