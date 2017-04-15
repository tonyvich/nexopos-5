var expensesCategories          =   function(
    $scope,
    $http,
    expensesCategoriesTextDomain,
    expensesCategoriesFields,
    expensesCategoriesResource,
    $location,
    sharedValidate,
    sharedDocumentTitle,
    sharedMoment
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter une catégorie de dépenses', 'nexopos_advanced' );?>' );

    $scope.textDomain       =   expensesCategoriesTextDomain;
    $scope.fields           =   expensesCategoriesFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   new sharedValidate();

    $scope.submit       =   function(){

        $scope.item.author          =   <?= User::id()?>;
        $scope.item.date_creation   =   sharedMoment.now();

        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        expensesCategoriesResource.save(
            $scope.item,
            function(){
                if( $location.search().fallback ) {
                    $location.url( $location.search().fallback );
                } else {
                    $location.url( '/expenses-categories?notice=done' );
                }
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

expensesCategories.$inject    =   [
    '$scope',
    '$http',
    'expensesCategoriesTextDomain',
    'expensesCategoriesFields',
    'expensesCategoriesResource',
    '$location',
    'sharedValidate',
    'sharedDocumentTitle',
    'sharedMoment'
];
tendooApp.controller( 'expensesCategories', expensesCategories );
