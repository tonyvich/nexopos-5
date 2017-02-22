var customerGroupsMain          =   function( customerGroupsTextDomain, $scope, $http, customerGroupsResource, $location, validate, table, customerGroupsTable, paginationFactory, sharedTableActions, sharedAlert ) {

    $scope.textDomain       =   customerGroupsTextDomain;
    $scope.validate         =   validate;
    $scope.table            =   table;
    $scope.table.columns    =   customerGroupsTable.columns;
    $scope.table.actions    =   sharedTableActions;

    /**
     *  Table Get
     *  @param object query object
     *  @return void
    **/

    $scope.table.get        =   function( params ){
        customerGroupsResource.get( params,function( data ) {
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
        customerGroupsResource.delete( params, function( data ) {
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

customerGroupsMain.$inject    =   [ 'customerGroupsTextDomain', '$scope', '$http', 'customerGroupsResource', '$location', 'validate', 'table', 'customerGroupsTable', 'paginationFactory', 'sharedTableActions', 'sharedAlert' ];

tendooApp.controller( 'customerGroupsMain', customerGroupsMain );
