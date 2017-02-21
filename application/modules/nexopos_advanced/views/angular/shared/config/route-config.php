<script type="text/javascript">
    "use strict";
    tendooApp.config(['$routeProvider', function ($routeProvider) {
        $routeProvider
            <?php $this->load->module_view(
                'nexopos_advanced',
                'angular.items.config.route-config'
            );?>

            <?php $this->load->module_view(
                'nexopos_advanced',
                'angular.deliveries.config.route-config'
            );?>

            <?php $this->load->module_view(
                'nexopos_advanced',
                'angular.departments.config.route-config'
            );?>

            <?php $this->load->module_view(
                'nexopos_advanced',
                'angular.categories.config.route-config'
            );?>

            <?php $this->load->module_view(
                'nexopos_advanced',
                'angular.taxes.config.route-config'
            );?>
            

            <?php $this->load->module_view(
                'nexopos_advanced',
                'angular.pos.config.route-config'
            );?>

            .otherwise({
                redirectTo: '/'
            });
    }]);
</script>
