<script type="text/javascript">
    "use strict";
    tendooApp.config(['$routeProvider', function ($routeProvider) {
        $routeProvider
            <?php $this->load->module_view(
                'nexopos_advanced',
                'angular.items.config.route-config'
            );?>

            .when( '/media-manager/error/:code', {
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
                redirectTo      :   '/media-manager/error/404'
            })
    }]);
</script>
