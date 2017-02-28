var setupWelcome        =   function(
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
     $scope.setup.reset();

     $scope.options     =   $scope.setup.options;
     $scope.siteType    =   setupSiteType;

     // Default
     $scope.options[ 'site_type' ]      =   '';

     /**
      *  GoTo
      *  @param string slug
      *  @return void
     **/

     $scope.goto        =   function( string ){
         sharedStorageResource.post( {}, {
             options : $scope.options
         }, function(){
             $location.path( string );
         },function(){
             console.log( 'An Error occured' );
         });
     }
}

setupWelcome.$inject    =   [
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

tendooApp.controller( 'setupWelcome', setupWelcome );
