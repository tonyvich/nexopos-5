var expensesMain          =   function( 
    $scope, 
    $http,
    $location, 
    expensesTextDomain, 
    expensesResource,
    expensesTable, 
    paginationFactory,
    sharedValidate, 
    sharedTable,
    sharedTableActions,
    sharedTableHeaderButtons,   
    sharedAlert, 
    sharedEntryActions, 
    sharedDocumentTitle 
    ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Liste des dépenses', 'nexopos_advanced' );?>' );
    $scope.textDomain           =   expensesTextDomain;
    $scope.validate             =   new sharedValidate();
    $scope.table                =   new sharedTable();
    $scope.table.columns        =   expensesTable.columns;
    $scope.table.entryActions   =   new sharedEntryActions();
    $scope.table.actions        =   new sharedTableActions();
    $scope.table.headerButtons  =   new sharedTableHeaderButtons( expensesResource, expensesTable.columns );
    $scope.table.resource       =   expensesResource;

    /** Adjust Entry actions **/
    _.each( $scope.table.entryActions, function( value, key ) {
        if( value.namespace == 'edit' ) {
            $scope.table.entryActions[ key ].path      =    '/expenses/edit/';
        }
    });

    /**
     *  Table Get
     *  @param object query object
     *  @return void
    **/

    $scope.table.get        =   function( params ){
        expensesResource.get( params,function( data ) {
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
        expensesResource.delete( params, function( data ) {
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

expensesMain.$inject    =   [ 
    '$scope', 
    '$http', 
    '$location',
    'expensesTextDomain',  
    'expensesResource', 
    'expensesTable',
    'paginationFactory',
    'sharedValidate', 
    'sharedTable',
    'sharedTableActions',
    'sharedTableHeaderButtons',  
    'sharedAlert', 
    'sharedEntryActions', 
    'sharedDocumentTitle' 
];

tendooApp.controller( 'expensesMain', expensesMain );
