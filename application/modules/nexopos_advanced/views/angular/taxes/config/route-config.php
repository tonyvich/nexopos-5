.when('/taxes', {
    templateUrl: function( urlattr ) {
        return 'templates/taxes/main';
    },
    controller: 'taxesMain',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/taxes/main.js',
                    'factories/taxes/text-domain.js',
                    'factories/taxes/fields.js',
                    'factories/taxes/resource.js',
                    'factories/taxes/table.js',
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


.when('/taxes/:page', {
    templateUrl: function( urlattr ) {
        if( typeof urlattr.page != 'undefined' ) {
            return 'templates/taxes/' + urlattr.page;
        }
        return 'templates/taxes/main';
    },
    controller: 'taxes',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'taxes',
                files: [
                    'controllers/taxes/add.js',
                    'factories/taxes/text-domain.js',
                    'factories/taxes/fields.js',
                    'factories/taxes/resource.js',
                    'factories/taxes/table.js',
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
