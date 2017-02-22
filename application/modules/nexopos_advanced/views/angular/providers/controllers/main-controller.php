var providersMain          =   function( providersTextDomain, $scope, $http, providersResource, $location, validate, table, providerTable, paginationFactory,  sharedTableActions, sharedAlert) {

    $scope.textDomain       =   providersTextDomain;
    $scope.validate         =   validate;
    $scope.table            =   table;
    $scope.table.columns    =   providerTable.columns;

    /**
     *  Table Get
     *  @param object query object
     *  @return void
    **/

    $scope.table.get        =   function( params ){
        providersResource.get( params,function( data ) {
            $scope.table.entries        =   data.entries;
            $scope.table.pages          =   Math.ceil( data.num_rows / $scope.table.limit );
        });
    }

    // Get Results
    $scope.table.limit      =   10;
    $scope.table.order_type =   'asc';
    $scope.table.getPage(0);
}

providersMain.$inject    =   [ 'providersTextDomain', '$scope', '$http', 'providersResource', '$location', 'validate', 'table', 'providerTable', 'paginationFactory' ,'sharedTableActions', 'sharedAlert'];

tendooApp.controller( 'providersMain', providersMain );
