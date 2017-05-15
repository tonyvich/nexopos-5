<script type="text/javascript">
    tendooApp.config(function(dropzoneOpsProvider){
        dropzoneOpsProvider.setOptions({
            url             : '<?php echo site_url([ 'dashboard', 'media-manager', 'upload' ] );?>',
            maxFilesize     : '10'
        });
    });

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
                    $scope.tabs         =   [{
                        title       :   '<?php echo _s( 'Select a file', 'media-manager' );?>',
                        namespace   :   'select_file'
                    },{
                        title       :   '<?php echo _s( 'Upload', 'media-manager' );?>',
                        namespace   :   'upload'
                    }];

                    /**
                     * Select Current Tab
                     * @param object tab
                     * @return void
                    **/
                    
                    $scope.selectTab = function( tab ){
                        // cancel tab status
                        _.each( $scope.tabs, ( _tab ) => {
                            _tab.active     = false;
                        });

                        tab.active          =   true;
                        $scope.currentTab   =   tab;
                    };
                    
                    $scope.mediaEntries   = {};
                    var model = $attrs.model;
                    $scope.mediaSize = "full";
                    $scope.dzCallbacks          =   new Object;
                    
                    $scope.dzCallbacks.sending  =   function( file, XHR, formData ) {
                        var csrf_code           =   '<?php echo $this->security->get_csrf_hash(); ?>';
                        formData.append( '<?php echo $this->security->get_csrf_token_name(); ?>' , csrf_code );
                    }

                    $scope.dzCallbacks.success = function(file, xhr){
                        $scope.loadAssets( 'refresh' );
                        var tpl     = <?php echo json_encode( $this->load->module_view( 'media-manager', 'media-window', null, true ) );?>;
                        $compile(tpl)($scope);
                    }

                    /**
                     *  Load Assets 
                     *  @param
                     *  @return
                    **/

                    $scope.loadAssets = function( action ){
                        $http.get( '<?php echo site_url( [ 'dashboard', 'media-manager', 'get' ] );?>' ).then(function( returned ) {
                            if( action == 'refresh' ) {
                                $scope.mediaEntries = returned.data;
                            } else {
                                $scope.mediaEntries = returned.data;
                            }
                            $scope.$apply();
                        });
                    }
                    
                    /**
                     *  Show media (trigger the modal for the file selection) 
                     *  @param
                     *  @return
                    **/

                    $scope.showMedia = function(){
                        let tpl             =   <?php echo json_encode( $this->load->module_view( 'media-manager', 'media-window', null, true ) );?>;
                        var content         =   '<div class="media-wrapper">' + tpl + '</div>'; 
                        
                        bootbox.alert({ 
                            size: "large",
                            title: "<?php echo _s('Select a file','media-manager');?>",
                            message: content,
                            callback: function(){ 
                                $scope.modalHide();
                                $scope.$apply();
                            }
                        });

                        $scope.$parent.item[ $scope.model ] = "inMediaUse"; 

                        angular.element( '.modal-dialog' ).css({
                            width           :   '95%'
                        });

                        // timeout before the window appear
                        setTimeout( () => {

                            let height      =   
                            window.innerHeight - 
                            60 - // is the modal-dialog margin
                            30 - // is the modal-body padding
                            angular.element( '.modal-header' ).outerHeight() -
                            
                            angular.element( '.modal-footer' ).outerHeight();
                            
                            angular.element( '.modal-body' ).height( 
                                height
                            );

                            angular.element( '.modal-body' ).css({
                                'padding'    :   '0px'
                            });

                            angular.element( '.media-tabs' ).height(
                                height + 20
                            );

                            angular.element( '.image-list-grid' ).height(
                                height + 20
                            )

                            angular.element( '.dropzone' ).height( height - 15 );

                            angular.element( '.media-wrapper' ).html( 
                                $compile( angular.element( '.media-wrapper' ).html() )( $scope ) 
                            );

                            $scope.selectTab( $scope.tabs[0] );  

                            $scope.loadAssets();
                            
                            $scope.$apply();
                                                      
                        }, 200 );
                    }

                    /**
                     *  Select Entry
                     *  @param
                     *  @return
                    **/

                    $scope.selectEntry      =   function( entry ) {
                        if( entry.selected ) {
                            entry.selected  =  false; 
                            return;
                        }

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
                        if( $scope.mediaSize == null){
                            $scope.mediaSize = 'full';
                        }
                        _.each( $scope.$parent.item, function( value, key ){
                            if( value == "inMediaUse" ){
                                _.each( $scope.mediaEntries, function( entry ){
                                    if( entry.selected == true ){
                                        var url = entry.url;
                                        var newUrl = url.replace("#NAMESPACE#",'-' + $scope.mediaSize );
                                        $scope.$parent.item[ key ] = newUrl;
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