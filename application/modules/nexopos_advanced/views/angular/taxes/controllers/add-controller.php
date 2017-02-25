var taxes          =   function( taxesTextDomain, $scope, $http, taxesFields, taxesResource, $location, validate, rawToOptions, sharedDocumentTitle ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter une taxe', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   taxesTextDomain;
    $scope.fields           =   taxesFields;
    $scope.item             =   {};
    $scope.validate         =   validate;

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

        if( ! validate.run( $scope.fields, $scope.item ).isValid ) {
            return validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        taxesResource.save(
            $scope.item,
            function(){
                $location.url( '/taxes?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

taxes.$inject    =   [ 'taxesTextDomain', '$scope', '$http', 'taxesFields', 'taxesResource', '$location', 'validate','rawToOptions', 'sharedDocumentTitle' ];
tendooApp.controller( 'taxes', taxes );
