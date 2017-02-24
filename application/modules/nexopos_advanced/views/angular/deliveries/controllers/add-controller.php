var deliveries          =   function( deliveriesTextDomain, $scope, $http, deliveriesFields, deliveriesResource, $location, validate ) {

    $scope.textDomain       =   deliveriesTextDomain;
    $scope.fields           =   deliveriesFields;
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
        $scope.item.date_creation   =   tendoo.now();

        if( angular.isDefined( $scope.item.shipping_date ) ) {
            $scope.item.shipping_date   =   moment( $scope.item.shipping_date ).format();
        }

        if( ! validate.run( $scope.fields, $scope.item ).isValid ) {
            return validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        deliveriesResource.save(
            $scope.item,
            function(){
                $location.url( '/deliveries?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

deliveries.$inject    =   [ 'deliveriesTextDomain', '$scope', '$http', 'deliveriesFields', 'deliveriesResource', '$location', 'validate' ];
tendooApp.controller( 'deliveries', deliveries );
