var registersMain          =   function(
    registersAddTextDomain,
    $scope,
    $http,
    registersResource,
    $location,
    sharedValidate,
    sharedTable,
    registerTable,
    paginationFactory,
    sharedTableActions,
    sharedAlert,
    sharedEntryActions,
    sharedDocumentTitle
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Liste des Caisse enregistreuse', 'nexopos_advanced' );?>' );
    $scope.textDomain           =   registersAddTextDomain;
    $scope.validate             =   new sharedValidate();
    $scope.table                =   new sharedTable();
    $scope.table.columns        =   registerTable.columns;
    $scope.table.entryActions   =   new sharedEntryActions();
    $scope.table.actions        =   new sharedTableActions();

    /** Adjust Entry actions **/
    _.each( $scope.table.entryActions, function( value, key ) {
        if( value.namespace == 'edit' ) {
            $scope.table.entryActions[ key ].path      =    '/registers/edit/';
        }
    });

    /**
     *  Table Get
     *  @param object query object
     *  @return void
    **/

    $scope.table.get        =   function( params ){
        registersResource.get( params,function( data ) {
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
        registersResource.delete( params, function( data ) {
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

registersMain.$inject    =   [
    'registersAddTextDomain',
    '$scope',
    '$http',
    'registersResource',
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

tendooApp.controller( 'registersMain', registersMain );
