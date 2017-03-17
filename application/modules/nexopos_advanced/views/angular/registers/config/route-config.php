.when('/registers', {
    templateUrl: function( urlattr ) {
        return 'templates/registers/main';
    },
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/registers/main.js',
                    'factories/registers/add-text-domain.js',
                    'factories/registers/fields.js',
                    'factories/registers/resource.js',
                    'factories/registers/table.js',
                    'shared_factories/options.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/raw-to-multiselect-options.js',
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

.when('/registers/edit/:id', {
    templateUrl: function( urlattr ) {
        return 'templates/registers/edit';
    },
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'registersEdit',
                files: [
                    'controllers/registers/edit.js',
                    'factories/registers/edit-text-domain.js',
                    'factories/registers/fields.js',
                    'factories/registers/resource.js',
                    'factories/registers/table.js',
                    'shared_factories/options.js',
                    'shared_factories/user-resource.js',
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

.when('/registers/:page', {
    templateUrl: function( urlattr ) {
        if( typeof urlattr.page != 'undefined' ) {
            return 'templates/registers/' + urlattr.page;
        }
        return 'templates/registers/main';
    },
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'registers',
                files: [
                    'controllers/registers/add.js',
                    'factories/registers/add-text-domain.js',
                    'factories/registers/fields.js',
                    'factories/registers/resource.js',
                    'factories/registers/table.js',
                    'shared_factories/options.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/user-resource.js',
                    'shared_factories/validate.js',
                    'shared_factories/table.js',
                    'shared_factories/pagination.js',
                    'shared_factories/document-title.js'
                ]
            });
        }]
    }
})
