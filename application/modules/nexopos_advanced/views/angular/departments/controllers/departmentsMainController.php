var departmentsMainController = function($scope){
    $scope.hello = "HelloWorld !!!";
}

departmentsMainController.$inject = ['$scope'];
tendooApp.controller('departmentsMain',departmentsMainController);
