<script type="text/javascript">
    tendooApp.directive('mediaModal', function(){
        return {
             
            restrict: 'A',
            replace: true,
            template: '<span class="input-group-btn"> <button class="btn btn-default" ng-click="showMedia()" type="button"><i class="fa fa-search"></i></button> </span>',
            scope: {
                model : '=model',
            },
            transclude : true,
            controller : [
                '$scope',
                '$http',
                '$attrs',
                '$compile',

                function( $scope, $http, $attrs, $compile ){
                    $scope.mediaEntries   = {};
                    var model = $attrs.model;

                    $http.get( '<?php echo site_url( [ 'dashboard', 'media-managerv2', 'get' ] );?>' ).then(function( returned ) {
                        $scope.mediaEntries = returned.data;
                    });
                    
                    /**
                     *  Show media (trigger the modal for the file selection) 
                     *  @param
                     *  @return
                    **/

                    $scope.showMedia = function(){
                        var tpl = '<div style="margin-top:10px;padding:5px;overflow-y:scroll;"> <div ng-click="selectEntry( entry )" ng-class="{ \'selected\' : entry.selected }" class="media-manager-entry-box" ng-repeat="(index, entry) in mediaEntries"> <img ng-src="{{ entry.thumb }}"/> </div> </div> </div>';
                        var message = $compile(tpl)($scope);
                        bootbox.alert({ 
                            size: "large",
                            title: "<?php echo __('Select a file','media-manager');?>",
                            message: message,
                            callback: function(){ 
                                $scope.modalHide();
                                $scope.$apply();
                            }
                        });
                        $scope.$parent.item[ $scope.model ] = "inMediaUse"; 
                    }

                    /**
                     *  Select Entry
                     *  @param
                     *  @return
                    **/

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

                    /**
                     *  modalHide 
                     *  @param
                     *  @return
                    **/

                    $scope.modalHide = function(){
                        _.each( $scope.$parent.item, function( value, key ){
                            if( value == "inMediaUse" ){
                                _.each( $scope.mediaEntries, function( entry ){
                                    if( entry.selected == true ){
                                        $scope.$parent.item[ key ] = entry.url;
                                    }
                                });
                            }
                        });

                        _.each( $scope.$parent.item, function( value, key ){
                            if( value == "inMediaUse"){
                                $scope.$parent.item[ key ] = "";
                            }
                        });
                    }
                
                /* Controller end */
                }
            ]    
        };
    });
</script>