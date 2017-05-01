angular.element( document ).ready( function(){
    tendooApp.directive(
        'media-manager', 
        function( ){
            return {
                restrict  : 'E',
                
                replace   : true,

                scope     : { mediaModalVisible:  '=' },
                
                link : function postLink( scope, http, element ) 
                {
                    
                    scope.$watch(function(){return scope.mediaModalVisible;}, function(value){
                        if(value == true){
                            alert("true");
                            $(element).modal('show');
                        }
                    });

                    $(element).on('hidden.bs.modal', function(){
                    });

                    // Get data

                    // http.get( '<?php echo site_url( [ 'dashboard', 'media-manager', 'get' ] );?>' ).then(function( returned ) {
                    //     scope.entries  =   returned.data;
                    // });

                    /**
                     *  Select Entry
                     *  @param object
                     *  @return void
                    **/

                    scope.selectEntry      =   function( entry, $index ) {
                        
                        if( angular.isUndefined( entry.selected ) ) {
                            entry.selected      =   true;
                        } else {
                            entry.selected     =   !  entry.selected;
                        }
                    }


                },

                templateUrl  : 'media-manager-directive-tpl.html' 
            }
        }
    );
});