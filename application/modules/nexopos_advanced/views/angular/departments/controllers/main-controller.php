var departmentsMain          =   function( departmentsTextDomain, $scope, $http, departmentsResource, $location, validate, table, departmentsTable, paginationFactory, sharedTableActions, sharedAlert,sharedEntryActions) {

    $scope.textDomain       =   departmentsTextDomain;
    $scope.validate         =   validate;
    $scope.table            =   table;
    $scope.table.columns    =   departmentsTable.columns;
    $scope.table.actions    =   sharedTableActions;


    /** Adjust Entry actions **/
    _.each( sharedEntryActions, function( value, key ) {
        if( value.namespace == 'edit' ) {
            sharedEntryActions[ key ].path      =    '/departments/edit/';
        }
    });

    $scope.table.entryActions   =   sharedEntryActions;
    $scope.table.actions        =   sharedTableActions

    /**
     *  Table Get
     *  @param object query object
     *  @return void
    **/

    $scope.table.get        =   function( params ){
        departmentsResource.get( params,function( data ) {
            $scope.table.entries        =   data.entries;
            $scope.table.pages          =   Math.ceil( data.num_rows / $scope.table.limit );
        });
    }

    // Get Results
    $scope.table.limit      =   10;
    $scope.table.getPage(0);


     /**
     *  Table Delete
     *  @param object query
     *  @return void
    **/

    $scope.table.delete     =   function( params ){
        departmentsResource.delete( params, function( data ) {
            $scope.table.get();
        },function(){
            sharedAlert.warning( '<?php echo _s(
                'Une erreur s\'est produite durant l\'operation',
                'nexopos_advanced'
            );?>' );
        });
    }
}

departmentsMain.$inject    =   [ 'departmentsTextDomain', '$scope', '$http', 'departmentsResource', '$location', 'validate', 'table', 'departmentsTable', 'paginationFactory', 'sharedTableActions', 'sharedAlert','sharedEntryActions'];

tendooApp.controller( 'departmentsMain', departmentsMain );
