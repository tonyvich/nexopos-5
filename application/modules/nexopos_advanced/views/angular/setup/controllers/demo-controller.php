var setupDemo        =   function(
    $scope,
    $http,
    $location,
    setupData,
    setupSiteType,
    sharedValidate,
    sharedStorageResource,
    sharedAlert,
    sharedDocumentTitle
 ) {
     $scope.setup       =   setupData;
     $scope.options     =   $scope.setup.options;
     $scope.siteType    =   setupSiteType;

     // Default
     $scope.options[ 'site_type' ]      =   $scope.siteType[0];

     /**
      *  GoTo
      *  @param string slug
      *  @return void
     **/

     $scope.goto        =   function( string ){
         $location.path( string );
     }
}

setupDemo.$inject    =   [
    '$scope',
    '$http',
    '$location',
    'setupData',
    'setupSiteType',
    'sharedValidate',
    'sharedStorageResource',
    'sharedAlert',
    'sharedDocumentTitle'
];

tendooApp.controller( 'setupDemo', setupDemo );
