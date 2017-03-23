.when('/units', {
    templateUrl: function( urlattr ) {
        return 'templates/units/main';
    },
    controller: 'unitsMain',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/units/main.js',
                    'factories/units/add-text-domain.js',
                    'factories/units/fields.js',
                    'factories/units/resource.js',
                    'factories/units/table.js',
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

.when('/units/edit/:id?', {
    templateUrl: function( urlattr ) {
        return 'templates/units/edit';
    },
    controller: 'unitsEdit',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'unitsEdit',
                files: [
                    'controllers/units/edit.js',
                    'factories/units/edit-text-domain.js',
                    'factories/units/fields.js',
                    'factories/units/resource.js',
                    'factories/units/table.js',
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

.when('/units/:page', {
    templateUrl: function( urlattr ) {
        if( typeof urlattr.page != 'undefined' ) {
            return 'templates/units/' + urlattr.page;
        }
        return 'templates/units/main';
    },
    controller: 'units',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'units',
                files: [
                    'controllers/units/add.js',
                    'factories/units/add-text-domain.js',
                    'factories/units/fields.js',
                    'factories/units/resource.js',
                    'factories/units/table.js',
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
