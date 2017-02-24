.when('/customers', {
    templateUrl: function( urlattr ) {
        return 'templates/customers/main';
    },
    controller: 'customersMain',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/customers/main.js',
                    'factories/customers/add-text-domain.js',
                    'factories/customers/fields.js',
                    'factories/customers/resource.js',
                    'factories/customers/table.js',
                    'shared_factories/options.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/validate.js',
                    'shared_factories/table.js',
                    'shared_factories/pagination.js',
                    'shared_factories/table-actions.js',
                    'shared_factories/alert.js',
                    'shared_factories/entry-actions.js'
                ]
            });
        }]
    }
})


/**
 * For Editing Purposes
**/

.when('/customers/edit/:id?', {
    templateUrl: function( urlattr ) {
        return 'templates/customers/edit';
    },
    controller: 'customersEdit',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'customersEdit',
                files: [
                    'controllers/customers/edit.js',
                    'factories/customers/edit-text-domain.js',
                    'factories/customers/fields.js',
                    'factories/customers/resource.js',
                    'factories/customers/table.js',
                    'shared_factories/options.js',
                    'shared_factories/customers-groups-data.js',
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


.when('/customers/:page', {
    templateUrl: function( urlattr ) {
        if( typeof urlattr.page != 'undefined' ) {
            return 'templates/customers/' + urlattr.page;
        }
        return 'templates/customers/main';
    },
    controller: 'customers',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'customers',
                files: [
                    'controllers/customers/add.js',
                    'factories/customers/add-text-domain.js',
                    'factories/customers/fields.js',
                    'factories/customers/resource.js',
                    'factories/customers/table.js',
                    'shared_factories/options.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/customers-groups-data.js',
                    'shared_factories/validate.js',
                    'shared_factories/table.js',
                    'shared_factories/pagination.js',
                    'shared_factories/alert.js'
                ]
            });
        }]
    }
})
