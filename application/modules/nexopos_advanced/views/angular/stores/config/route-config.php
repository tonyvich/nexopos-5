.when('/stores', {
    templateUrl: function( urlattr ) {
        return 'templates/stores/main';
    },
    controller: 'storesMain',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/stores/main.js',
                    'factories/stores/add-text-domain.js',
                    'factories/stores/fields.js',
                    'factories/stores/resource.js',
                    'factories/stores/table.js',
                    'shared_factories/table-header-buttons.js',
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

.when('/stores/edit/:id', {
    templateUrl: function( urlattr ) {
        return 'templates/stores/edit';
    },
    controller: 'storesEdit',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'storesEdit',
                files: [
                    'controllers/stores/edit.js',
                    'factories/stores/edit-text-domain.js',
                    'factories/stores/fields.js',
                    'factories/stores/resource.js',
                    'factories/stores/table.js',
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

.when('/stores/:page', {
    templateUrl: function( urlattr ) {
        if( typeof urlattr.page != 'undefined' ) {
            return 'templates/stores/' + urlattr.page;
        }
        return 'templates/stores/main';
    },
    controller: 'stores',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'stores',
                files: [
                    'controllers/stores/add.js',
                    'factories/stores/add-text-domain.js',
                    'factories/stores/fields.js',
                    'factories/stores/resource.js',
                    'factories/stores/table.js',
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
