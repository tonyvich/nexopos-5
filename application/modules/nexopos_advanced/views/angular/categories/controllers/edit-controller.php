var categoriesEdit          =   function( categoriesEditTextDomain, $scope, $http, $route, categoriesFields, categoriesResource, $location, validate, rawToOptions, sharedDocumentTitle ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Editer une catégorie', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   categoriesEditTextDomain;
    $scope.fields           =   categoriesFields;
    $scope.item             =   {};
    $scope.validate         =   validate;

    // Get Resource when loading
    $scope.submitDisabled   =   true;
    categoriesResource.get({
        id  :  $route.current.params.id // make sure route is added as dependency
    },function( entry ){
        $scope.submitDisabled   =   false;
        $scope.item             =   entry;
    },function(){
        $location.path( '/nexopos/error/404' )
    })

    // Setting options for ref_parent select
    categoriesResource.get({
            exclude     :   $route.current.params.id
        },
        function(data){
            console.log( data.entries );
            $scope.fields[1].options = rawToOptions( data.entries, 'id', 'name');
        }
    );

    //Submitting Form

    $scope.submit       =   function(){
        $scope.item.author              =   <?= User::id()?>;
        $scope.item.date_modification   =   tendoo.now();

        if($scope.item.ref_parent == null){
            $scope.item.ref_parent = 0;
        }

        if( ! validate.run( $scope.fields, $scope.item ).isValid ) {
            return validate.blurAll( $scope.fields, $scope.item );
        }
        $scope.submitDisabled       =   true;

        categoriesResource.update({
                id  :   $route.current.params.id // make sure route is added as dependency
            },
            $scope.item,
            function(){
                $location.url( '/categories?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

categoriesEdit.$inject    =   [
    'categoriesEditTextDomain',
    '$scope',
    '$http',
    '$route',
    'categoriesFields',
    'categoriesResource',
    '$location',
    'validate',
    'rawToOptions',
    'sharedDocumentTitle'
];

tendooApp.controller( 'categoriesEdit', categoriesEdit );
