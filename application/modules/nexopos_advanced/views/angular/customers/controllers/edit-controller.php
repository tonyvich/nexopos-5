var customersEdit      =   function( customersEditTextDomain, $scope, $http, $route, customersFields, customersResource, $location, validate, sharedCustomersGroupsResource, rawToOptions) {
    $scope.textDomain       =   customersEditTextDomain;
    $scope.fields           =   customersFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   validate;

    //Setting options for selecting group

    sharedCustomersGroupsResource.get(
        function(data){
            alert('call');
            $scope.fields[7].options = rawToOptions(data.entries, 'id', 'name');
        }
    );

    // Get Resource when loading
    $scope.submitDisabled   =   true;
    customersResource.get({
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

        customersResource.update({
                id  :   $route.current.params.id // make sure route is added as dependency
            },
            $scope.item,
            function(){
                $location.url( '/customers?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

customersEdit.$inject    =   [ 'customersEditTextDomain', '$scope', '$http', '$route', 'customersFields', 'customersResource', '$location', 'validate','sharedCustomersGroupsResource', 'rawToOptions' ];
tendooApp.controller( 'customersEdit', customersEdit );
