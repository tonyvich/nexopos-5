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
                    'factories/departments/crud.js',
                    'factories/departments/fields.js',
                    'factories/departments/resource.js',
                    'factories/departments/table.js',
                    'shared/factories/options.js',
                    'shared/factories/raw-to-options.js',
                    'shared/factories/validate.js',
                    'shared/factories/table.js',
                    'shared/factories/pagination.js'
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
                name: 'Deliveries',
                files: [
                    'controllers/departments/add.js',
                    'factories/departments/crud.js',
                    'factories/departments/fields.js',
                    'factories/departments/resource.js',
                    'factories/departments/table.js',
                    'shared/factories/options.js',
                    'shared/factories/raw-to-options.js',
                    'shared/factories/validate.js',
                    'shared/factories/table.js',
                    'shared/factories/pagination.js'
                ]
            });
        }]
    }
})
