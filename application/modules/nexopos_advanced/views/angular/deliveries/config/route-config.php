.when('/deliveries', {
    templateUrl: function( urlattr ) {
        return 'templates/deliveries/main';
    },
    controller: 'deliveriesMain',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/deliveries/main.js',
                    'factories/deliveries/text-domain.js',
                    'factories/deliveries/fields.js',
                    'factories/deliveries/resource.js',
                    'factories/deliveries/table.js',
                    'shared_factories/options.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/validate.js',
                    'shared_factories/table.js',
                    'shared_factories/pagination.js'
                ]
            });
        }]
    }
})


.when('/deliveries/:page', {
    templateUrl: function( urlattr ) {
        if( typeof urlattr.page != 'undefined' ) {
            return 'templates/deliveries/' + urlattr.page;
        }
        return 'templates/deliveries/main';
    },
    controller: 'deliveries',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'Deliveries',
                files: [
                    'controllers/deliveries/add.js',
                    'factories/deliveries/text-domain.js',
                    'factories/deliveries/fields.js',
                    'factories/deliveries/resource.js',
                    'factories/deliveries/table.js',
                    'shared_factories/options.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/validate.js',
                    'shared_factories/table.js',
                    'shared_factories/pagination.js'
                ]
            });
        }]
    }
})
