var departmentsEdit      =   function( departmentsEditTextDomain, $scope, $http, $route, departmentsFields, departmentsResource, $location, validate, sharedDocumentTitle ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Editer un rayon', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   departmentsEditTextDomain;
    $scope.fields           =   departmentsFields;
    $scope.item             =   {};
    $scope.validate         =   validate;

    // Get Resource when loading
    $scope.submitDisabled   =   true;
    departmentsResource.get({
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

        departmentsResource.update({
                id  :   $route.current.params.id // make sure route is added as dependency
            },
            $scope.item,
            function(){
                $location.url( '/departments?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

departmentsEdit.$inject    =   [ 'departmentsEditTextDomain', '$scope', '$http', '$route', 'departmentsFields', 'departmentsResource', '$location', 'validate', 'sharedDocumentTitle' ];
tendooApp.controller( 'departmentsEdit', departmentsEdit );
