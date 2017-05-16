<?php if( true == false ):?><script><?php endif;?>
var itemsView      =   function( 
    $scope,
    $http,
    $compile,
    $location,
    $routeParams,
    $timeout,
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
    
    $scope.enableTab 	= function({ tab }){
        $scope.tabs.forEach( ( tab ) => {
            tab.active  =   false;
        });

        angular.element( 'item-' + tab.namespace ).remove();
        angular.element( '.tab-' + tab.namespace ).append( '<item-' + tab.namespace + '></item-' + tab.namespace + '>' );
        angular.element( '.tab-' + tab.namespace ).html( 
            $compile( angular.element( '.tab-' + tab.namespace ).html() )( $scope ) 
        );

        tab.active      =   true;
    }

    // Enable first tab
    $timeout( () => {
        if( typeof $routeParams.tab == 'undefined' ) {
            $scope.enableTab({
                tab     :    $scope.tabs[0]
            });
        } else {
            let tabExist    =   false;
            _.each( $scope.tabs, ( tab ) => {
                if( tab.namespace == $routeParams.tab ) {
                    $scope.enableTab({ tab });
                    tabExist    =   true;
                } 
            });

            if( ! tabExist ) {
                $scope.enableTab({
                    tab     :    $scope.tabs[0]
                });
            }
        }        
    }, 100 );
}

itemsView.$inject          =   [
    '$scope',
    '$http',
    '$compile',
    '$location',
    '$routeParams',
    '$timeout',
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