.when('/items', {
    templateUrl: function( urlattr ) {
        return 'templates/items/main';
    },
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name    :   'ItemsMain',
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

.when('/items/view/:id', {
    templateUrl: function( urlattr ) {
        return 'templates/items/view';
    },
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name    :   'ItemsView',
                files   :   <?php echo json_encode( $this->events->apply_filters( 'item_view_files', [
                    'controllers/items/view.js',

                    'factories/items/add-text-domain.js',
                    'factories/items/resource.js',
                    'factories/items/table.js',
                    'factories/items/view-tabs.js',
                    'factories/items/tabs.js',
                    'factories/items/types.js',
                    'factories/items/advanced-fields.js',
                    'factories/items/fields.js',
                    'factories/items/barcode-options.js',
                    'factories/items/variations-resource.js',
                    'factories/items/providers.js',

                    'factories/providers/resource.js',
                    'factories/categories/resource.js',
                    'factories/deliveries/resource.js',
                    'factories/units/resource.js',
                    'factories/taxes/resource.js',
                    'factories/departments/resource.js',
                    
                    'directives/items/edit.js',
                    'directives/items/variations.js',

                    'shared_factories/options.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/validate.js',
                    'shared_factories/table.js',
                    'shared_factories/pagination.js',
                    'shared_factories/table-actions.js',
                    'shared_factories/alert.js',
                    'shared_factories/entry-actions.js',
                    'shared_factories/document-title.js',
                    'shared_factories/field-editor.js',
                    'shared_factories/form-manager.js',
                    'shared_factories/currency.js',
                    'shared_factories/filter-item.js',
                    'shared_factories/resource-loader.js'

                ]) );?> 
            });
        }]
    }
})

.when('/items/types', {
    templateUrl: function( urlattr ) {
        return 'templates/items/types';
    },
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'ItemsType',
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
                    'factories/departments/resource.js',
                    'directives/items/variations.js',
                    'shared_factories/document-title.js',
                    'shared_factories/validate.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/options.js',
                    'shared_factories/field-editor.js',
                    'shared_factories/alert.js',
                    'shared_factories/filter-item.js',
                    'shared_factories/resource-loader.js',
                    'shared_factories/form-manager.js',
                    'shared_factories/currency.js'
                ]
            });
        }]
    }
})

.when('/items/add/:types?', {
    templateUrl: function( urlattr ) {
        return 'templates/items/add';
    },
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'ItemsAdd',
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
                    'factories/departments/resource.js',
                    'directives/items/variations.js',
                    'shared_factories/document-title.js',
                    'shared_factories/validate.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/options.js',
                    'shared_factories/field-editor.js',
                    'shared_factories/alert.js',
                    'shared_factories/filter-item.js',
                    'shared_factories/resource-loader.js',
                    'shared_factories/form-manager.js',
                    'shared_factories/currency.js'
                ]
            });
        }]
    }
})
