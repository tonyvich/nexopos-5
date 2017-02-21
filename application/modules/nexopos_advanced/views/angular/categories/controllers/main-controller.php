var categoriesMain          =   function( categoriesTextDomain, $scope, $http, categoryResource, $location, validate, table, categoryTable, paginationFactory ) {

    $scope.textDomain       =   categoriesTextDomain;
    $scope.validate         =   validate;
    $scope.table            =   table;
    $scope.table.columns    =   categoryTable.columns;

    /**
     *  Table Get
     *  @param object query object
     *  @return void
    **/

    $scope.table.get        =   function( params ){
        categoryResource.get( params,function( data ) {
            $scope.table.entries        =   data.entries;
            $scope.table.pages          =   Math.ceil( data.num_rows / $scope.table.limit );
        });
    }

    // Get Results
    $scope.table.limit      =   10;
    $scope.table.order_type =   'asc';
    $scope.table.getPage(0);
}

categoriesMain.$inject    =   [ 'categoriesTextDomain', '$scope', '$http', 'categoryResource', '$location', 'validate', 'table', 'categoryTable', 'paginationFactory' ];

tendooApp.controller( 'categoriesMain', categoriesMain );
