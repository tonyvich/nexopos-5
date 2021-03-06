var registers          =   function(
    registersAddTextDomain,
    $scope,
    $http,
    registersFields,
    registersResource,
    $location,
    sharedValidate,
    sharedRawToOptions,
    sharedUserResource,
    sharedDocumentTitle,
    sharedUserResource,
    sharedMoment
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter une Caisse enregistreuse', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   registersAddTextDomain;
    $scope.fields           =   registersFields;
    $scope.item             =   {};
    $scope.validate         =   new sharedValidate();


    // Setting options for dropdown multiselect
    sharedUserResource.get(
        function(data){
            $scope.fields[1].options = sharedRawToOptions(data.entries, 'id', 'name');
        }
    );

    //Submitting Form

    $scope.submit       =   function(){
        $scope.item.author          =   <?= User::id()?>;
        $scope.item.date_creation   =   sharedMoment.now();
        $scope.item.authorized_users = JSON.stringify($scope.item.authorized_users); // Converting array to string for database saving purpose

        if($scope.item.ref_parent == null){
            $scope.item.ref_parent = 0;
        }

        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        registersResource.save(
            $scope.item,
            function(){
                if( $location.search().fallback ) {
                    $location.url( $location.search().fallback );
                } else {
                    $location.url( '/registers?notice=done' );
                }
            },function( returned ){

                $scope.submitDisabled   =   false;

                if( returned.data.status === 'alreadyExists' ) {
                    sharedAlert.warning( '<?php echo _s( 'Le nom de cette caisse est déjà en cours d\'utilisation, veuillez choisir un autre nom.', 'nexopos_advanced' );?>' );
                }

                if( returned.data.status === 'forbidden' || returned.status == 500 ) {
                    sharedAlert.warning( '<?php echo _s( 'Une erreur s\'est produite durant l\'opération.', 'nexopos_advanced' );?>' );
                }
            }
        )
    }
}

registers.$inject    =   [
    'registersAddTextDomain',
    '$scope',
    '$http',
    'registersFields',
    'registersResource',
    '$location',
    'sharedValidate',
    'sharedRawToOptions',
    'sharedUserResource',
    'sharedDocumentTitle',
    'sharedUserResource',
    'sharedMoment'
];

tendooApp.controller( 'registers', registers );
