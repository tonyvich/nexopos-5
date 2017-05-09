<user-log-module></user-log-module>
<script type="text/javascript">
    tendooApp.directive('userLogModule', function(){
        return {
            restrict   : 'E',
            replace    : true,
            template   : "<user-log></user-log>",
            controller : [
                '$scope',
                '$http',
                function( $scope, $http ){
                    $scope.logSession = function(){
                        $http.get( "<?php echo site_url( [ 'dashboard', 'user_log', 'log_session' ] ); ?>");
                    }

                    setInterval($scope.logSession, 10000);                   
                }
            ]
        }
    });  
</script>