tendooApp.directive( 'itemVariation', function(){
    return {
        template :  <?php echo json_encode( $this->load->module_view( 'nexopos_advanced', 'angular.items.templates.parts-template', null , true ) );?>,
        controller  :   function( $scope, itemsTypes, item, itemsAdvancedFields, providers, $rootScope ) {
            // console.log( item );
            $scope.item                 =   item;
            $scope.itemsAdvancedFields   =   itemsAdvancedFields;
            $scope.$broadcast           =   $rootScope.$broadcast;
        }
    }
});
