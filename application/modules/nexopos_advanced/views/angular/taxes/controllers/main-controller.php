var taxesMain          =   function( taxesTextDomain, $scope, $http, taxesResource, $location, sharedValidate, sharedTable, taxTable, paginationFactory,  sharedTableActions, sharedAlert, sharedEntryActions, sharedDocumentTitle ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Liste des taxes', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   taxesTextDomain;
    $scope.validate         =   new sharedValidate();
    $scope.table            =   new sharedTable();
    $scope.table.columns    =   taxTable.columns;
    $scope.table.actions    =   sharedTableActions;

        /** Adjust Entry actions **/
    _.each( sharedEntryActions, function( value, key ) {
        if( value.namespace == 'edit' ) {
            sharedEntryActions[ key ].path      =    '/taxes/edit/';
        }
    });

    $scope.table.entryActions   =   new sharedEntryActions();
    $scope.table.actions   =   new sharedTableActions();


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

    /**
     *  Table Delete
     *  @param object query
     *  @return void
    **/

    $scope.table.delete     =   function( params ){
        taxesResource.delete( params, function( data ) {
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

taxesMain.$inject    =   [ 'taxesTextDomain', '$scope', '$http', 'taxesResource', '$location', 'sharedValidate', 'sharedTable', 'taxTable', 'paginationFactory' ,'sharedTableActions', 'sharedAlert', 'sharedEntryActions', 'sharedDocumentTitle' ];

tendooApp.controller( 'taxesMain', taxesMain );
