var coupons          =   function( couponsTextDomain, $scope, $http, couponsFields, couponsResource, $location, sharedValidate, sharedDocumentTitle) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter un coupon', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   couponsTextDomain;
    $scope.fields           =   couponsFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   new sharedValidate();


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
        $scope.item.date_creation   =   tendoo.now();

        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        couponsResource.save(
            $scope.item,
            function(){
                $location.url( '/coupons?notice=done' );
            },function( returned ){

                $scope.submitDisabled   =   false;

                if( returned.data.status === 'alreadyExists' ) {
                    sharedAlert.warning( '<?php echo _s( 'Le nom ce groupe de clients est déjà en cours d\'utilisation, veuillez choisir un autre nom.', 'nexopos_advanced' );?>' );
                }

                if( returned.data.status === 'forbidden' || returned.status == 500 ) {
                    sharedAlert.warning( '<?php echo _s( 'Une erreur s\'est produite durant l\'opération.', 'nexopos_advanced' );?>' );
                }
            }
        )
    }
}

coupons.$inject    =   [
    'couponsTextDomain',
    '$scope',
    '$http',
    'couponsFields',
    'couponsResource',
    '$location',
    'sharedValidate',
    'sharedDocumentTitle'
];

tendooApp.controller( 'coupons', coupons );