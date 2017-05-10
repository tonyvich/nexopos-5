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

                    setInterval($scope.logSession, 10000);

                    // Handling idle user

                    $scope.idleTime = 0;
                    var body = angular.element("body");
                    
                    body.mousemove(function(e){
                        $scope.idleTime = 0;
                    });

                    body.keypress(function (e) {
                        $scope.idleTime = 0;
                    });

                    $scope.timerIncrement = function (){
                        $scope.idleTime++;
                        if ($scope.idleTime > 1) { // faisons un test sur 1 minute
                            window.location.assign("<?php echo site_url( [ 'dashboard', 'user_log', 'outer' ] ); ?>");
                            return;
                        }
                    }

                    setInterval($scope.timerIncrement, 60000); // 1 minute                   
                }
            ]
        }
    });  
</script>
