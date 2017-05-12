<?php
    global $Options;
?>
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
                '$element',
                function( $scope, $http, $element){
                    $scope.logSession = function(){
                        $http.get( "<?php echo site_url( [ 'dashboard', 'user_log', 'log_session' ] ); ?>");
                    }

                    var disconnectIdle = <?php if( isset( $Options["user_log_enable_disconnect"] )  and $Options["user_log_enable_disconnect"] == 'disabled' ){ echo 'false';} else { echo 'true';}?>;

                    setInterval($scope.logSession, 30000);

                    // Handling idle user
                    if ( disconnectIdle ){
                        $scope.idleTime = 0;
                        var body = angular.element("body");
                        
                        body.mousemove(function(e){
                            $scope.idleTime = 0;
                        });

                        body.keypress(function (e) {
                            $scope.idleTime = 0;
                        });

                        $scope.timerIncrement = function (){
                            $scope.idleTime = $scope.idleTime + 1;
                            if ($scope.idleTime > <?php if( isset( $Options["user_log_idle_time"]) and is_numeric( $Options["user_log_idle_time"] ) ){ echo $Options["user_log_idle_time"]; } else { echo 20; }?>) { // Default 20 minutes 
                                window.location.assign("<?php echo site_url( [ 'dashboard', 'user_log', 'outer' ] ); ?>");
                                return;
                            }
                        }

                        setInterval($scope.timerIncrement, 60000); // 1 minute
                    }                   
                }
            ]
        }
    });  
</script>
