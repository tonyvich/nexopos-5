var deliveriesMain          =   function( deliveriesTextDomain, $scope, $http, deliveriesResource, $location, validate, table, deliveriesTable, paginationFactory ) {

    $scope.textDomain       =   deliveriesTextDomain;
    $scope.validate         =   validate;
    $scope.table            =   table;
    $scope.table.columns    =   deliveriesTable.columns;

    /**
     *  Table Get
     *  @param object query object
     *  @return void
    **/

    $scope.table.get        =   function( params ){
        deliveriesResource.get( params,function( data ) {
            $scope.table.entries        =   data.entries;
            $scope.table.pages          =   Math.ceil( data.num_rows / $scope.table.limit );
        });
    }

    // Get Results
    $scope.table.limit      =   10;
    $scope.table.getPage(0);
}

deliveriesMain.$inject    =   [ 'deliveriesTextDomain', '$scope', '$http', 'deliveriesResource', '$location', 'validate', 'table', 'deliveriesTable', 'paginationFactory' ];

tendooApp.controller( 'deliveriesMain', deliveriesMain );
