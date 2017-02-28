.when('/coupons', {
    templateUrl: function( urlattr ) {
        return 'templates/coupons/main';
    },
    controller: 'couponsMain',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                files: [
                    'controllers/coupons/main.js',
                    'factories/coupons/add-text-domain.js',
                    'factories/coupons/fields.js',
                    'factories/coupons/resource.js',
                    'factories/coupons/table.js',
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


/**
 * For Editing Purposes
**/

.when('/coupons/edit/:id?', {
    templateUrl: function( urlattr ) {
        return 'templates/coupons/edit';
    },
    controller: 'couponsEdit',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'couponsEdit',
                files: [
                    'controllers/coupons/edit.js',
                    'factories/coupons/edit-text-domain.js',
                    'factories/coupons/fields.js',
                    'factories/coupons/resource.js',
                    'factories/coupons/table.js',
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



.when('/coupons/:page', {
    templateUrl: function( urlattr ) {
        if( typeof urlattr.page != 'undefined' ) {
            return 'templates/coupons/' + urlattr.page;
        }
        return 'templates/coupons/main';
    },
    controller: 'coupons',
    resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
            return $ocLazyLoad.load({
                name: 'coupons',
                files: [
                    'controllers/coupons/add.js',
                    'factories/coupons/add-text-domain.js',
                    'factories/coupons/fields.js',
                    'factories/coupons/resource.js',
                    'factories/coupons/table.js',
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
