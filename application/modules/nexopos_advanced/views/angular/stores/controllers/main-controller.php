var storesMain          =   function( storesAddTextDomain, $scope, $http, storesResource, $location, sharedValidate, sharedTable, registerTable, paginationFactory, sharedTableActions, sharedAlert, sharedEntryActions, sharedDocumentTitle ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Liste des boutiques', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   storesAddTextDomain;
    $scope.validate         =   new sharedValidate();
    $scope.table            =   new sharedTable();
    $scope.table.columns    =   registerTable.columns;

    /** Adjust Entry actions **/
    _.each( sharedEntryActions, function( value, key ) {
        if( value.namespace == 'edit' ) {
            sharedEntryActions[ key ].path      =    '/stores/edit/';
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
        storesResource.get( params,function( data ) {
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
        storesResource.delete( params, function( data ) {
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

storesMain.$inject    =   [
    'storesAddTextDomain',
    '$scope',
    '$http',
    'storesResource',
    '$location',
    'sharedValidate',
    'sharedTable',
    'registerTable',
    'paginationFactory',
    'sharedTableActions',
    'sharedAlert',
    'sharedEntryActions',
    'sharedDocumentTitle'
];

tendooApp.controller( 'storesMain', storesMain );
