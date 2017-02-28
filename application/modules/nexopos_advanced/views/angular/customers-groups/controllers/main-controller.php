var customersGroupsMain          =   function( customersGroupsTextDomain, $scope, $http, customersGroupsResource, $location, sharedValidate, sharedTable, customersGroupsTable, paginationFactory, sharedTableActions, sharedAlert,sharedEntryActions, sharedDocumentTitle  ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Liste des groupes de clients', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   customersGroupsTextDomain;
    $scope.validate         =   new sharedValidate();
    $scope.table            =   new sharedTable();
    $scope.table.columns    =   customersGroupsTable.columns;
    $scope.table.actions    =   sharedTableActions;


    /** Adjust Entry actions **/
    _.each( sharedEntryActions, function( value, key ) {
        if( value.namespace == 'edit' ) {
            sharedEntryActions[ key ].path      =    '/customers-groups/edit/';
        }
    });

    $scope.table.entryActions   =   sharedEntryActions;
    $scope.table.actions        =   sharedTableActions


    /**
     *  Table Get
     *  @param object query object
     *  @return void
    **/

    $scope.table.get        =   function( params ){
        customersGroupsResource.get( params,function( data ) {
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
        customersGroupsResource.delete( params, function( data ) {
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

customersGroupsMain.$inject    =   [ 'customersGroupsTextDomain', '$scope', '$http', 'customersGroupsResource', '$location', 'sharedValidate', 'sharedTable', 'customersGroupsTable', 'paginationFactory', 'sharedTableActions', 'sharedAlert','sharedEntryActions', 'sharedDocumentTitle' ];

tendooApp.controller( 'customersGroupsMain', customersGroupsMain );
