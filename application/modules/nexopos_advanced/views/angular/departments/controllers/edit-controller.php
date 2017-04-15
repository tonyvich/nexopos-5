var departmentsEdit      =   function(
    departmentsEditTextDomain,
    $scope,
    $http,
    $route,
    departmentsFields,
    departmentsResource,
    $location,
    sharedValidate,
    sharedDocumentTitle,
    sharedMoment
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Editer un rayon', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   departmentsEditTextDomain;
    $scope.fields           =   departmentsFields;
    $scope.item             =   {};
    $scope.validate         =   new sharedValidate();

    // Get Resource when loading
    $scope.submitDisabled   =   true;
    departmentsResource.get({
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

        departmentsResource.update({
                id  :   $route.current.params.id // make sure route is added as dependency
            },
            $scope.item,
            function(){
                if( $location.search().fallback ) {
                    $location.url( $location.search().fallback );
                } else {
                    $location.url( '/departments?notice=done' );
                }
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

departmentsEdit.$inject    =   [
    'departmentsEditTextDomain',
    '$scope',
    '$http',
    '$route',
    'departmentsFields',
    'departmentsResource',
    '$location',
    'sharedValidate',
    'sharedDocumentTitle',
    'sharedMoment'
];
tendooApp.controller( 'departmentsEdit', departmentsEdit );
