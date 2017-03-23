var expensesCategoriesMain          =   function(
    $scope,
    $http,
    $location,
    expensesCategoriesTextDomain,
    expensesCategoriesResource,
    expensesCategoriesTable,
    paginationFactory,
    sharedValidate,
    sharedTable,
    sharedTableActions,
    sharedTableHeaderButtons,
    sharedAlert,
    sharedEntryActions,
    sharedDocumentTitle,
    sharedMoment
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Liste des catégories de dépenses', 'nexopos_advanced' );?>' );
    
    $scope.textDomain           =   expensesCategoriesTextDomain;
    $scope.validate             =   new sharedValidate();
    $scope.table                =   new sharedTable();
    $scope.table.columns        =   expensesCategoriesTable.columns;
    $scope.table.entryActions   =   new sharedEntryActions();
    $scope.table.actions        =   new sharedTableActions();
    $scope.table.resource       =   expensesCategoriesResource;
    $scope.table.headerButtons  =   new sharedTableHeaderButtons;

    /** Adjust Entry actions **/
    _.each( $scope.table.entryActions, function( value, key ) {
        if( value.namespace == 'edit' ) {
            $scope.table.entryActions[ key ].path      =    '/expenses-categories/edit/';
        }
    });

    /**
     *  Table Get
     *  @param object query object
     *  @return void
    **/

    $scope.table.get        =   function( params ){
        expensesCategoriesResource.get( params,function( data ) {
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
        expensesCategoriesResource.delete( params, function( data ) {
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

expensesCategoriesMain.$inject    =   [
    '$scope',
    '$http',
    '$location',
    'expensesCategoriesTextDomain',
    'expensesCategoriesResource',
    'expensesCategoriesTable',
    'paginationFactory',
    'sharedValidate',
    'sharedTable',
    'sharedTableActions',
    'sharedTableHeaderButtons',
    'sharedAlert',
    'sharedEntryActions',
    'sharedDocumentTitle',
    'sharedMoment'
];

tendooApp.controller( 'expensesCategoriesMain', expensesCategoriesMain );
