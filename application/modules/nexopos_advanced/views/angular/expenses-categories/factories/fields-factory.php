tendooApp.factory( 'expensesCategoriesFields', [ 'sharedOptions', function( sharedOptions ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Expense Category Name', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '<?php echo _s( 'Veuillez fournir un nom à la catégorie.', 'nexopos_advanced' );?>',
        validation  :   {
            required        :   true
        }
    },{
        type        :   'textarea',
        label       :   '<?php echo _s( 'Description', 'nexopos_advanced' );?>',
        model       :   'description',
        desc        :   '<?php echo _s( 'Détails de la dépense', 'nexopos_advanced' );?>'
    }]
}]);
