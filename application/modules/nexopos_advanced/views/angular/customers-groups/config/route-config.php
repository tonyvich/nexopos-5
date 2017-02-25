.when('/customers-groups', {
    templateUrl: function( urlattr ) {
        return 'templates/customers-groups/main';
    },
    controller: 'customersGroupsMain',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/customers-groups/main.js',
                    'factories/customers-groups/add-text-domain.js',
                    'factories/customers-groups/fields.js',
                    'factories/customers-groups/resource.js',
                    'factories/customers-groups/table.js',
                    'shared_factories/options.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/validate.js',
                    'shared_factories/table.js',
                    'shared_factories/pagination.js',
                    'shared_factories/table-actions.js',
                    'shared_factories/alert.js',
                    'shared_factories/entry-actions.js',
                    'shared_factories/document-title.js'
                ]
            });
        }]
    }
})


/**
 * For Editing Purposes
**/

.when('/customers-groups/edit/:id?', {
    templateUrl: function( urlattr ) {
        return 'templates/customers-groups/edit';
    },
    controller: 'customersGroupsEdit',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'customers-groupsEdit',
                files: [
                    'controllers/customers-groups/edit.js',
                    'factories/customers-groups/edit-text-domain.js',
                    'factories/customers-groups/fields.js',
                    'factories/customers-groups/resource.js',
                    'factories/customers-groups/table.js',
                    'shared_factories/options.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/validate.js',
                    'shared_factories/table.js',
                    'shared_factories/pagination.js',
                    'shared_factories/alert.js',
                    'shared_factories/document-title.js'
                ]
            });
        }]
    }
})



.when('/customers-groups/:page', {
    templateUrl: function( urlattr ) {
        if( typeof urlattr.page != 'undefined' ) {
            return 'templates/customers-groups/' + urlattr.page;
        }
        return 'templates/customers-groups/main';
    },
    controller: 'customersGroups',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'customers-groups',
                files: [
                    'controllers/customers-groups/add.js',
                    'factories/customers-groups/add-text-domain.js',
                    'factories/customers-groups/fields.js',
                    'factories/customers-groups/resource.js',
                    'factories/customers-groups/table.js',
                    'shared_factories/options.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/validate.js',
                    'shared_factories/table.js',
                    'shared_factories/pagination.js',
                    'shared_factories/alert.js',
                    'shared_factories/document-title.js'
                ]
            });
        }]
    }
})
