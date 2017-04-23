var categoriesMain          =   function(
    $scope,
    $http,
    $location,
    categoriesAddTextDomain,
    categoriesResource,
    categoryTable,
    paginationFactory,
    sharedValidate,
    sharedTable,
    sharedTableActions,
    sharedTableHeaderButtons,
    sharedAlert,
    sharedEntryActions,
    sharedDocumentTitle,
    sharedResourceLoader
)
 {

    sharedDocumentTitle.set( '<?php echo _s( 'Liste des catégories', 'nexopos_advanced' );?>' );
    
    $scope.resourceLoader       =   new sharedResourceLoader();
    $scope.textDomain           =   categoriesAddTextDomain;
    $scope.table                =   new sharedTable( '<?php echo _s( 'Liste catégories', 'nexopos_advanced' );?>' );
    $scope.table.columns        =   categoryTable.columns;
    $scope.table.entryActions   =   new sharedEntryActions();
    $scope.table.actions        =   new sharedTableActions();
    $scope.table.headerButtons  =   new sharedTableHeaderButtons();
    $scope.table.resource       =   categoriesResource;
    $scope.table.entries        =   [];
    $scope.validate             =   new sharedValidate();

    /** Adjust Entry actions **/
    _.each( $scope.table.entryActions, function( value, key ) {
        if( value.namespace == 'edit' ) {
            $scope.table.entryActions[ key ].path      =    '/categories/edit/';
        }
    });

    $scope.resourceLoader.push({
        resource        :   categoriesResource,
        params          :   {},
        success         :   function( data ) {
            $scope.table.entries        =   data.entries;
            $scope.table.pages          =   Math.ceil( data.num_rows / $scope.table.limit );
        }
    }).run();

    // Get Results
    $scope.table.getPage(0);
}

categoriesMain.$inject    =   [
    '$scope',
    '$http',
    '$location',
    'categoriesAddTextDomain',
    'categoriesResource',
    'categoryTable',
    'paginationFactory',
    'sharedValidate',
    'sharedTable',
    'sharedTableActions',
    'sharedTableHeaderButtons',
    'sharedAlert',
    'sharedEntryActions',
    'sharedDocumentTitle',
    'sharedResourceLoader'
];

tendooApp.controller( 'categoriesMain', categoriesMain );
