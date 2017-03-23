.when('/providers', {
    templateUrl: function( urlattr ) {
        return 'templates/providers/main';
    },
    controller: 'providersMain',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/providers/main.js',
                    'factories/providers/add-text-domain.js',
                    'factories/providers/fields.js',
                    'factories/providers/resource.js',
                    'factories/providers/table.js',
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

.when('/providers/edit/:id?', {
    templateUrl: function( urlattr ) {
        return 'templates/providers/edit';
    },
    controller: 'providersEdit',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'providersEdit',
                files: [
                    'controllers/providers/edit.js',
                    'factories/providers/edit-text-domain.js',
                    'factories/providers/fields.js',
                    'factories/providers/resource.js',
                    'factories/providers/table.js',
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

.when('/providers/:page', {
    templateUrl: function( urlattr ) {
        if( typeof urlattr.page != 'undefined' ) {
            return 'templates/providers/' + urlattr.page;
        }
        return 'templates/providers/main';
    },
    controller: 'providers',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'providers',
                files: [
                    'controllers/providers/add.js',
                    'factories/providers/add-text-domain.js',
                    'factories/providers/fields.js',
                    'factories/providers/resource.js',
                    'factories/providers/table.js',
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
