var categories          =   function( categoriesAddTextDomain, $scope, $http, categoriesFields, categoriesResource, $location, validate, rawToOptions) {

    $scope.textDomain       =   categoriesAddTextDomain;
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

        if($scope.item.ref_parent == null){
            $scope.item.ref_parent = 0;
        }

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

categories.$inject    =   [ 'categoriesAddTextDomain', '$scope', '$http', 'categoriesFields', 'categoriesResource', '$location', 'validate','rawToOptions'];
tendooApp.controller( 'categories', categories );
