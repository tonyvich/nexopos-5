<script type="text/javascript">
    tendooApp.controller("userLogStatsController", [
        '$scope',
        '$http',
        function( $scope, $http)
        {
            $scope.sessions = {};
            $scope.actions  = {};
            $scope.users    = {};
           

            // comparison graphics data

            $scope.months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
            $scope.usersName  = [];
            $scope.hoursPerUsers = [];
            $scope.monthsLabels = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            $scope.barOptions = { legend: { display: true } };

            /**
             *  Load Data
             *  @param
             *  @return
            **/

            $scope.loadData = function()
            {
                $http.get( '<?php echo site_url( [ 'dashboard', 'user_log', 'get' ] );?>' ).then(function( returned ) {
                    $scope.sessions = returned.data.sessions;
                    $scope.users = returned.data.users;
                    $scope.compareUsersStats();
                });
            }

            /**
             *  CompareUsers stats 
             *  @param
             *  @return
            **/

            $scope.compareUsersStats = function()
            {   
                _.each( $scope.users, function( user ){
                    var userHours = [];
                    var dateRegex = /<?php echo date('Y');?>/;
                    var curUserSession = [];
                    $scope.usersName.push( user.name );

                    _.each( $scope.sessions, function( session ){
                        if( dateRegex.test(session.date_connexion)){
                            if( session.user == user.id ){
                                curUserSession.push( session );
                            }    
                        }
                    });
                    
                    _.each( $scope.months, function( month ){
                        var monthRegex = new RegExp( "<?php echo date('Y');?>-" + month,"g");
                        var monthHour = 0;
                        _.each( curUserSession, function( uSess ){
                            if( monthRegex.test( uSess.date_connexion )){
                                var duree = parseInt( uSess.duree_session,10 );
                                monthHour += parseInt( uSess.duree_session );
                            }
                        });
                        userHours.push( monthHour );
                    });
                    $scope.hoursPerUsers.push( userHours );
                });
            }

            $scope.loadData();
        }
    ]);
</script>