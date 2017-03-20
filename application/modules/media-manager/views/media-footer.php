<script type="text/javascript">
    tendooApp.config(function(dropzoneOpsProvider){
        dropzoneOpsProvider.setOptions({
            url             : '<?php echo site_url([ 'dashboard', 'media-manager', 'upload' ] );?>',
            maxFilesize     : '10'
        });
    });
    tendooApp.controller( 'mediaManagerCTRL', [ '$scope', '$http', function( $scope, $http ) {
        $scope.entries              =   [];
        $scope.multiselect          =   false;
        $scope.dzCallbacks          =   new Object;
        $scope.dzCallbacks.sending  =   function( file, XHR, formData ) {
            var csrf_code           =   '<?php echo $this->security->get_csrf_hash(); ?>';
            formData.append( '<?php echo $this->security->get_csrf_token_name(); ?>' , csrf_code );
        }

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
            })
        }

        /**
         *  Select Entry
         *  @param object
         *  @return void
        **/

        $scope.selectEntry      =   function( entry ) {
            if( $scope.multiselect == false ) {
                _.each( $scope.entries, function( entry ) {
                    entry.selected  =   false;
                });
            }

            if( angular.isUndefined( entry.selected ) ) {
                entry.selected =   true;
            } else {
                entry.selected     =   !  entry.selected;
            }
        }

        /**
         *  load Assets
         *  @param void
         *  @return void
        **/

        $scope.loadAssets           =   function(){
            $http.get( '<?php echo site_url( [ 'dashboard', 'media-manager', 'get' ] );?>' ).then(function( returned ) {
                $scope.entries  =   returned.data;
            });
        }

        $scope.usedHeight       =   angular.element( '.outerHeight-wrapper .content-header' ).outerHeight() +
        angular.element( '.content-wrapper .content' ).outerHeight();
        $scope.contentHeight    =   angular.element( '.content-wrapper' ).outerHeight();
        $scope.remainigHeight   =   $scope.contentHeight - $scope.usedHeight;
        $scope.dropZoneHeight   =   150 + $scope.remainigHeight;
        $scope.loadAssets();
        // $scope.remainigHeight   =   $scope.remainigHeight == 0 ? $scope.contentHeight : $scope.remainigHeight;
    }]);
</script>
