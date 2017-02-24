var departmentsAddController = function($scope, $location, departmentsResource, departmentsTextDomain, departmentsFields, validate){
    $scope.textDomain       =   departmentsTextDomain;
    $scope.fields           =   departmentsFields; 
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

    $scope.submit       =   function(){
        $scope.item.author          =   <?= User::id()?>;
        $scope.item.date_creation   =   tendoo.now();

        if( ! validate.run( $scope.fields, $scope.item ).isValid ) {
            return validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        departmentsResource.save(
            $scope.item,
            function(){
                $location.url( '/departments?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

departmentsAddController.$inject = ['$scope','$location', 'departmentsResource','departmentsTextDomain', 'departmentsFields', 'validate'];
tendooApp.controller('departmentsAdd',departmentsAddController);
