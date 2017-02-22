var providersMain          =   function( providersTextDomain, $scope, $http, providersResource, $location, validate, table, providerTable, paginationFactory,  sharedTableActions, sharedAlert) {

    $scope.textDomain       =   providersTextDomain;
    $scope.validate         =   validate;
    $scope.table            =   table;
    $scope.table.columns    =   providerTable.columns;
    $scope.table.actions    =   sharedTableActions;

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

    $scope.table.delete     =   function( params ){
        providersResource.delete( params, function( data ) {
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
    $scope.table.order_type =   'asc';
    $scope.table.getPage(0);
}

providersMain.$inject    =   [ 'providersTextDomain', '$scope', '$http', 'providersResource', '$location', 'validate', 'table', 'providerTable', 'paginationFactory' ,'sharedTableActions', 'sharedAlert'];

tendooApp.controller( 'providersMain', providersMain );
