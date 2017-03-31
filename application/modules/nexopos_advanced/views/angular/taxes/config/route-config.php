.when('/taxes', {
    templateUrl: 'templates/taxes/main',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/taxes/main.js',
                    'factories/taxes/add-text-domain.js',
                    'factories/taxes/fields.js',
                    'factories/taxes/resource.js',
                    'factories/taxes/table.js',
                    'shared_factories/options.js',
                    'shared_factories/table-header-buttons.js',
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

.when('/taxes/edit/:id?', {
    templateUrl: 'templates/taxes/edit',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'taxesEdit',
                files: [
                    'controllers/taxes/edit.js',
                    'factories/taxes/edit-text-domain.js',
                    'factories/taxes/fields.js',
                    'factories/taxes/resource.js',
                    'factories/taxes/table.js',
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


.when('/taxes/add', {
    templateUrl: 'templates/taxes/add',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'taxes',
                files: [
                    'controllers/taxes/add.js',
                    'factories/taxes/add-text-domain.js',
                    'factories/taxes/fields.js',
                    'factories/taxes/resource.js',
                    'factories/taxes/table.js',
                    'shared_factories/options.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/validate.js',
                    'shared_factories/table.js',
                    'shared_factories/pagination.js',
                    'shared_factories/document-title.js'
                ]
            });
        }]
    }
})
