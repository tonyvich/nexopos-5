var deliveriesMain          =   function( crud, $scope, $http, deliveryResource, $location, validate, factoryTable, factoryDeliveryTable, paginationFactory ) {

    $scope.crud             =   crud;
    $scope.validate         =   validate;
    $scope.table            =   factoryTable;
    $scope.table.columns    =   factoryDeliveryTable.columns;

    /**
     *  Table Get
     *  @param object query object
     *  @return void
    **/

    $scope.table.get        =   function( params ){
        deliveryResource.get( params,function( data ) {
            $scope.table.entries        =   data.entries;
            $scope.table.pages          =   Math.ceil( data.num_rows / $scope.table.limit );
        });
    }

    // Get Results
    $scope.table.limit      =   10;
    $scope.table.getPage(0);
}

deliveriesMain.$inject    =   [ 'crud', '$scope', '$http', 'deliveryResource', '$location', 'validate', 'factoryTable', 'factoryDeliveryTable', 'paginationFactory' ];

tendooApp.controller( 'deliveriesMain', deliveriesMain );
