var deliveriesEdit      =   function(
    deliveriesEditTextDomain,
    $scope,
    $http,
    $route,
    deliveriesFields,
    deliveriesResource,
    $location,
    sharedValidate,
    sharedDocumentTitle,
    sharedMoment
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Editer une livraison', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   deliveriesEditTextDomain;
    $scope.fields           =   deliveriesFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   new sharedValidate();

    // Get Resource when loading
    $scope.submitDisabled   =   true;
    deliveriesResource.get({
        id  :  $route.current.params.id // make sure route is added as dependency
    },function( entry ){
        $scope.submitDisabled   =   false;
        $scope.item             =   entry;
    },function(){
        $location.path( '/nexopos/error/404' )
    });

    $scope.submit       =   function(){
        $scope.item.author              =   <?= User::id()?>;
        $scope.item.date_modification   =   sharedMoment.now();

        if( angular.isDefined( $scope.item.shipping_date ) ) {
            $scope.item.shipping_date   =   moment( $scope.item.shipping_date ).format();
        }

        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
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

deliveriesEdit.$inject    =   [
    'deliveriesEditTextDomain',
    '$scope',
    '$http',
    '$route',
    'deliveriesFields',
    'deliveriesResource',
    '$location',
    'sharedValidate',
    'sharedDocumentTitle',
    'sharedMoment'
];

tendooApp.controller( 'deliveriesEdit', deliveriesEdit );
