var expensesEdit      =   function( expensesEditTextDomain, $scope, $http, $route, expensesFields, expensesResource, $location, validate ) {
    $scope.textDomain       =   expensesEditTextDomain;
    $scope.fields           =   expensesFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   validate;

    // Get Resource when loading
    $scope.submitDisabled   =   true;
    expensesResource.get({
        id  :  $route.current.params.id // make sure route is added as dependency
    },function( entry ){
        $scope.submitDisabled   =   false;
        $scope.item             =   entry;
    })


    /**
     *  Update Date
     *  @param object date
     *  @return void
    **/

    $scope.updateDate   =   function( date, key ){
        $scope.item[ key ]    =   date;
    }

    $scope.submit       =   function(){
        $scope.item.author              =   <?= User::id()?>;
        $scope.item.date_modification   =   tendoo.now();


        if( ! validate.run( $scope.fields, $scope.item ).isValid ) {
            return validate.blurAll( $scope.fields, $scope.item );
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

expensesEdit.$inject    =   [ 'expensesEditTextDomain', '$scope', '$http', '$route', 'expensesFields', 'expensesResource', '$location', 'validate' ];
tendooApp.controller( 'expensesEdit', expensesEdit );
