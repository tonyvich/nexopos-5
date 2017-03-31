.when('/checkout', {
    templateUrl: function( urlattr ) {
        return 'templates/pos/screen';
    },
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/pos/screen.js',
                ]
            });
        }]
    }
})
