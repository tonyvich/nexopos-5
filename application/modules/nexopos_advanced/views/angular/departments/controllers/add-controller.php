var departmentsAddController = function($scope, departmentsTextDomain, departmentsFields, validate){
    $scope.textDomain       =   departmentsTextDomain;
    $scope.fields           =   departmentsFields;
    $scope.item             =   {};
    $scope.validate         =   validate;
}

departmentsAddController.$inject = ['$scope', 'departmentsTextDomain', 'departmentsFields', 'validate'];
tendooApp.controller('departmentsAdd',departmentsAddController);
