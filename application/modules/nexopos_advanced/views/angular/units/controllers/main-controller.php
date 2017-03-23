var unitsMain          =   function( 
    $scope, 
    $http, 
    $location, 
    unitsTextDomain,
    unitsResource,
    unitTable,
    paginationFactory,
    sharedValidate, 
    sharedTable,   
    sharedTableActions,
    sharedTableHeaderButtons, 
    sharedAlert, 
    sharedEntryActions, 
    sharedDocumentTitle 
    ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Liste des unités', 'nexopos_advanced' );?>' );
    
    $scope.textDomain          =   unitsTextDomain;
    $scope.validate            =   new sharedValidate();
    $scope.table               =   new sharedTable();
    $scope.table.columns       =   unitTable.columns;
    $scope.table.actions       =   sharedTableActions;
    $scope.table.resource      =   unitsResource;
    $scope.table.headerButtons =   new sharedTableHeaderButtons();

    /** Adjust Entry actions **/
    _.each( sharedEntryActions, function( value, key ) {
        if( value.namespace == 'edit' ) {
            sharedEntryActions[ key ].path      =    '/units/edit/';
        }
    });

    $scope.table.entryActions   =   new sharedEntryActions();
    $scope.table.actions   =   new sharedTableActions();;

    /**
     *  Table Get
     *  @param object query object
     *  @return void
    **/

    $scope.table.get        =   function( params ){
        unitsResource.get( params,function( data ) {
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
        unitsResource.delete( params, function( data ) {
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

unitsMain.$inject    =   [ 
    '$scope', 
    '$http', 
    '$location',
    'unitsTextDomain',
    'unitsResource',
    'unitTable', 
    'paginationFactory',
    'sharedValidate', 
    'sharedTable',  
    'sharedTableActions',
    'sharedTableHeaderButtons', 
    'sharedAlert', 
    'sharedEntryActions',
    'sharedDocumentTitle' 
];

tendooApp.controller( 'unitsMain', unitsMain );
