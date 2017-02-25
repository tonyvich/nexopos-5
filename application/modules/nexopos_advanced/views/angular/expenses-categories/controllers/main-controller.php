var expensesCategoriesMain          =   function( $scope, $http, expensesCategoriesTextDomain, expensesCategoriesResource, $location, validate, sharedTable, expensesCategoriesTable, paginationFactory, sharedTableActions, sharedAlert, sharedEntryActions, sharedDocumentTitle ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Liste des catégories de dépenses', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   expensesCategoriesTextDomain;
    $scope.validate         =   new sharedValidate();
    $scope.table            =   new sharedTable();
    $scope.table.columns    =   expensesCategoriesTable.columns;

    /** Adjust Entry actions **/
    _.each( sharedEntryActions, function( value, key ) {
        if( value.namespace == 'edit' ) {
            sharedEntryActions[ key ].path      =    '/expenses-categories/edit/';
        }
    });

    $scope.table.entryActions   =   sharedEntryActions;
    $scope.table.actions        =   sharedTableActions;

    /**
     *  Table Get
     *  @param object query object
     *  @return void
    **/

    $scope.table.get        =   function( params ){
        expensesCategoriesResource.get( params,function( data ) {
            $scope.table.entries        =   data.entries;
            $scope.table.pages          =   Math.ceil( data.num_rows / $scope.table.limit );
        });
    }

    /**
     *  Table Delete
     *  @param object query
     *  @return void
    **/

    $scope.table.delete     =   function( params ){
        expensesCategoriesResource.delete( params, function( data ) {
            $scope.table.get();
        },function(){
            sharedAlert.warning( '<?php echo _s(
                'Une erreur s\'est produite durant l\'operation',
                'nexopos_advanced'
            );?>' );
        });
    }

    // Get Results
    $scope.table.limit      =   10;
    $scope.table.getPage(0);
}

expensesCategoriesMain.$inject    =   [ '$scope', '$http', 'expensesCategoriesTextDomain',  'expensesCategoriesResource', '$location', 'sharedValidate', 'sharedTable', 'expensesCategoriesTable', 'paginationFactory', 'sharedTableActions', 'sharedAlert', 'sharedEntryActions', 'sharedDocumentTitle' ];

tendooApp.controller( 'expensesCategoriesMain', expensesCategoriesMain );
