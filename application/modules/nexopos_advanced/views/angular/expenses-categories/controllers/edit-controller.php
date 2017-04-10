var expensesCategoriesEdit      =   function(
    expensesCategoriesEditTextDomain,
    $scope,
    $http,
    $route,
    expensesCategoriesFields,
    expensesCategoriesResource,
    $location,
    sharedValidate,
    sharedDocumentTitle,
    sharedMoment
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Editer une catéogrie de dépenses', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   expensesCategoriesEditTextDomain;
    $scope.fields           =   expensesCategoriesFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   new sharedValidate();

    // Get Resource when loading
    $scope.submitDisabled   =   true;
    expensesCategoriesResource.get({
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

        expensesCategoriesResource.update({
                id  :   $route.current.params.id // make sure route is added as dependency
            },
            $scope.item,
            function(){
                $location.url( '/expenses-categories?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

expensesCategoriesEdit.$inject    =   [
    'expensesCategoriesEditTextDomain',
    '$scope',
    '$http',
    '$route',
    'expensesCategoriesFields',
    'expensesCategoriesResource',
    '$location',
    'sharedValidate',
    'sharedDocumentTitle',
    'sharedMoment'
];
tendooApp.controller( 'expensesCategoriesEdit', expensesCategoriesEdit );
