var itemsMain          =   function(
    $scope,
    $http,
    $location,
    itemsTextDomain,
    itemsResource,
    itemsTable,
    paginationFactory,
    sharedTableActions,
    sharedAlert,
    sharedEntryActions,
    sharedDocumentTitle,
    sharedValidate,
    sharedTable,
    sharedTableHeaderButtons
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Liste des articles', 'nexopos_advanced' );?>' );
    $scope.validate             =   new sharedValidate();
    $scope.table                =   new sharedTable( '<?php echo _s( 'Liste des articles', 'nexopos_advanced' );?>' );
    $scope.table.entryActions   =   new sharedEntryActions();
    $scope.table.actions        =   new sharedTableActions();
    $scope.table.headerButtons  =   new sharedTableHeaderButtons( itemsResource, itemsTable.columns );
    $scope.table.columns        =   itemsTable.columns;
    $scope.textDomain           =   itemsTextDomain;
    $scope.table.resource       =   itemsResource;

    /** Adjust Entry actions **/
    _.each( $scope.table.entryActions, function( value, key ) {
        if( value.namespace == 'edit' ) {
            $scope.table.entryActions[ key ].name      =    '<?php echo _s( 'Consulter', 'nexopos_advanced' );?>';
            $scope.table.entryActions[ key ].path      =    '/items/view/';
        }
    });


    /**
     *  Table Get
     *  @param object query object
     *  @return void
    **/

    $scope.table.get        =   function( params ){
        // If params is not set, let set it a default value
        if( typeof  params == 'undefined' ) {
            params      =   new Object;
        }

        // add load variations
        params.variations   =   true;
        
        itemsResource.get( params,function( data ) {
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
        itemsResource.delete( params, function( data ) {
            $scope.table.get();
        },function(){
            sharedAlert.warning( '<?php echo _s(
                'Une erreur s\'est produite durant l\'operation',
                'nexopos_advanced'
            );?>' );
        });
    }

    // Get Results
    $scope.table.getPage(0);
}

itemsMain.$inject    =   [
    '$scope',
    '$http',
    '$location',
    'itemsTextDomain',
    'itemsResource',
    'itemsTable',
    'paginationFactory',

    'sharedTableActions',
    'sharedAlert',
    'sharedEntryActions',
    'sharedDocumentTitle',
    'sharedValidate',
    'sharedTable',
    'sharedTableHeaderButtons'
];

tendooApp.controller( 'itemsMain', itemsMain );
