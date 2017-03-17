var taxes          =   function(
    taxesTextDomain,
    $scope,
    $http,
    taxesFields,
    taxesResource,
    $location,
    sharedValidate,
    rawToOptions,
    sharedDocumentTitle,
    sharedMoment
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter une taxe', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   taxesTextDomain;
    $scope.fields           =   taxesFields;
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
        $scope.item.date_creation   =   sharedMoment.now();

        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        taxesResource.save(
            $scope.item,
            function(){
                $location.url( '/taxes?notice=done' );
            },function( returned ){

                $scope.submitDisabled   =   false;

                if( returned.data.status === 'alreadyExists' ) {
                    sharedAlert.warning( '<?php echo _s( 'Le nom de cette taxe est déjà en cours d\'utilisation, veuillez choisir un autre nom.', 'nexopos_advanced' );?>' );
                }

                if( returned.data.status === 'forbidden' || returned.status == 500 ) {
                    sharedAlert.warning( '<?php echo _s( 'Une erreur s\'est produite durant l\'opération.', 'nexopos_advanced' );?>' );
                }
            }
        )
    }
}

taxes.$inject    =   [
    'taxesTextDomain',
    '$scope',
    '$http',
    'taxesFields',
    'taxesResource',
    '$location',
    'sharedValidate',
    'rawToOptions',
    'sharedDocumentTitle',
    'sharedMoment'
];
tendooApp.controller( 'taxes', taxes );
