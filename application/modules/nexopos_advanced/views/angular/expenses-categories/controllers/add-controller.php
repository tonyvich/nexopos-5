var expensesCategories          =   function( $scope, $http, expensesCategoriesTextDomain,  expensesCategoriesFields, expensesCategoriesResource, $location, validate, sharedDocumentTitle ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter une catégorie de dépenses', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   expensesCategoriesTextDomain;
    $scope.fields           =   expensesCategoriesFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   new sharedValidate();



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
            },function( returned ){

                $scope.submitDisabled   =   false;

                if( returned.data.status === 'alreadyExists' ) {
                    sharedAlert.warning( '<?php echo _s( 'Le nom de cette catégorie de dépense est déjà en cours d\'utilisation, veuillez choisir un autre nom.', 'nexopos_advanced' );?>' );
                }

                if( returned.data.status === 'forbidden' || returned.status == 500 ) {
                    sharedAlert.warning( '<?php echo _s( 'Une erreur s\'est produite durant l\'opération.', 'nexopos_advanced' );?>' );
                }
            }
        )
    }
}

expensesCategories.$inject    =   [ '$scope', '$http','expensesCategoriesTextDomain', 'expensesCategoriesFields', 'expensesCategoriesResource', '$location', 'sharedValidate', 'sharedDocumentTitle' ];
tendooApp.controller( 'expensesCategories', expensesCategories );
