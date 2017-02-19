.when('/departments', {
    templateUrl: function( urlattr ) {
        return 'templates/departments/main';
    },
    controller: 'departmentsMain',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/departments/departmentsMain.js',
                    'factories/departments/crud.js',
                    'factories/departments/departmentsFields.js',
                    'factories/departments/resource.js',
                    'factories/departments/departmentsTable.js',
                    'shared/factories/options.js',
                    'shared/factories/raw-to-options.js',
                    'shared/factories/validate.js',
                    'shared/factories/factoryTable.js',
                    'shared/factories/paginationFactory.js'
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
                    'controllers/departments/departmentsAdd.js',
                    'factories/departments/crud.js',
                    'factories/departments/departmentsFields.js',
                    'factories/departments/resource.js',
                    'factories/departments/factoryDeliveryTable.js',
                    'shared/factories/options.js',
                    'shared/factories/raw-to-options.js',
                    'shared/factories/validate.js',
                    'shared/factories/factoryTable.js',
                    'shared/factories/paginationFactory.js'
                ]
            });
        }]
    }
})
