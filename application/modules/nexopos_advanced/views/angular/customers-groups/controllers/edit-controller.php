var customersGroupsEdit      =   function( customersGroupsEditTextDomain, $scope, $http, $route, customersGroupsFields, customersGroupsResource, $location, sharedValidate, sharedDocumentTitle ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Editer un groupe de clients', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   customersGroupsEditTextDomain;
    $scope.fields           =   customersGroupsFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   new sharedValidate();

    // Get Resource when loading
    $scope.submitDisabled   =   true;
    customersGroupsResource.get({
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

        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        customersGroupsResource.update({
                id  :   $route.current.params.id // make sure route is added as dependency
            },
            $scope.item,
            function(){
                $location.url( '/customers-groups?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

customersGroupsEdit.$inject    =   [ 'customersGroupsEditTextDomain', '$scope', '$http', '$route', 'customersGroupsFields', 'customersGroupsResource', '$location', 'sharedValidate', 'sharedDocumentTitle' ];
tendooApp.controller( 'customersGroupsEdit', customersGroupsEdit );
