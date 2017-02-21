var taxes          =   function( taxesTextDomain, $scope, $http, taxesFields, taxesResource, $location, validate, rawToOptions ) {

    $scope.textDomain       =   taxesTextDomain;
    $scope.fields           =   taxesFields;
    $scope.item             =   {};
    $scope.validate         =   validate;

    //Submitting Form

    $scope.submit       =   function(){
        $scope.item.author          =   <?= User::id()?>;

        if( ! validate.run( $scope.fields, $scope.item ).isValid ) {
            return validate.blurAll( $scope.fields, $scope.item );
        }
        
        $scope.submitDisabled       =   true;

        taxesResource.save(
            $scope.item,
            function(){
                $location.url( '/taxes?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

taxes.$inject    =   [ 'taxesTextDomain', '$scope', '$http', 'taxesFields', 'taxesResource', '$location', 'validate','rawToOptions'];
tendooApp.controller( 'taxes', taxes );
