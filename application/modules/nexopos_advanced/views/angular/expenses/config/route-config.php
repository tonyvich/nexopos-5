.when('/expenses', {
    templateUrl: function( urlattr ) {
        return 'templates/expenses/main';
    },
    controller: 'expensesMain',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/expenses/main.js',
                    'factories/expenses/add-text-domain.js',
                    'factories/expenses/fields.js',
                    'factories/expenses/resource.js',
                    'factories/expenses/categories-resource.js',
                    'factories/expenses/table.js',
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

.when('/expenses/edit/:id?', {
    templateUrl: function( urlattr ) {
        return 'templates/expenses/edit';
    },
    controller: 'expensesEdit',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'expensesEdit',
                files: [
                    'controllers/expenses/edit.js',
                    'factories/expenses/edit-text-domain.js',
                    'factories/expenses/fields.js',
                    'factories/expenses/resource.js',
                    'factories/expenses/categories-resource.js',
                    'factories/expenses/table.js',
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

/**
 * Register Controller for new entry
**/

.when('/expenses/:page', {
    templateUrl: function( urlattr ) {
        if( typeof urlattr.page != 'undefined' ) {
            return 'templates/expenses/' + urlattr.page;
        }
        return 'templates/expenses/main';
    },
    controller: 'expenses',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'expenses',
                files: [
                    'controllers/expenses/add.js',
                    'factories/expenses/add-text-domain.js',
                    'factories/expenses/fields.js',
                    'factories/expenses/resource.js',
                    'factories/expenses/categories-resource.js',
                    'factories/expenses/table.js',
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
