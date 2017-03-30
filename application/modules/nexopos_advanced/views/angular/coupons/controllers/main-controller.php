var couponsMain          =   function( 
    $scope, 
    $http, 
    $location,
    couponsTextDomain,
    couponsResource, 
    couponsTable,
    paginationFactory,
    sharedValidate, 
    sharedTable, 
    sharedTableActions, 
    sharedTableHeaderButtons,
    sharedAlert,
    sharedEntryActions, 
    sharedDocumentTitle  ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Liste des coupons', 'nexopos_advanced' );?>' );
    $scope.validate             =   new sharedValidate();
    $scope.table                =   new sharedTable();
    $scope.table.entryActions   =   new sharedEntryActions();
    $scope.table.actions        =   new sharedTableActions();
    $scope.table.columns        =   couponsTable.columns;
    $scope.textDomain           =   couponsTextDomain;
    $scope.table.resource       =   couponsResource;
    $scope.table.headerButtons  =   new sharedTableHeaderButtons();

    /** Adjust Entry actions **/
    _.each( $scope.table.entryActions, function( value, key ) {
        if( value.namespace == 'edit' ) {
            $scope.table.entryActions[ key ].path      =    '/coupons/edit/';
        }
    });


    /**
     *  Table Get
     *  @param object query object
     *  @return void
    **/

    $scope.table.get        =   function( params ){
        couponsResource.get( params,function( data ) {
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
        couponsResource.delete( params, function( data ) {
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

couponsMain.$inject    =   [
    '$scope',
    '$http',
    '$location',
    'couponsTextDomain',
    'couponsResource',
    'couponsTable',
    'paginationFactory',
    'sharedValidate',
    'sharedTable',
    'sharedTableActions',
    'sharedTableHeaderButtons',
    'sharedAlert',
    'sharedEntryActions',
    'sharedDocumentTitle'
];

tendooApp.controller( 'couponsMain', couponsMain );
