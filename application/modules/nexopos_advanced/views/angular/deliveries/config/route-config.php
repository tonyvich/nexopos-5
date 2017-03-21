.when('/deliveries', {
    templateUrl: function( urlattr ) {
        return 'templates/deliveries/main';
    },
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/deliveries/main.js',
                    'factories/deliveries/add-text-domain.js',
                    'factories/deliveries/fields.js',
                    'factories/deliveries/resource.js',
                    'factories/deliveries/table.js',
                    'shared_factories/options.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/validate.js',
                    'shared_factories/table.js',
                    'shared_factories/pagination.js',
                    'shared_factories/table-actions.js',
                    'shared_factories/alert.js',
                    'shared_factories/entry-actions.js',
                    'shared_factories/document-title.js',
                    'shared_factories/moment.js'
                ]
            });
        }]
    }
})

/**
 * For Editing Purposes
**/

.when('/deliveries/edit/:id?', {
    templateUrl: function( urlattr ) {
        return 'templates/deliveries/edit';
    },
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'DeliveriesEdit',
                files: [
                    'controllers/deliveries/edit.js',
                    'factories/deliveries/edit-text-domain.js',
                    'factories/deliveries/fields.js',
                    'factories/deliveries/resource.js',
                    'factories/deliveries/table.js',
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

.when('/deliveries/:page', {
    templateUrl: function( urlattr ) {
        if( typeof urlattr.page != 'undefined' ) {
            return 'templates/deliveries/' + urlattr.page;
        }
        return 'templates/deliveries/main';
    },
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'Deliveries',
                files: [
                    'controllers/deliveries/add.js',
                    'factories/deliveries/add-text-domain.js',
                    'factories/deliveries/fields.js',
                    'factories/deliveries/resource.js',
                    'factories/deliveries/table.js',
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
