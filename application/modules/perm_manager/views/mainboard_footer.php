<script type="text/javascript">

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
                    title                : "<?php echo _s("Confirmez votre action","perm_manager"); ?>",
                    text                 : message,
                    type                 : "warning",
                    showCancelButton     : true,
                    confirmButtonColor   : "#DD6B55",
                    confirmButtonText    : "<?php echo _s("Oui","perm_manager"); ?>",
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
                    title                : "<?php echo _s("Attention","perm_manager"); ?>",
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
    tendooApp.factory( 'permissionsResource', function( $resource ) {
        return $resource(
            '<?php echo site_url( [ 'rest', 'perm_manager', 'permissions/id']); ?>',
            {
                id              :   '@_id'
            },{
                get : {
                    method : 'GET',
                    headers			:	{
                        '<?php echo $this->config->item('rest_key_name');?>'	:	'<?php echo @$Options[ 'rest_key' ];?>'
                    }
                },
                save : {
                    method : 'POST',
                    headers : {
                        '<?php echo $this->config->item('rest_key_name');?>'	:	'<?php echo @$Options[ 'rest_key' ];?>'
                    }
                },
                delete : {
                    method : 'DELETE',
                    headers : {
                        '<?php echo $this->config->item('rest_key_name');?>'	:	'<?php echo @$Options[ 'rest_key' ];?>'
                    }
                }
            }
        );
    });

    // Controller 

    tendooApp.controller( 'permManagerController', [ '$scope', '$http', '$element', 'sharedAlert', 'permissionsResource', function ( $scope, $http, $element, sharedAlert, permissionsResource ){
        
        $scope.roles = {}; // Contain list of all roles with their permissions
        $scope.permissions = {}; // Contain list of all permissions 
        $scope.add = {}; // Contain data to add as a permission 
        
        /**
         * Load Data
         * @param void
         * @return void
         **/

         $scope.loadData = function()
         {
             $http.get( '<?php echo site_url( [ 'dashboard', 'perm_manager', 'get' ] );?>' ).then( function( returned ){
                $scope.roles = returned.data.roles;
                $scope.permissions = returned.data.permissions;
                
                // Set the first role as the selected user for display
                $scope.selectedUser = $scope.roles[0].name;
                $scope.selectedRole = $scope.roles[0];
             });
         }

         /**
          *  change Selected Role (Change the role displayed)
          *  @param void
          *  @return void
         **/

         $scope.changeSelectedRole =  function()
         {
             _.each( $scope.roles, function( role ){
                 if( role.name == $scope.selectedUser ){
                     $scope.selectedRole = role;
                 }
             });
         }

         /**
          * Delete selected element
          * @param void
          * @return void 
          **/

         $scope.bulkDelete = function (){

             var bulkDel = [];
             
             // Add checked permission to the array
             _.each( $scope.roles, function( role ){
                _.each( role.permissions, function ( permission ){
                    if( permission.checked == true){
                       bulkDel.push( [permission.perm_name, role.name] );
                    }
                });
             });

             if ( bulkDel.length == 0)
             {
                 // If no permission selected
                return sharedAlert.warning( '<?php echo _s( 'Sélectionnez au moins un élément', 'perm_manager' );?>' );   
             } 
             else 
             {
                sharedAlert.confirm( '<?php echo _s( 'Souhaitez-vous supprimer ces élément ?', 'perm_manager' );?>', function( action ) 
                {
                    if( action ) 
                    {
                        permissionsResource.delete( {'entries[]' : bulkDel}, function( data ) 
                        {
                            $scope.loadData();
                        }
                        ,function()
                        {
                            sharedAlert.warning( '<?php echo _s(
                                'Une erreur s\'est produite durant l\'operation',
                                'perm_manager'
                            );?>' );
                        }
                        );
                    }
                });
             }
         }

         /**
          * Delete one element
          * @param String permission, String group
          * @return void  
          **/

         $scope.delete = function ( permission, group)
         {
             sharedAlert.confirm( '<?php echo _s( 'Souhaitez-vous supprimer ce droit?', 'perm_manager' );?>', function( action ) 
             {
                if( action ) 
                {
                    var entry = [];
                    entry.push( [ permission, group ] );
                    console.log( entry );
                    permissionsResource.delete( {'entries[]' : entry }, function( data ) 
                    {
                        $scope.loadData();
                    }
                    ,function()
                    {
                        sharedAlert.warning( '<?php echo _s(
                            'Une erreur s\'est produite durant l\'operation',
                            'perm_manager'
                        );?>' );
                    });
                }
            });
         }

         /**
          * Add a permission to a role
          * @param void
          * @return void
         **/

        $scope.addPermission = function ()
        {
            permissionsResource.save( 
                $scope.add, 
                function(){
                    $scope.loadData();
                }, 
                function( returned )
                {
                    if( returned.data.status === 'alreadyExists' ) {
                        sharedAlert.warning( '<?php echo _s( 'Le role possède déja cette permission', 'nexopos_advanced' );?>' );
                    } 
                    else if( returned.data.status === 'forbidden' || returned.status == 500 ) {
                        sharedAlert.warning( '<?php echo _s( 'Une erreur s\'est produite durant l\'opération.', 'nexopos_advanced' );?>' );
                    }
                }
            )
        }

         $scope.loadData();

         // UI Design 
         angular.element('.content').css('margin-bottom','-25px');
    } ]);  
</script>