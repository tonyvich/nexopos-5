var departmentsMain          =   function( departmentsTextDomain, $scope, $http, departmentsResource, $location, validate, table, departmentsTable, paginationFactory ) {

    $scope.textDomain       =   departmentsTextDomain;
    $scope.validate         =   validate;
    $scope.table            =   table;
    $scope.table.columns    =   departmentsTable.columns;

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
}

departmentsMain.$inject    =   [ 'departmentsTextDomain', '$scope', '$http', 'departmentsResource', '$location', 'validate', 'table', 'departmentsTable', 'paginationFactory' ];

tendooApp.controller( 'departmentsMain', departmentsMain );
