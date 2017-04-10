var expensesEdit      =   function(
    $scope,
    $http,
    $route,
    $location,
    expensesEditTextDomain,
    expensesFields,
    expensesResource,
    expensesCategoriesResource,
    sharedValidate,
    sharedRawToOptions,
    sharedDocumentTitle,
    sharedMoment
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Modifier une dépense', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   expensesEditTextDomain;
    $scope.fields           =   expensesFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   new sharedValidate();

    // Settings options for selecting category parent

    expensesCategoriesResource.get(
        function(data){
            $scope.fields[3].options = sharedRawToOptions(data.entries, 'id', 'name');
        }
    );

    // Get Resource when loading
    $scope.submitDisabled   =   true;
    expensesResource.get({
        id  :  $route.current.params.id // make sure route is added as dependency
    },function( entry ){
        $scope.submitDisabled   =   false;
        $scope.item             =   entry;
    })

    $scope.submit       =   function(){
        $scope.item.author              =   <?= User::id()?>;
        $scope.item.date_modification   =   sharedMoment.now();


        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        expensesResource.update({
                id  :   $route.current.params.id // make sure route is added as dependency
            },
            $scope.item,
            function(){
                $location.url( '/expenses?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

expensesEdit.$inject    =   [
    '$scope',
    '$http',
    '$route',
    '$location',
    'expensesEditTextDomain',
    'expensesFields',
    'expensesResource',
    'expensesCategoriesResource',
    'sharedValidate',
    'sharedRawToOptions',
    'sharedDocumentTitle',
    'sharedMoment'
];

tendooApp.controller( 'expensesEdit', expensesEdit );
