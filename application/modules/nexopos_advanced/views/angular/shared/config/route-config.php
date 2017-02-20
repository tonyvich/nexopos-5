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

            <?php /** $this->load->module_view(
                'nexopos_advanced',
                'angular.departments.config.departments-route-config'
            );**/?>

            .otherwise({
                redirectTo: '/'
            });
    }]);
</script>
