.when('/categories', {
    templateUrl: function( urlattr ) {
        return 'templates/categories/main';
    },
    controller: 'categoriesMain',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/categories/main.js',
                    'factories/categories/text-domain.js',
                    'factories/categories/fields.js',
                    'factories/categories/resource.js',
                    'factories/categories/table.js',
                    'shared_factories/options.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/validate.js',
                    'shared_factories/table.js',
                    'shared_factories/pagination.js',
                    'shared_factories/table-actions.js',
                    'shared_factories/alert.js'
                ]
            });
        }]
    }
})


.when('/categories/:page', {
    templateUrl: function( urlattr ) {
        if( typeof urlattr.page != 'undefined' ) {
            return 'templates/categories/' + urlattr.page;
        }
        return 'templates/categories/main';
    },
    controller: 'categories',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'Categories',
                files: [
                    'controllers/categories/add.js',
                    'factories/categories/text-domain.js',
                    'factories/categories/fields.js',
                    'factories/categories/resource.js',
                    'factories/categories/table.js',
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
