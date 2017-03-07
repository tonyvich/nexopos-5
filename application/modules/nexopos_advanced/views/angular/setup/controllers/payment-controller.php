var setupPayment        =   function(
    $scope,
    $http,
    $location,
    setupData,
    sharedValidate,
    sharedStorageResource,
    sharedAlert,
    sharedDocumentTitle,
    sharedOptions
 ) {
     $scope.setup           =   setupData;
     $scope.options         =   $scope.setup.options;
     $scope.yesOrNo         =   sharedOptions.yesOrNo;

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

setupPayment.$inject    =   [
    '$scope',
    '$http',
    '$location',
    'setupData',
    'sharedValidate',
    'sharedStorageResource',
    'sharedAlert',
    'sharedDocumentTitle',
    'sharedOptions'
];

tendooApp.controller( 'setupPayment', setupPayment );
