var providersEdit      =   function( providersEditTextDomain, $scope, $http, $route, providersFields, providersResource, $location, validate ) {
    $scope.textDomain       =   providersEditTextDomain;
    $scope.fields           =   providersFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   validate;

    // Get Resource when loading
    $scope.submitDisabled   =   true;
    providersResource.get({
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

        if( angular.isDefined( $scope.item.shipping_date ) ) {
            $scope.item.shipping_date   =   moment( $scope.item.shipping_date ).format();
        }

        if( ! validate.run( $scope.fields, $scope.item ).isValid ) {
            return validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        providersResource.update({
                id  :   $route.current.params.id // make sure route is added as dependency
            },
            $scope.item,
            function(){
                $location.url( '/providers?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

providersEdit.$inject    =   [ 'providersEditTextDomain', '$scope', '$http', '$route', 'providersFields', 'providersResource', '$location', 'validate' ];
tendooApp.controller( 'providersEdit', providersEdit );
