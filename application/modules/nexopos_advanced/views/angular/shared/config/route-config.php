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
                'angular.providers.config.route-config'
            );?>

            <?php $this->load->module_view(
                'nexopos_advanced',
                'angular.units.config.route-config'
            );?>

            <?php $this->load->module_view(
                'nexopos_advanced',
                'angular.customers.config.route-config'
            );?>

            <?php $this->load->module_view(
                'nexopos_advanced',
                'angular.customers-groups.config.route-config'
            );?>

            <?php $this->load->module_view(
                'nexopos_advanced',
                'angular.expenses-categories.config.route-config'
            );?>

            <?php $this->load->module_view(
                'nexopos_advanced',
                'angular.expenses.config.route-config'
            );?>

            <?php $this->load->module_view(
                'nexopos_advanced',
                'angular.coupons.config.route-config'
            );?>

            <?php $this->load->module_view(
                'nexopos_advanced',
                'angular.registers.config.route-config'
            );?>

            <?php $this->load->module_view(
                'nexopos_advanced',
                'angular.stores.config.route-config'
            );?>

            <?php $this->load->module_view(
                'nexopos_advanced',
                'angular.pos.config.route-config'
            );?>

            <?php $this->load->module_view(
                'nexopos_advanced',
                'angular.setup.config.route-config'
            );?>

            .when( '/error/:code', {
                templateUrl: function( urlattr ) {
                    return 'templates/errors/404';
                },
                controller: 'error404',
                resolve: {
                    lazy: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            files: [
                                'controllers/errors/404.js',
                            ]
                        });
                    }]
                }
            })

            .otherwise({
                redirectTo      :   '/error/404'
            })
    }]);
</script>
