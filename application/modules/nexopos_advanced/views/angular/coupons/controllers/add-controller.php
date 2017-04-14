var coupons          =   function(
    $scope,
    $http,
    $location,
    couponsTextDomain,
    couponsFields,
    couponsResource,
    customersGroupsResource,
    categoriesResource,
    itemsResource,
    sharedDocumentTitle,
    sharedMoment,
    sharedFieldEditor,
    sharedValidate,
    sharedRawToOptions
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter un coupon', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   couponsTextDomain;
    $scope.fields           =   couponsFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   new sharedValidate();

    /**
     * Populating multiselect
     **/

     categoriesResource.get(
        function(data){
            sharedFieldEditor('included_categories_ids',$scope.fields).options = sharedRawToOptions(data.entries,'id','name');
        }
     );

     customersGroupsResource.get(
        function(data){
            sharedFieldEditor('included_customers_groups_ids',$scope.fields).options = sharedRawToOptions(data.entries,'id','name');
        }
     );

     itemsResource.get(
        function(data){
            sharedFieldEditor('included_items_ids',$scope.fields).options = sharedRawToOptions(data.entries,'id','name');
        }
     );

    $scope.submit       =   function(){
        $scope.item.author          =   <?= User::id()?>;
        $scope.item.date_creation   =   sharedMoment.now();
        $scope.item.included_items_ids = JSON.stringify($scope.item.included_items_ids);
        $scope.item.included_categories_ids = JSON.stringify($scope.item.included_categories_ids);
        $scope.item.included_customers_groups_ids = JSON.stringify($scope.item.included_customers_groups_ids);

        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        couponsResource.save(
            $scope.item,
            function(){
                if( $location.search().fallback ) {
                    $location.url( $location.search().fallback );
                } else {
                    $location.url( '/coupons?notice=done' );
                }        
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
    '$scope',
    '$http',
    '$location',
    'couponsTextDomain',
    'couponsFields',
    'couponsResource',
    'customersGroupsResource',
    'categoriesResource',
    'itemsResource',
    'sharedDocumentTitle',
    'sharedMoment',
    'sharedFieldEditor',
    'sharedValidate',
    'sharedRawToOptions'
];

tendooApp.controller( 'coupons', coupons );
