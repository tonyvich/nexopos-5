var categoriesMain          =   function( categoriesTextDomain, $scope, $http, categoriesResource, $location, validate, table, categoryTable, paginationFactory, sharedTableActions, sharedAlert ) {

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
        categoriesResource.get( params,function( data ) {
            $scope.table.entries        =   data.entries;
            $scope.table.pages          =   Math.ceil( data.num_rows / $scope.table.limit );
        });
    }

    // Get Results
    $scope.table.limit      =   10;
    $scope.table.order_type =   'asc';
    $scope.table.getPage(0);
}

categoriesMain.$inject    =   [ 'categoriesTextDomain', '$scope', '$http', 'categoriesResource', '$location', 'validate', 'table', 'categoryTable', 'paginationFactory','sharedTableActions', 'sharedAlert'];

tendooApp.controller( 'categoriesMain', categoriesMain );
