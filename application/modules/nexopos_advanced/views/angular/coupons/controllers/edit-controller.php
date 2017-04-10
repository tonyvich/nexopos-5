var couponsEdit      =   function(
    $scope,
    $http,
    $route,
    $location,
    couponsEditTextDomain,
    couponsFields,
    couponsResource,
    customersGroupsResource,
    categoriesResource,
    itemsResource,
    sharedValidate,
    sharedDocumentTitle,
    sharedFieldEditor,
    sharedRawToOptions,
    sharedMoment
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Editer un coupon', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   couponsEditTextDomain;
    $scope.fields           =   couponsFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   new sharedValidate();

    // Get Resource when loading
    $scope.submitDisabled   =   true;
    couponsResource.get({
        id  :  $route.current.params.id // make sure route is added as dependency
    },function( entry ){
        $scope.submitDisabled   =   false;
        $scope.item             =   entry;
    })

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
        $scope.item.author              =   <?= User::id()?>;
        $scope.item.date_modification   =   sharedMoment.now();
        $scope.item.included_items_ids = JSON.stringify($scope.item.included_items_ids);
        $scope.item.included_categories_ids = JSON.stringify($scope.item.included_categories_ids);
        $scope.item.included_customers_groups_ids = JSON.stringify($scope.item.included_customers_groups_ids);

        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        couponsResource.update({
                id  :   $route.current.params.id // make sure route is added as dependency
            },
            $scope.item,
            function(){
                $location.url( '/coupons?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

couponsEdit.$inject    =   [
    '$scope',
    '$http',
    '$route',
    '$location',
    'couponsEditTextDomain',
    'couponsFields',
    'couponsResource',
    'customersGroupsResource',
    'categoriesResource',
    'itemsResource',
    'sharedValidate',
    'sharedDocumentTitle',
    'sharedFieldEditor',
    'sharedRawToOptions',
    'sharedMoment'
];
tendooApp.controller( 'couponsEdit', couponsEdit );
