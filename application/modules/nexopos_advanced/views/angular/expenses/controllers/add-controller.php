var expenses          =   function(
    $scope,
    $http,
    $location,
    expensesTextDomain,
    expensesFields,
    expensesResource,
    expensesCategoriesResource,
    sharedValidate,
    sharedRawToOptions,
    sharedDocumentTitle,
    sharedMoment,
    sharedFieldEditor
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter une dépense', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   expensesTextDomain;
    $scope.fields           =   expensesFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   new sharedValidate();

    // Settings options for selecting category parent

    expensesCategoriesResource.get(
        function(data){
            sharedFieldEditor('ref_category',$scope.fields).options = sharedRawToOptions(data.entries, 'id', 'name');
        }
    );

    $scope.submit       =   function(){
        $scope.item.author          =   <?= User::id()?>;
        $scope.item.date_creation   =   sharedMoment.now();

        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
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

expenses.$inject    =   [
    '$scope',
    '$http',
    '$location',
    'expensesTextDomain',
    'expensesFields',
    'expensesResource',
    'expensesCategoriesResource',
    'sharedValidate',
    'sharedRawToOptions',
    'sharedDocumentTitle',
    'sharedMoment',
    'sharedFieldEditor'
];

tendooApp.controller( 'expenses', expenses );
