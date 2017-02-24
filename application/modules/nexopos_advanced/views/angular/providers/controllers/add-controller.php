var providers          =   function( providersTextDomain, $scope, $http, providersFields, providersResource, $location, validate, rawToOptions ) {

    $scope.textDomain       =   providersTextDomain;
    $scope.fields           =   providersFields;
    $scope.item             =   {};
    $scope.validate         =   validate;

    /**
     *  Update Date
     *  @param object date
     *  @return void
    **/

    $scope.updateDate   =   function( date, key ){
        $scope.item[ key ]    =   date;
    }


    //Submitting Form

    $scope.submit       =   function(){
        $scope.item.author          =   <?= User::id()?>;
        $scope.item.date_creation   =   tendoo.now();

        if( ! validate.run( $scope.fields, $scope.item ).isValid ) {
            return validate.blurAll( $scope.fields, $scope.item );
        }
        
        $scope.submitDisabled       =   true;

        providersResource.save(
            $scope.item,
            function(){
                $location.url( '/providers?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

providers.$inject    =   [ 'providersTextDomain', '$scope', '$http', 'providersFields', 'providersResource', '$location', 'validate','rawToOptions'];
tendooApp.controller( 'providers', providers );
