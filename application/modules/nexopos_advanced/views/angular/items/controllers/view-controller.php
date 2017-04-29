<?php if( true == false ):?><script><?php endif;?>
var itemsView      =   function( 
    $scope,
    $http,
    $compile,
    $location,
    itemsTextDomain,
    itemsResource,
    itemsTable,
    itemsViewTabs,
    paginationFactory,
    sharedTableActions,
    sharedAlert,
    sharedEntryActions,
    sharedDocumentTitle,
    sharedValidate,
    sharedTable
) {

    $scope.tabs         =   itemsViewTabs;

    /**
     * Enable Tabs
     * @param object tab
     * @return void
    **/
    
    $scope.enableTab 	= function( tab ){
        $scope.tabs.forEach( ( tab ) => {
            tab.active  =   false;
        });

        if( angular.element( tab.namespace ).length == 0 ) {
            
            angular.element( '.tab-' + tab.namespace ).append( '<' + tab.namespace + '></' + tab.namespace + '>' );

            console.log( $( '.tab-' + tab.namespace ).length );
            console.log( '.tab-' + tab.namespace );

            angular.element( '.tab-' + tab.namespace ).html( 
                $compile( angular.element( '.tab-' + tab.namespace ).html() )( $scope ) 
            );
        }
        tab.active      =   true;
    }

    // Enable first tab
    setTimeout( () => {
        $scope.enableTab( $scope.tabs[0] );
    }, 100 );
}

itemsView.$inject          =   [
    '$scope',
    '$http',
    '$compile',
    '$location',
    'itemsTextDomain',
    'itemsResource',
    'itemsTable',
    'itemsViewTabs',
    'paginationFactory',
    'sharedTableActions',
    'sharedAlert',
    'sharedEntryActions',
    'sharedDocumentTitle',
    'sharedValidate',
    'sharedTable'
]

tendooApp.controller( 'itemsView', itemsView );