var storesEdit          =   function(
    storesEditTextDomain,
    $scope,
    $http,
    $route,
    storesFields,
    storesResource,
    $location,
    sharedValidate,
    rawToOptions,
    sharedDocumentTitle,
    sharedMoment
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Editer une caisse', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   storesEditTextDomain;
    $scope.fields           =   storesFields;
    $scope.item             =   {};
    $scope.validate         =   new sharedValidate();

    // Get Resource when loading
    $scope.submitDisabled   =   true;
    storesResource.get({
        id  :  $route.current.params.id // make sure route is added as dependency
    },function( entry ){
        $scope.submitDisabled   =   false;
        $scope.item             =   entry;
    },function(){
        $location.path( '/nexopos/error/404' )
    })

    // Setting options for ref_parent select
    storesResource.get({
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
        $scope.item.date_modification   =   sharedMoment.now();
        $scope.item.authorized_users = JSON.stringify($scope.item.authorized_users); // Converting array to string for database saving purpose

        if($scope.item.ref_parent == null){
            $scope.item.ref_parent = 0;
        }

        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
        }
        $scope.submitDisabled       =   true;

        storesResource.update({
                id  :   $route.current.params.id // make sure route is added as dependency
            },
            $scope.item,
            function(){
                $location.url( '/stores?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

storesEdit.$inject    =   [
    'storesEditTextDomain',
    '$scope',
    '$http',
    '$route',
    'storesFields',
    'storesResource',
    '$location',
    'sharedValidate',
    'rawToOptions',
    'sharedDocumentTitle',
    'sharedMoment'
];

tendooApp.controller( 'storesEdit', storesEdit );
