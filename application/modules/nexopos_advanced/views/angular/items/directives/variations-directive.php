tendooApp.directive( 'itemVariation', function(){
    return {
        template :  <?php echo json_encode( $this->load->module_view( 'nexopos_advanced', 'angular.items.templates.parts-template', null , true ) );?>,
        controller  :   function( $scope, itemTypes, item, itemAdvancedFields, providers, $rootScope ) {
            $scope.item                 =   item;
            $scope.itemAdvancedFields   =   itemAdvancedFields;
            $scope.providers            =   providers;
            $scope.$broadcast           =   $rootScope.$broadcast;
            $scope.itemTypes            =   itemTypes;
        }
    }
});
