.when('/customer-groups', {
    templateUrl: function( urlattr ) {
        return 'templates/customer-groups/main';
    },
    controller: 'customerGroupsMain',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/customer-groups/main.js',
                    'factories/customer-groups/text-domain.js',
                    'factories/customer-groups/fields.js',
                    'factories/customer-groups/resource.js',
                    'factories/customer-groups/table.js',
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


.when('/customer-groups/:page', {
    templateUrl: function( urlattr ) {
        if( typeof urlattr.page != 'undefined' ) {
            return 'templates/customer-groups/' + urlattr.page;
        }
        return 'templates/customer-groups/main';
    },
    controller: 'customerGroups',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'customer-groups',
                files: [
                    'controllers/customer-groups/add.js',
                    'factories/customer-groups/text-domain.js',
                    'factories/customer-groups/fields.js',
                    'factories/customer-groups/resource.js',
                    'factories/customer-groups/table.js',
                    'shared_factories/options.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/validate.js',
                    'shared_factories/table.js',
                    'shared_factories/pagination.js',
                    'shared_factories/alert.js'
                ]
            });
        }]
    }
})
