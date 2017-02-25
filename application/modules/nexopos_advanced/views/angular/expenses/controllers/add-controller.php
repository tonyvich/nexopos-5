var expenses          =   function( $scope, $http, expensesTextDomain,  expensesFields, expensesResource, $location, validate,sharedExpensesCategoriesResource, rawToOptions, sharedDocumentTitle ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter une dépense', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   expensesTextDomain;
    $scope.fields           =   expensesFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   validate;

    // Settings options for selecting category parent

    sharedExpensesCategoriesResource.get(
        function(data){
            $scope.fields[3].options = rawToOptions(data.entries, 'id', 'name');
        }
    );

    $scope.submit       =   function(){
        $scope.item.author          =   <?= User::id()?>;
        $scope.item.date_creation   =   tendoo.now();

        if( ! validate.run( $scope.fields, $scope.item ).isValid ) {
            return validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        expensesResource.save(
            $scope.item,
            function(){
                $location.url( '/expenses?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

expenses.$inject    =   [ '$scope', '$http','expensesTextDomain', 'expensesFields', 'expensesResource', '$location', 'validate', 'sharedExpensesCategoriesResource', 'rawToOptions', 'sharedDocumentTitle' ];
tendooApp.controller( 'expenses', expenses );
