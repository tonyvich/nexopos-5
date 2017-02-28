var categories          =   function( categoriesAddTextDomain, $scope, $http, categoriesFields, categoriesResource, $location, sharedValidate, rawToOptions, sharedDocumentTitle ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter une catégorie', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   categoriesAddTextDomain;
    $scope.fields           =   categoriesFields;
    $scope.item             =   {};
    $scope.validate         =   new sharedValidate();

    // Setting options for ref_parent select

    categoriesResource.get(
        function(data){
            $scope.fields[1].options = rawToOptions(data.entries, 'id', 'name');
        }
    );

    //Submitting Form

    $scope.submit       =   function(){
        $scope.item.author          =   <?= User::id()?>;
        $scope.item.date_creation   =   tendoo.now();

        if($scope.item.ref_parent == null){
            $scope.item.ref_parent = 0;
        }

        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
        }
        $scope.submitDisabled       =   true;

        categoriesResource.save(
            $scope.item,
            function(){
                $location.url( '/categories?notice=done' );
            },function( returned ){

                $scope.submitDisabled   =   false;

                if( returned.data.status === 'alreadyExists' ) {
                    sharedAlert.warning( '<?php echo _s( 'Le nom de cette catégorie est déjà en cours d\'utilisation, veuillez choisir un autre nom.', 'nexopos_advanced' );?>' );
                }

                if( returned.data.status === 'forbidden' || returned.status == 500 ) {
                    sharedAlert.warning( '<?php echo _s( 'Une erreur s\'est produite durant l\'opération.', 'nexopos_advanced' );?>' );
                }
            }
        )
    }
}

categories.$inject    =   [
    'categoriesAddTextDomain',
    '$scope',
    '$http',
    'categoriesFields',
    'categoriesResource',
    '$location',
    'sharedValidate',
    'rawToOptions',
    'sharedDocumentTitle'
];

tendooApp.controller( 'categories', categories );
