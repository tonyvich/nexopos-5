var providersMain          =   function( providersTextDomain, $scope, $http, providersResource, $location, sharedValidate, sharedTable, providersTable, paginationFactory,  sharedTableActions, sharedAlert, sharedEntryActions, sharedDocumentTitle ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Liste des fournisseurs', 'nexopos_advanced' );?>' );
    $scope.validate             =   new sharedValidate();
    $scope.table                =   new sharedTable();
    $scope.table.entryActions   =   new sharedEntryActions();
    $scope.table.actions        =   new sharedTableActions();
    $scope.table.columns        =   providersTable.columns;
    $scope.textDomain           =   providersTextDomain;

    /** Adjust Entry actions **/
    _.each( $scope.table.entryActions, function( value, key ) {
        if( value.namespace == 'edit' ) {
            $scope.table.entryActions[ key ].path      =    '/providers/edit/';
        }
    });

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

providersMain.$inject    =   [ 'providersTextDomain', '$scope', '$http', 'providersResource', '$location', 'sharedValidate', 'sharedTable', 'providersTable', 'paginationFactory' ,'sharedTableActions', 'sharedAlert', 'sharedEntryActions', 'sharedDocumentTitle' ];

tendooApp.controller( 'providersMain', providersMain );
