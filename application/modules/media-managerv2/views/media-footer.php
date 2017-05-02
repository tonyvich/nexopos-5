<script type="text/javascript">
    tendooApp.config(function(dropzoneOpsProvider){
        dropzoneOpsProvider.setOptions({
            url             : '<?php echo site_url([ 'dashboard', 'media-managerv2', 'upload' ] );?>',
            maxFilesize     : '10'
        });
    });

    tendooApp.factory( 'sharedAlert', [ 'SweetAlert', function( SweetAlert ){
        return new function(){

            /**
             *  Alert Text
             *  @param string message
             *  @return void
            **/

            this.alert      =   function( message ) {
                return SweetAlert.swal( message );
            }

            /**
             *  Confirmation
             *  @param string message
             *  @param function callback
             *  @return void
            **/

            this.confirm    =   function( message, callback ) {
                return SweetAlert.swal({
                    title                : "Confirmez votre action",
                    text                 : message,
                    type                 : "warning",
                    showCancelButton     : true,
                    confirmButtonColor   : "#DD6B55",
                    confirmButtonText    : "Oui",
                    closeOnConfirm       : typeof callback == 'function'
                }, function( isConfirm ) {
                    callback( isConfirm );
                });
            }

            /**
             *  Alert Warning
             *  @param string message
             *  @return void
            **/

            this.warning            =   function( message ) {
                return SweetAlert.swal(
                    {
                    title                : "Attention",
                    text                 : message,
                    type                 : "warning",
                    showCancelButton     : false,
                    confirmButtonColor   : "#DD6B55",
                    confirmButtonText    : "Ok",
                    closeOnConfirm       : true
                }
                );
            }
        }
    }]);


    <?php
        global $Options;
        $this->load->config( 'rest' );
    ?>
    tendooApp.factory( 'mediasResource', function( $resource ) {
        return $resource(
            '<?php echo site_url( [ 'rest', 'media_manager', 'medias']); ?>',
            {
            },
            {
               delete : {
                    method : 'DELETE',
                    headers : {
                        '<?php echo $this->config->item('rest_key_name');?>'	:	'<?php echo @$Options[ 'rest_key' ];?>'
                    }
                }
            }
        );
    });

    tendooApp.controller( 'mediaManagerCTRL', [ '$scope', '$http', 'mediasResource', 'sharedAlert', function( $scope, $http, mediasResource, sharedAlert ) {
        $scope.entries              =   [];
        $scope.multiselect          =   false;
        $scope.dzCallbacks          =   new Object;
        $scope.selectedIndex        =   0;
        $scope.dzCallbacks.sending  =   function( file, XHR, formData ) {
            var csrf_code           =   '<?php echo $this->security->get_csrf_hash(); ?>';
            formData.append( '<?php echo $this->security->get_csrf_token_name(); ?>' , csrf_code );
        }
        $scope.searchInput          =   "";

        /**
         *  Enable Bulk Select
         *  @param void
         *  @return void
        **/

        $scope.enableBulkSelect         =   function(){
            $scope.multiselect          =   true;
        }

        /**
         *  cancel bulk select
         *  @param  void
         *  @return vodi
        **/

        $scope.cancelBulkSelect         =   function(){
            $scope.multiselect          =   false;
            _.each( $scope.entries, function( entry ) {
                entry.selected      =   false;
            });
        }

        /**
         *  Select Entry
         *  @param object
         *  @return void
        **/

        $scope.selectEntry      =   function( entry, $index ) {
            $scope.selectedIndex    =   $index;
            if( $scope.multiselect == false ) {
                _.each( $scope.entries, function( entry ) {
                    entry.selected  =   false;
                });
            }

            if( angular.isUndefined( entry.selected ) ) {
                entry.selected      =   true;
            } else {
                entry.selected     =   !  entry.selected;
            }
        }

        /**
         *  Count Selected
         *  @param
         *  @return
        **/

        $scope.countSelected    =   function(){
            var selectedNbr         =   0;
            _.each( $scope.entries, function( entry ) {
                if( entry.selected ) {
                    selectedNbr++;
                }
            });

            return selectedNbr;
        }

        /**
         *  load Assets
         *  @param void
         *  @return void
        **/

        $scope.loadAssets           =   function(){
            $http.get( '<?php echo site_url( [ 'dashboard', 'media-managerv2', 'get' ] );?>' ).then(function( returned ) {
                $scope.entries  =   returned.data;
            });
        }

        /**
         *  Calculate Height
         *  @param
         *  @return
        **/

        $scope.calculateHeight      =   function(){
            $scope.usedHeight       =   angular.element( '.outerHeight-wrapper .content-header' ).outerHeight() +
            angular.element( '.content-wrapper .content' ).outerHeight();
            $scope.contentHeight    =   angular.element( '.content-wrapper' ).outerHeight();
            $scope.remainigHeight   =   $scope.contentHeight - $scope.usedHeight;
            $scope.dropZoneHeight   =   angular.element( '.content-wrapper' ).height();
            console.log( $scope.dropZoneHeight );
        }

        $scope.loadAssets();


        // $scope.remainigHeight   =   $scope.remainigHeight == 0 ? $scope.contentHeight : $scope.remainigHeight;

        /**
         *  search
         *  @param
         *  @return
        **/

        $scope.search              =     function(){
            var search = $scope.searchInput;
            $http.get( "<?php echo site_url( [ 'dashboard', 'media-managerv2', 'get' ] );?>?search=" + search ).then(function( returned ) {
                $scope.entries  =   returned.data;
            });
        }

        /**
         *  delete  delete selected element
         *  @param
         *  @return
        **/

        $scope.delete             =     function(){
            var selectedItem = [];
            _.each( $scope.entries, function( entry ) {
                if( entry.selected ) {
                    selectedItem.push( entry );
                }
            });
            sharedAlert.confirm( '<?php echo _s( 'Souhaitez-vous supprimer ces élément ?', 'perm_manager' );?>', function( action ) {
                if( action ) {
                    mediasResource.delete( { 'entries[]' : selectedItem }, function( data ) {
                        $scope.loadAssets();
                    },function(){
                        sharedAlert.warning( '<?php echo _s(
                            'Une erreur s\'est produite durant l\'operation',
                            'media-manager'
                        );?>' );
                    });
                }
            });
        }
    }]);
</script>
