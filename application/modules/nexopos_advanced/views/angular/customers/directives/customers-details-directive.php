tendooApp.directive( 'customersDetails', function(){
    return {
        template :  <?php echo json_encode( $this->load->module_view( 'nexopos_advanced', 'angular.shared.templates.multi-fields-template', null , true ) );?>,
        controller  :   function( $scope, customersAdvancedFields, $rootScope ) {
            $scope.$broadcast           =   $rootScope.$broadcast;
            // $scope.itemAdvancedFields   =   customersAdvancedFields;
        },
        restrict    :   'E'
    }
});
