<script type="text/javascript">
    tendooApp.controller("userLogLogController",[
        '$scope',
        '$location',
        '$http',
        ( $scope, $location, $http ) => {

            $scope.limit              =   10; // Define the number of line shown
            $scope.order_type         =   'desc'; // Define the order of data
            $scope.order_by           =   'date_action';
            
            // Columns of the log table
            $scope.columns = [
                {
                    namespace : 'action',
                    text      : "<?php echo _s("Action","user_log") ?>",
                    width     : 600
                },
                {
                    namespace : 'date_action',
                    text      : "<?php echo _s("Date action","user_log") ?>",
                    width     : 200
                }
            ];

            $scope.pageNumRows = [ 10, 20, 40, 60, 100 ];

            /**
             *  Order 
             *  @param column
             *  @return void
            **/

            $scope.order      =   ( column ) => {
                
                // Set table order
                if( angular.isUndefined( $scope.order_type ) ) {
                    $scope.order_type   =   'desc';
                } else if( $scope.order_type == 'desc' ) {
                    $scope.order_type   =   'asc';
                } else  if( $scope.order_type == 'asc' ) {
                    $scope.order_type   =   'desc';
                }

                if( angular.isDefined( column ) ) {
                    $scope.order_by           =   column;
                }

                $scope.get();
            }

            /**
             *  Get ( Get data ) 
             *  @param params
             *  @return void
            **/

            $scope.get            =   () => 
            {
                $http.get( '<?php echo site_url( [ 'dashboard', 'user_log', 'get' ] );?>/?order_by=' + $scope.order_by + '&order_type=' + $scope.order_type + '&limit=' + $scope.limit + '&current_page=' +  $scope.currentPage + '&selected_user=' + $scope.selectedUser ).then( ( returned ) => {
                    $scope.entries = returned.data.actions;
                    $scope.pages   = Math.ceil( returned.data.num_actions / $scope.limit );
                });
            }

            /**
             *  GetUsers 
             *  @param params
             *  @return void
            **/

            $scope.getUsers            =   () => 
            {
                $http.get( '<?php echo site_url( [ 'dashboard', 'user_log', 'get' ] );?>').then( ( returned ) => {
                    $scope.users         = returned.data.users;
                });
            }

            /**
            *  Get Page
            *  @param int page id
            *  @return void
            **/

            $scope.getPage                =   ( id ) => 
            {
                $scope.currentPage        =   id + 1;
                $scope.order();
            }

            /**
            *  Get Number
            *  @param int
            *  @return array
            **/

            $scope.__getNumber        =   ( number ) => 
            {
                if( angular.isDefined( number ) ) {
                    return new Array( number );
                }
            }

            /**
            *  Search
            *  @param void
            *  @return void
            **/

            $scope.search                     =   function()
            {
                $http.get( '<?php echo site_url( [ 'dashboard', 'user_log', 'get' ] );?>/?search=' + $scope.searchModel ).then( ( returned ) => {
                    $scope.entries = returned.data.actions;
                    $scope.pages   = Math.ceil( returned.num_actions / $scope.limit );
                });
            }
            
            $scope.getUsers();
            $scope.selectedUser  = <?php echo User::id() ?>;
            $scope.get();
        }
    ]);
</script>