<script type="text/javascript">
    tendooApp.controller("userLogStatsController", [
        '$scope',
        '$http',
        function( $scope, $http)
        {
            $scope.sessions           =  {}; // Object to content all users sessions 
            $scope.actions            =  {}; // Object to content all users actions 
            $scope.users              =  {}; // Object to content all users Informations
            $scope.usersStatistics    =  {}; // Object to content user stats ( total_works_hours, total_number_of_session, first_connect, last_disconnect )
            $scope.currentUserStats   =  {}; // Object to content the selected User stats
            $scope.selectedUser       =  ""; // Selected User for display
            $scope.userActions        =  {}; // Object to content user actions sorted
            $scope.currentUserActions =  {}; // Object to content selected USerActions 
            $scope.displayAction      =  {}; // Object to content action to be displayed

            // comparison graphics data

            $scope.months = ['01','02','03','04','05','06','07','08','09','10','11','12']; // Array of month to numeric format
            $scope.usersName  = []; // array of users name 
            $scope.hoursPerUsers = []; // Array of total duration of users session
            $scope.monthsLabels = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']; // Array of Month to a human readable for display
            $scope.bar = { legend: { display: true } }; // Comparison graphics 

            // Action table Data 
            $scope.actionTableScope = "current_month";


            /**
             *  Load Data
             *  @param void
             *  @return void
            **/

            $scope.loadData = () =>
            {
                $http.get( '<?php echo site_url( [ 'dashboard', 'user_log', 'get' ] );?>' ).then(function( returned ) {
                    
                    // Populating data
                    $scope.sessions = returned.data.sessions;
                    $scope.actions = returned.data.actions;
                    $scope.users = returned.data.users;

                    // Set the first user as the selected user for Display
                    $scope.selectedUser = $scope.users[0].name;
                    $scope.compareUsersStats();
                    $scope.handleUsersActions();
                    $scope.displayAction = $scope.userActions[ $scope.selectedUser ][ $scope.actionTableScope ]; // Set the actions of the first user for display
                });
            }

            /**
             *  change Selected User  
             *  @param void
             *  @return void
            **/

            $scope.changeSelectedUser = ()=>
            {
                $scope.currentUserStats = $scope.usersStatistics[ $scope.selectedUser ];
                $scope.displayAction = $scope.userActions[ $scope.selectedUser ][ $scope.actionTableScope ];
            }

            /**
             *  change Selected scope  
             *  @param void
             *  @return void
            **/

            $scope.changeSelectedScope = ()=>
            {
                $scope.displayAction = $scope.userActions[ $scope.selectedUser ][ $scope.actionTableScope ];
            }

            /**
             *  CompareUsers stats 
             *  @param void
             *  @return void
            **/

            $scope.compareUsersStats = ()=>
            {   
                _.each( $scope.users, function( user ){

                    var userHours = []; // Array to contain each session duration for the current user
                    var userTotalHours = 0; // Total of curent user sessions duration
                    var curUserSession = []; // Array to contain each current user session
                    
                    $scope.usersName.push( user.name ); // Add Current user name to the usersName array

                    $scope.usersStatistics[ user.name ] = {}; // Initializing statistics of current user
                    $scope.usersStatistics[ user.name ].total_session_numbers = 0;

                    $scope.usersStatistics[ user.name ].last_connect = user.last_login; // Set users stats last connect
                    $scope.usersStatistics[ user.name ].last_disconnect = user.last_activity; // Set users stats last disconnect

                    // Getting all sessions of the current user

                    _.each( $scope.sessions, function( session ){
                        if( session.user == user.id ){
                            $scope.usersStatistics[ user.name ].total_session_numbers++; // Set current user total number of sessions
                            curUserSession.push( session );
                        }
                    });

                    $scope.usersStatistics[ user.name ].first_connect = curUserSession[0].date_connexion; // Set user stats first connexion 
                    
                    // Counting all current User sessions Duration

                    _.each( $scope.months, function( month ){
                        var monthRegex = new RegExp( "<?php echo date('Y');?>-" + month,"g");
                        var monthHour = 0;
                        _.each( curUserSession, function( uSess ){
                            userTotalHours += ( Number.isInteger( parseInt( uSess.duree_session ) ) ? parseInt( uSess.duree_session ) : 0 ); // Add only tested numbers
                            if( monthRegex.test( uSess.date_connexion )){
                                monthHour += parseInt( uSess.duree_session,10 );
                            }
                        });
                        userHours.push( monthHour );
                    });
                    $scope.usersStatistics[ user.name ].total_session_hours = userTotalHours / 60; // Set total session duration statistic for the current user
                    $scope.hoursPerUsers.push( userHours ); // Add the current User total of hours to the hours per user array

                });

                $scope.currentUserStats = $scope.usersStatistics[ $scope.usersName[0]];
            }

            /**
             *  Handle Users Actions 
             *  @param void
             *  @return void
            **/

            $scope.handleUsersActions = ()=>
            {
                _.each( $scope.users, ( user )=>
                {
                    var curUserMonthActions   = []; // Array to content current User current month actions 
                    var curUserYearActions    = []; // Array to content current User current year actions
                    var curUserAllActions     = []; // Array to content all current User actions
                    var yrRegex = /<?php echo date('Y');?>/; // Regex from the current year
                    var monthRegex = new RegExp( "<?php echo date('Y-m');?>","g"); // Regex from the current year

                    _.each( $scope.actions, ( action )=>
                    {
                        if( action.user == user.id )
                        {
                            curUserAllActions.push( action );
                            if( yrRegex.test( action.date_action )){
                                curUserYearActions.push( action );

                                if( monthRegex.test( action.date_action )){
                                    curUserMonthActions.push( action );
                                }
                            }
                        }
                    });
                    $scope.userActions[ user.name ] = { current_month : curUserMonthActions, current_year : curUserYearActions, all_actions : curUserAllActions };
                });
            }
            

            $scope.loadData();
        }
    ]);
</script>