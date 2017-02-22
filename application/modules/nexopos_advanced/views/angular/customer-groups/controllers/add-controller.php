var customerGroups          =   function( customerGroupsTextDomain, $scope, $http, customerGroupsFields, customerGroupsResource, $location, validate ) {

    $scope.textDomain       =   customerGroupsTextDomain;
    $scope.fields           =   customerGroupsFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   validate;


    /**
     *  Update Date
     *  @param object date
     *  @return void
    **/

    $scope.updateDate   =   function( date, key ){
        $scope.item[ key ]    =   date;
    }

    $scope.submit       =   function(){
        $scope.item.author          =   <?= User::id()?>;
        $scope.item.date_creation   =   '<?php echo date_now();?>';

        if( ! validate.run( $scope.fields, $scope.item ).isValid ) {
            return validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        customerGroupsResource.save(
            $scope.item,
            function(){
                $location.url( '/customer-groups?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

customerGroups.$inject    =   [ 'customerGroupsTextDomain', '$scope', '$http', 'customerGroupsFields', 'customerGroupsResource', '$location', 'validate' ];
tendooApp.controller( 'customerGroups', customerGroups );
