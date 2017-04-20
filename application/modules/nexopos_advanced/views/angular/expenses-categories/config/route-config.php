.when('/expenses-categories', {
    templateUrl: function( urlattr ) {
        return 'templates/expenses-categories/main';
    },
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/expenses-categories/main.js',
                    'factories/expenses-categories/add-text-domain.js',
                    'factories/expenses-categories/fields.js',
                    'factories/expenses-categories/resource.js',
                    'factories/expenses-categories/table.js',
                    'shared_factories/table-header-buttons.js',
                    'shared_factories/options.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/validate.js',
                    'shared_factories/table.js',
                    'shared_factories/pagination.js',
                    'shared_factories/table-actions.js',
                    'shared_factories/alert.js',
                    'shared_factories/entry-actions.js',
                    'shared_factories/document-title.js',
                    'shared_factories/table-header-buttons.js'
                ]
            });
        }]
    }
})

/**
 * For Editing Purposes
**/

.when('/expenses-categories/edit/:id?', {
    templateUrl: function( urlattr ) {
        return 'templates/expenses-categories/edit';
    },
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'expenses-categoriesEdit',
                files: [
                    'controllers/expenses-categories/edit.js',
                    'factories/expenses-categories/edit-text-domain.js',
                    'factories/expenses-categories/fields.js',
                    'factories/expenses-categories/resource.js',
                    'factories/expenses-categories/table.js',
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

.when('/expenses-categories/:page', {
    templateUrl: function( urlattr ) {
        if( typeof urlattr.page != 'undefined' ) {
            return 'templates/expenses-categories/' + urlattr.page;
        }
        return 'templates/expenses-categories/main';
    },
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'expenses-categories',
                files: [
                    'controllers/expenses-categories/add.js',
                    'factories/expenses-categories/add-text-domain.js',
                    'factories/expenses-categories/fields.js',
                    'factories/expenses-categories/resource.js',
                    'factories/expenses-categories/table.js',
                    'shared_factories/options.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/validate.js',
                    'shared_factories/table.js',
                    'shared_factories/pagination.js',
                    'shared_factories/alert.js',
                    'shared_factories/document-title.js',
                    'shared_factories/moment.js',
                    'shared_factories/field-editor.js'
                ]
            });
        }]
    }
})
