var taxesEdit      =   function(
    taxesEditTextDomain,
    $scope,
    $http,
    $route,
    taxesFields,
    taxesResource,
    $location,
    sharedValidate,
    sharedDocumentTitle,
    sharedMoment
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Editer des taxes', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   taxesEditTextDomain;
    $scope.fields           =   taxesFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   new sharedValidate();

    // Get Resource when loading
    $scope.submitDisabled   =   true;
    taxesResource.get({
        id  :  $route.current.params.id // make sure route is added as dependency
    },function( entry ){
        $scope.submitDisabled   =   false;
        $scope.item             =   entry;
    })

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

        taxesResource.update({
                id  :   $route.current.params.id // make sure route is added as dependency
            },
            $scope.item,
            function(){
                if( $location.search().fallback ) {
                    $location.url( $location.search().fallback );
                } else {
                    $location.url( '/taxes?notice=done' );
                }
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

taxesEdit.$inject    =   [
    'taxesEditTextDomain',
    '$scope',
    '$http',
    '$route',
    'taxesFields',
    'taxesResource',
    '$location',
    'sharedValidate',
    'sharedDocumentTitle',
    'sharedMoment'
];
tendooApp.controller( 'taxesEdit', taxesEdit );
