.when('/departments', {
    templateUrl: function( urlattr ) {
        return 'templates/departments/main';
    },
    controller: 'departmentsMain',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/departments/main.js',
                    'factories/departments/add-text-domain.js',
                    'factories/departments/fields.js',
                    'factories/departments/resource.js',
                    'factories/departments/table.js',
                    'shared_factories/options.js',
                    'shared_factories/raw-to-options.js',
                    'shared_factories/validate.js',
                    'shared_factories/table.js',
                    'shared_factories/pagination.js',
                    'shared_factories/alert.js',
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

.when('/departments/edit/:id?', {
    templateUrl: function( urlattr ) {
        return 'templates/departments/edit';
    },
    controller: 'departmentsEdit',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'departmentsEdit',
                files: [
                    'controllers/departments/edit.js',
                    'factories/departments/edit-text-domain.js',
                    'factories/departments/fields.js',
                    'factories/departments/resource.js',
                    'factories/departments/table.js',
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


.when('/departments/:page', {
    templateUrl: function( urlattr ) {
        if( typeof urlattr.page != 'undefined' ) {
            return 'templates/departments/' + urlattr.page;
        }
        return 'templates/departments/main';
    },
    controller: 'departmentsAdd',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'departments',
                files: [
                    'controllers/departments/add.js',
                    'factories/departments/add-text-domain.js',
                    'factories/departments/fields.js',
                    'factories/departments/resource.js',
                    'factories/departments/table.js',
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
