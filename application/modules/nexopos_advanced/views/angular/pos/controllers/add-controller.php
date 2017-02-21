var posControllerAdd   =   function( $scope, posResource, sharedItems ) {
    $scope.helloWorld   =   'Bonjour Tout le monde';
}

posControllerAdd.$inject   =   [ '$scope', 'posResource', 'sharedItems' ];
tendooApp.controller( 'posControllerAdd', posControllerAdd );
