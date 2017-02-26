var setupWelcome        =   function(
    $scope,
    $http,
    $location,
    sharedValidate,
    sharedStorageResource,
    sharedAlert,
    sharedDocumentTitle
 ) {
     $scope.hello   =   'Bonjoour'
}

setupWelcome.$inject    =   [
    '$scope',
    '$http',
    '$location',
    'sharedValidate',
    'sharedStorageResource',
    'sharedAlert',
    'sharedDocumentTitle'
];

tendooApp.controller( 'setupWelcome', setupWelcome );
