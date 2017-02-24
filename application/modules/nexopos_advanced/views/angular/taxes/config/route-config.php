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
                    'factories/taxes/add-text-domain.js',
                    'factories/taxes/fields.js',
                    'factories/taxes/resource.js',
                    'factories/taxes/table.js',
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

.when('/taxes/edit/:id?', {
    templateUrl: function( urlattr ) {
        return 'templates/taxes/edit';
    },
    controller: 'taxesEdit',
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
                    'shared_factories/alert.js'
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
                    'factories/taxes/add-text-domain.js',
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
