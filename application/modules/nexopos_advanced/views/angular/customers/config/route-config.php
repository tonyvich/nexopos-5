/*
 * For add Purpose
 */

.when('/customers/add', {
    templateUrl: function( urlattr ) {
        if( typeof urlattr.page != 'undefined' ) {
            return 'templates/customers/' + urlattr.page;
        }
        return 'templates/customers/add';
    },
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'customersAdd',
                files: [
                    'controllers/customers/add.js',
                    'directives/customers/customers-details.js',
                    'factories/customers/fields.js',
                    'factories/customers/advanced-fields.js',
                    'factories/customers/resource.js',
                    'factories/customers/resource-address.js',
                    'factories/customers/tabs.js',
                    'factories/customers-groups/resource.js',
                    'shared_factories/countries.js',
                    'shared_factories/filter-item.js',
                    'shared_factories/document-title.js',
                    'shared_factories/validate.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/options.js',
                    'shared_factories/field-editor.js',
                    'shared_factories/alert.js',
                    'shared_factories/moment.js',
                    'shared_factories/filter-item.js'
                ]
            });
        }]
    }
})

/*
 *For Read purpose 
 */

 .when('/customers', {
    templateUrl: function( urlattr ) {
        return 'templates/customers/main';
    },
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/customers/main.js',
                    'factories/customers/add-text-domain.js',
                    'factories/customers/fields.js',
                    'factories/customers/resource.js',
                    'factories/customers/table.js',
                    'shared_factories/options.js',
                    'shared_factories/table-header-buttons.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/validate.js',
                    'shared_factories/table.js',
                    'shared_factories/pagination.js',
                    'shared_factories/table-actions.js',
                    'shared_factories/alert.js',
                    'shared_factories/entry-actions.js',
                    'shared_factories/document-title.js',
                ]
            });
        }]
    }
})
