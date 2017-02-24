var deliveriesEdit      =   function( deliveriesEditTextDomain, $scope, $http, $route, deliveriesFields, deliveriesResource, $location, validate ) {
    $scope.textDomain       =   deliveriesEditTextDomain;
    $scope.fields           =   deliveriesFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   validate;

    // Get Resource when loading
    $scope.submitDisabled   =   true;
    deliveriesResource.get({
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
        $scope.item.author          =   <?= User::id()?>;
        $scope.item.date_creation   =   '<?php echo date_now();?>';

        if( angular.isDefined( $scope.item.shipping_date ) ) {
            $scope.item.shipping_date   =   moment( $scope.item.shipping_date ).format();
        }

        if( ! validate.run( $scope.fields, $scope.item ).isValid ) {
            return validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        deliveriesResource.update({
                id  :   $route.current.params.id // make sure route is added as dependency
            },
            $scope.item,
            function(){
                $location.url( '/deliveries?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

deliveriesEdit.$inject    =   [ 'deliveriesEditTextDomain', '$scope', '$http', '$route', 'deliveriesFields', 'deliveriesResource', '$location', 'validate' ];
tendooApp.controller( 'deliveriesEdit', deliveriesEdit );
