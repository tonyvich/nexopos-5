var taxesMain          =   function( taxesTextDomain, $scope, $http, taxesResource, $location, validate, table, taxTable, paginationFactory,  sharedTableActions, sharedAlert) {

    $scope.textDomain       =   taxesTextDomain;
    $scope.validate         =   validate;
    $scope.table            =   table;
    $scope.table.columns    =   taxTable.columns;

    /**
     *  Table Get
     *  @param object query object
     *  @return void
    **/

    $scope.table.get        =   function( params ){
        taxesResource.get( params,function( data ) {
            $scope.table.entries        =   data.entries;
            $scope.table.pages          =   Math.ceil( data.num_rows / $scope.table.limit );
        });
    }

    // Get Results
    $scope.table.limit      =   10;
    $scope.table.order_type =   'asc';
    $scope.table.getPage(0);
}

taxesMain.$inject    =   [ 'taxesTextDomain', '$scope', '$http', 'taxesResource', '$location', 'validate', 'table', 'taxTable', 'paginationFactory' ,'sharedTableActions', 'sharedAlert'];

tendooApp.controller( 'taxesMain', taxesMain );
