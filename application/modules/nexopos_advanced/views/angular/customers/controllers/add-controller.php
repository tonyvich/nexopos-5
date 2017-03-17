var customers          =   function(
    customersTextDomain,
    $scope,
    $http,
    customersFields,
    customersResource,
    $location,
    sharedValidate,
    sharedCustomersGroupsResource,
    rawToOptions,
    sharedDocumentTitle,
    sharedMoment
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter un client', 'nexopos_advanced' );?>');
    $scope.textDomain       =   customersTextDomain;
    $scope.fields           =   customersFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   new sharedValidate();
    // Settings options for selecting parent group

    sharedCustomersGroupsResource.get(
        function(data){
            $scope.fields[7].options = rawToOptions(data.entries, 'id', 'name');
        }
    );

    /**
     *  Update Date
     *  @param object date
     *  @return void
    **/

    $scope.updateDate   =   function( date, key ){
        $scope.item[ key ]    =   date;
    }

    $scope.submit       =   function(){
        $scope.item.author          =   <?= User::id()?>;
        $scope.item.date_creation   =   sharedMoment.now();

        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        customersResource.save(
            $scope.item,
            function(){
                $location.url( '/customers?notice=done' );
            },function( returned ){

                $scope.submitDisabled   =   false;

                if( returned.data.status === 'alreadyExists' ) {
                    sharedAlert.warning( '<?php echo _s( 'Le nom de ce client est déjà en cours d\'utilisation, veuillez choisir un autre nom.', 'nexopos_advanced' );?>' );
                }

                if( returned.data.status === 'forbidden' || returned.status == 500 ) {
                    sharedAlert.warning( '<?php echo _s( 'Une erreur s\'est produite durant l\'opération.', 'nexopos_advanced' );?>' );
                }
            }
        )
    }
}

customers.$inject    =   [
    'customersTextDomain',
    '$scope',
    '$http',
    'customersFields',
    'customersResource',
    '$location',
    'sharedValidate' ,
    'sharedCustomersGroupsResource',
    'rawToOptions',
    'sharedDocumentTitle',
    'sharedMoment'
];
tendooApp.controller( 'customers', customers );
