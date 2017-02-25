var providers          =   function( providersTextDomain, $scope, $http, providersFields, providersResource, $location, sharedValidate, rawToOptions, sharedDocumentTitle, sharedAlert ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter un fournisseur', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   providersTextDomain;
    $scope.fields           =   providersFields;
    $scope.item             =   {};
    $scope.validate         =   new sharedValidate();

    /**
     *  Update Date
     *  @param object date
     *  @return void
    **/

    $scope.updateDate   =   function( date, key ){
        $scope.item[ key ]    =   date;
    }


    //Submitting Form

    $scope.submit       =   function(){
        $scope.item.author          =   <?= User::id()?>;
        $scope.item.date_creation   =   tendoo.now();

        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        providersResource.save(
            $scope.item,
            function(){
                $location.url( '/providers?notice=done' );
            },function( returned ){

                $scope.submitDisabled   =   false;

                if( returned.data.status === 'alreadyExists' ) {
                    sharedAlert.warning( '<?php echo _s( 'Le nom de ce fournisseur est déjà en cours d\'utilisation, veuillez choisir un autre nom.', 'nexopos_advanced' );?>' );
                }

                if( returned.data.status === 'forbidden' || returned.status == 500 ) {
                    sharedAlert.warning( '<?php echo _s( 'Une erreur s\'est produite durant l\'opération.', 'nexopos_advanced' );?>' );
                }
            }
        )
    }
}

providers.$inject    =   [
    'providersTextDomain',
    '$scope',
    '$http',
    'providersFields',
    'providersResource',
    '$location',
    'sharedValidate',
    'rawToOptions',
    'sharedDocumentTitle',
    'sharedAlert'
];

tendooApp.controller( 'providers', providers );
