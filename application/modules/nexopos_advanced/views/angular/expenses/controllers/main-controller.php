var expensesMain          =   function( $scope, $http, expensesTextDomain, expensesResource, $location, validate, table, expensesTable, paginationFactory, sharedTableActions, sharedAlert, sharedEntryActions, sharedDocumentTitle ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Liste des dépenses', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   expensesTextDomain;
    $scope.validate         =   validate;
    $scope.table            =   table;
    $scope.table.columns    =   expensesTable.columns;

    /** Adjust Entry actions **/
    _.each( sharedEntryActions, function( value, key ) {
        if( value.namespace == 'edit' ) {
            sharedEntryActions[ key ].path      =    '/expenses/edit/';
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
        expensesResource.get( params,function( data ) {
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
        expensesResource.delete( params, function( data ) {
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

expensesMain.$inject    =   [ '$scope', '$http', 'expensesTextDomain',  'expensesResource', '$location', 'validate', 'table', 'expensesTable', 'paginationFactory', 'sharedTableActions', 'sharedAlert', 'sharedEntryActions', 'sharedDocumentTitle' ];

tendooApp.controller( 'expensesMain', expensesMain );
