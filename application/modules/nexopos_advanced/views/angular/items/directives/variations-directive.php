tendooApp.directive( 'itemVariation', function(){
    return {
        template :  <?php echo json_encode( $this->load->module_view( 'nexopos_advanced', 'angular.shared.templates.multi-fields-template', null , true ) );?>,
        controller  :   function( $scope, itemsTypes, itemsTabs, itemsAdvancedFields, providers, $rootScope ) {
            $scope.item                 =   itemsTabs;
            $scope.itemsAdvancedFields   =   itemsAdvancedFields;
            $scope.$broadcast           =   $rootScope.$broadcast;
        }
    }
});
