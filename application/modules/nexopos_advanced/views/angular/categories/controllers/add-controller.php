var categories          =   function( categoriesTextDomain, $scope, $http, categoriesFields, categoriesResource, $location, validate, rawToOptions ) {

    $scope.textDomain       =   categoriesTextDomain;
    $scope.fields           =   categoriesFields;
    $scope.item             =   {};
    $scope.validate         =   validate;

    // Setting options for ref_parent select

    categoriesResource.get(
        function(data){
            $scope.fields[1].options = rawToOptions(data.entries, 'id', 'name');
        }
    );

    //Submitting Form

    $scope.submit       =   function(){
        $scope.item.author          =   <?= User::id()?>;

        if( ! validate.run( $scope.fields, $scope.item ).isValid ) {
            return validate.blurAll( $scope.fields, $scope.item );
        }
        $scope.submitDisabled       =   true;

        categoriesResource.save(
            $scope.item,
            function(){
                $location.url( '/categories?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

categories.$inject    =   [ 'categoriesTextDomain', '$scope', '$http', 'categoriesFields', 'categoriesResource', '$location', 'validate','rawToOptions'];
tendooApp.controller( 'categories', categories );
