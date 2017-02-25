var customersGroups          =   function( customersGroupsTextDomain, $scope, $http, customersGroupsFields, customersGroupsResource, $location, validate, sharedDocumentTitle ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter un groupe de clients', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   customersGroupsTextDomain;
    $scope.fields           =   customersGroupsFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   validate;


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

        if( ! validate.run( $scope.fields, $scope.item ).isValid ) {
            return validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        customersGroupsResource.save(
            $scope.item,
            function(){
                $location.url( '/customers-groups?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

customersGroups.$inject    =   [
    'customersGroupsTextDomain',
    '$scope',
    '$http',
    'customersGroupsFields',
    'customersGroupsResource',
    '$location',
    'validate',
    'sharedDocumentTitle'
];

tendooApp.controller( 'customersGroups', customersGroups );
