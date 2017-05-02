angular.element( document ).ready( function(){
    tendooApp.directive('mediaModal', function(){
        return {
             
            restrict: 'E',
            replace: true,
            template: '<div><div class="modal fade" id="myMediaModal" tabindex="-1" role="dialog" aria-labelledby="myMediaModalLabel" aria-hidden="true"> <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span></button> <h4 class="modal-title" id="myMediaModalLabel">Select a file</h4> </div> <div class="modal-body"> <div style="margin-top:10px;padding:5px;overflow-y:scroll;"> <div ng-click="selectEntry( entry )" ng-class="{ \'selected\' : entry.selected }" class="media-manager-entry-box" ng-repeat="(index, entry) in mediaEntries"> <img ng-src="{{ entry.thumb }}"/> </div> </div> </div> <div class="modal-footer"> <button type="button" class="btn btn-success" data-dismiss="modal">OK</button> </div> </div> </div></div><button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myMediaModal" style="visibility:hidden" id="mediaModalLaunch"> Launch demo modal </button></div>',
            controller : [
                '$scope',
                '$http',

                function( $scope, $http ){
                    $scope.mediaEntries   = {};

                    $scope.showMedia = function( model ){
                        $('#myMediaModal').modal('show');
                        $scope.item[ model ] = "inMediaUse"; 
                    }

                    $scope.selectEntry      =   function( entry ) {
                        _.each( $scope.mediaEntries, function( entry ) {
                            entry.selected  =   false;
                        });

                        if( angular.isUndefined( entry.selected ) ) {
                            entry.selected      =   true;
                        } else {
                            entry.selected     =   !  entry.selected;
                        }
                    }

                    $scope.modalHide = function(){
                        _.each( $scope.item, function( value, key ){
                            if( value == "inMediaUse" ){
                                _.each( $scope.mediaEntries, function( entry ){
                                    if( entry.selected == true ){
                                        $scope.item[ key ] = entry.url;
                                    }
                                });
                            }
                        });

                        _.each( $scope.item, function( value, key ){
                            if( value == "inMediaUse"){
                                $scope.item[ key ] = "";
                            }
                        });
                    }


                    $('#myMediaModal').on('hide.bs.modal', function () {
                        $scope.modalHide();
                        $scope.$apply();
                    });

                }
            ]    
        };
    }
);
});