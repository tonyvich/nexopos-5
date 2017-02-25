var expensesCategories          =   function( $scope, $http, expensesCategoriesTextDomain,  expensesCategoriesFields, expensesCategoriesResource, $location, validate, sharedDocumentTitle ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter une catégorie de dépenses', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   expensesCategoriesTextDomain;
    $scope.fields           =   expensesCategoriesFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   validate;



    $scope.submit       =   function(){
        $scope.item.author          =   <?= User::id()?>;
        $scope.item.date_creation   =   tendoo.now();

        if( ! validate.run( $scope.fields, $scope.item ).isValid ) {
            return validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        expensesCategoriesResource.save(
            $scope.item,
            function(){
                $location.url( '/expenses-categories?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

expensesCategories.$inject    =   [ '$scope', '$http','expensesCategoriesTextDomain', 'expensesCategoriesFields', 'expensesCategoriesResource', '$location', 'validate', 'sharedDocumentTitle' ];
tendooApp.controller( 'expensesCategories', expensesCategories );
