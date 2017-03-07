var setupDetails        =   function(
    $scope,
    $http,
    $location,
    setupData,
    sharedValidate,
    sharedStorageResource,
    sharedAlert,
    sharedDocumentTitle
 ) {
     $scope.setup       =   setupData;
     $scope.options     =   $scope.setup.options;

     sharedStorageResource.get({},function( returned ){
         $scope.options     =   returned;
     });


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

setupDetails.$inject    =   [
    '$scope',
    '$http',
    '$location',
    'setupData',
    'sharedValidate',
    'sharedStorageResource',
    'sharedAlert',
    'sharedDocumentTitle'
];

tendooApp.controller( 'setupDetails', setupDetails );
