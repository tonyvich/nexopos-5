var registersEdit          =   function( registersEditTextDomain, $scope, $http, $route, registersFields, registersResource, $location, sharedValidate, rawToOptions, sharedDocumentTitle ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Editer une caisse', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   registersEditTextDomain;
    $scope.fields           =   registersFields;
    $scope.item             =   {};
    $scope.validate         =   new sharedValidate();

    // Get Resource when loading
    $scope.submitDisabled   =   true;
    registersResource.get({
        id  :  $route.current.params.id // make sure route is added as dependency
    },function( entry ){
        $scope.submitDisabled   =   false;
        $scope.item             =   entry;
    },function(){
        $location.path( '/nexopos/error/404' )
    })
    
    // Setting options for ref_parent select
    registersResource.get({
            exclude     :   $route.current.params.id
        },
        function(data){
            console.log( data.entries );
            $scope.fields[1].options = rawToOptions( data.entries, 'id', 'name');
        }
    );

    // Submitting Form

    $scope.submit       =   function(){
        $scope.item.author              =   <?= User::id()?>;
        $scope.item.date_modification   =   tendoo.now();
        $scope.item.authorized_users = JSON.stringify($scope.item.authorized_users); // Converting array to string for database saving purpose

        if($scope.item.ref_parent == null){
            $scope.item.ref_parent = 0;
        }

        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
        }
        $scope.submitDisabled       =   true;

        registersResource.update({
                id  :   $route.current.params.id // make sure route is added as dependency
            },
            $scope.item,
            function(){
                $location.url( '/registers?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

registersEdit.$inject    =   [
    'registersEditTextDomain',
    '$scope',
    '$http',
    '$route',
    'registersFields',
    'registersResource',
    '$location',
    'sharedValidate',
    'rawToOptions',
    'sharedDocumentTitle'
];

tendooApp.controller( 'registersEdit', registersEdit );
