.when('/pos', {
    templateUrl: function( urlattr ) {
        return 'templates/pos/add';
    },
    controller: 'posMain',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/pos/add.js',
                ]
            });
        }]
    }
})
