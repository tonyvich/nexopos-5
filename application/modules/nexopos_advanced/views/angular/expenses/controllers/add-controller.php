var expenses          =   function( $scope, $http, expensesTextDomain,  expensesFields, expensesResource, $location, validate,sharedExpensesCategoriesResource, rawToOptions, sharedDocumentTitle ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter une dépense', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   expensesTextDomain;
    $scope.fields           =   expensesFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   new sharedValidate();

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
            },function( returned ){

                $scope.submitDisabled   =   false;

                if( returned.data.status === 'alreadyExists' ) {
                    sharedAlert.warning( '<?php echo _s( 'Le nom cette dépense est déjà en cours d\'utilisation, veuillez choisir un autre nom.', 'nexopos_advanced' );?>' );
                }

                if( returned.data.status === 'forbidden' || returned.status == 500 ) {
                    sharedAlert.warning( '<?php echo _s( 'Une erreur s\'est produite durant l\'opération.', 'nexopos_advanced' );?>' );
                }
            }
        )
    }
}

expenses.$inject    =   [ '$scope', '$http','expensesTextDomain', 'expensesFields', 'expensesResource', '$location', 'sharedValidate', 'sharedExpensesCategoriesResource', 'rawToOptions', 'sharedDocumentTitle' ];
tendooApp.controller( 'expenses', expenses );
