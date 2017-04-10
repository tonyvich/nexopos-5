var departmentsMain          =   function( 
    $scope, 
    $http, 
    $location,
    departmentsTextDomain, 
    departmentsTable,
    departmentsResource,
    paginationFactory,
    sharedValidate, 
    sharedTableHeaderButtons,
    sharedTable,  
    sharedTableActions, 
    sharedAlert,
    sharedEntryActions, 
    sharedDocumentTitle 
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Liste des rayons', 'nexopos_advanced' );?>' );

    $scope.validate             =   new sharedValidate();
    $scope.table                =   new sharedTable( '<?php echo _s( 'Liste des rayons', 'nexopos_advanced' );?>' );
    $scope.table.entryActions   =   new sharedEntryActions();
    $scope.table.actions        =   new sharedTableActions();
    $scope.table.columns        =   departmentsTable.columns;
    $scope.textDomain           =   departmentsTextDomain;
    $scope.table.resource       =   departmentsResource;
    $scope.table.headerButtons  =   new sharedTableHeaderButtons();

    /** Adjust Entry actions **/
    _.each( $scope.table.entryActions, function( value, key ) {
        if( value.namespace == 'edit' ) {
            $scope.table.entryActions[ key ].path      =    '/departments/edit/';
        }
    });

    /**
     *  Table Get
     *  @param object query object
     *  @return void
    **/

    $scope.table.get        =   function( params ){
        departmentsResource.get( params,function( data ) {
            $scope.table.entries        =   data.entries;
            $scope.table.pages          =   Math.ceil( data.num_rows / $scope.table.limit );
        });
    }

    // Get Results
    $scope.table.limit      =   10;
    $scope.table.getPage(0);


     /**
     *  Table Delete
     *  @param object query
     *  @return void
    **/

    $scope.table.delete     =   function( params ){
        departmentsResource.delete( params, function( data ) {
            $scope.table.get();
        },function(){
            sharedAlert.warning( '<?php echo _s(
                'Une erreur s\'est produite durant l\'operation',
                'nexopos_advanced'
            );?>' );
        });
    }
}

departmentsMain.$inject    =   [ 
    '$scope', 
    '$http', 
    '$location',
    'departmentsTextDomain',
    'departmentsTable',
    'departmentsResource',
    'paginationFactory', 
    'sharedValidate',
    'sharedTableHeaderButtons', 
    'sharedTable',  
    'sharedTableActions', 
    'sharedAlert',
    'sharedEntryActions', 
    'sharedDocumentTitle' 
];

tendooApp.controller( 'departmentsMain', departmentsMain );
