.when('/items/:slug/:types?', {
    templateUrl: function( urlattr ) {
        if( typeof urlattr.slug != 'undefined' ) {
            return 'templates/items/' + urlattr.slug;
        }
        return 'templates/items/';
    },
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'Items',
                files: [
                    'controllers/items/add.js',
                    'factories/items/types.js',
                    'factories/items/barcode-options.js',
                    'factories/items/fields.js',
                    'factories/items/advanced-fields.js',
                    'factories/items/providers.js',
                    'factories/items/resource.js',
                    'factories/items/variations-resource.js',
                    'factories/items/tabs.js',
                    'factories/providers/resource.js',
                    'factories/categories/resource.js',
                    'factories/deliveries/resource.js',
                    'factories/units/resource.js',
                    'factories/taxes/resource.js',
                    'directives/items/variations.js',
                    'shared_factories/document-title.js',
                    'shared_factories/validate.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/options.js',
                    'shared_factories/field-editor.js',
                    'shared_factories/alert.js',
                    'shared_factories/filter-item.js',
                    'shared_factories/resource-loader.js'
                ]
            });
        }]
    }
})

.when('/items', {
    templateUrl: function( urlattr ) {
        return 'templates/items/main';
    },
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/items/main.js',
                    'factories/items/add-text-domain.js',
                    'factories/items/resource.js',
                    'factories/items/table.js',
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
