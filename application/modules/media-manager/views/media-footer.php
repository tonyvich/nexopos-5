<script type="text/javascript">
    tendooApp.controller( 'mediaManagerCTRL', [ '$scope', function( $scope ) {
        $scope.entries      =   [];

        for( var i = 0; i < 30; i++ ) {
            $scope.entries.push({
                title       :   'Entry ' + i
            });
        }

        /**
         *  Select Entry
         *  @param object
         *  @return void
        **/

        $scope.selectEntry      =   function( object ) {
            if( angular.isUndefined( object.selected ) ) {
                object.selected =   true;
            } else {
                object.selected     =   !  object.selected;
            }
        }
    }]);
</script>
