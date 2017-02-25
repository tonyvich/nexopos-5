var taxesEdit      =   function( taxesEditTextDomain, $scope, $http, $route, taxesFields, taxesResource, $location, validate, sharedDocumentTitle ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Editer des taxes', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   taxesEditTextDomain;
    $scope.fields           =   taxesFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   new sharedValidate();

    // Get Resource when loading
    $scope.submitDisabled   =   true;
    taxesResource.get({
        id  :  $route.current.params.id // make sure route is added as dependency
    },function( entry ){
        $scope.submitDisabled   =   false;
        $scope.item             =   entry;
    })

    /**
     *  Update Date
     *  @param object date
     *  @return void
    **/

    $scope.updateDate   =   function( date, key ){
        $scope.item[ key ]    =   date;
    }

    $scope.submit       =   function(){
        $scope.item.author              =   <?= User::id()?>;
        $scope.item.date_modification   =   tendoo.now();

        if( angular.isDefined( $scope.item.shipping_date ) ) {
            $scope.item.shipping_date   =   moment( $scope.item.shipping_date ).format();
        }

        if( ! validate.run( $scope.fields, $scope.item ).isValid ) {
            return validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        taxesResource.update({
                id  :   $route.current.params.id // make sure route is added as dependency
            },
            $scope.item,
            function(){
                $location.url( '/taxes?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

taxesEdit.$inject    =   [ 'taxesEditTextDomain', '$scope', '$http', '$route', 'taxesFields', 'taxesResource', '$location', 'sharedValidate', 'sharedDocumentTitle' ];
tendooApp.controller( 'taxesEdit', taxesEdit );
