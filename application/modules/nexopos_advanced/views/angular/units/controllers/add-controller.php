var units          =   function( unitsTextDomain, $scope, $http, unitsFields, unitsResource, $location, validate, rawToOptions ) {

    $scope.textDomain       =   unitsTextDomain;
    $scope.fields           =   unitsFields;
    $scope.item             =   {};
    $scope.validate         =   validate;

    /**
     *  Update Date
     *  @param object date
     *  @return void
    **/

    $scope.updateDate   =   function( date, key ){
        $scope.item[ key ]    =   date;
    }


    //Submitting Form

    $scope.submit       =   function(){
        $scope.item.author          =   <?= User::id()?>;
        $scope.item.date_creation   =   tendoo.now();

        if( ! validate.run( $scope.fields, $scope.item ).isValid ) {
            return validate.blurAll( $scope.fields, $scope.item );
        }
        
        $scope.submitDisabled       =   true;

        unitsResource.save(
            $scope.item,
            function(){
                $location.url( '/units?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

units.$inject    =   [ 'unitsTextDomain', '$scope', '$http', 'unitsFields', 'unitsResource', '$location', 'validate','rawToOptions'];
tendooApp.controller( 'units', units );
