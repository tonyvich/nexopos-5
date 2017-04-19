<?php if( true == false ):?>
<script>
<?php endif;?>
angular.element( document ).ready(function(){
    tendooApp.factory( 'sharedResourceLoader', function(){
        return function(){
            this.resourcesArray     =   [];

            /**
            * Push resource + callback
            * @param object resource + callback
            * @return object this
            **/

            this.push               =   ( object ) => {
                this.resourcesArray.push( object );
                return this;
            }

            /**
            * Run Resource Loader
            * @param int index 
            * @return void
            **/
            
            this.run                =   ( resourceIndex ) => {
                tendooApp.spinner.start();
                resourceIndex       =   typeof resourceIndex == 'undefined' ? 0 : resourceIndex;
                if( typeof this.resourcesArray[ resourceIndex ] != 'undefined' ) {
                    let currentResource     =   this.resourcesArray[ resourceIndex ];

                    if( typeof currentResource.params != 'undefined' ) {
                        currentResource.resource.get( currentResource.params, ( data ) => {                         
                            tendooApp.spinner.stop();
                            currentResource.success( data );                            
                            this.run( resourceIndex + 1 );                            
                        }, typeof currentResource.error != 'undefined' ? currentResource.error( data ) : null );
                    } else {
                        currentResource.resource.get( {}, ( data ) => {
                            tendooApp.spinner.stop();
                            currentResource.success( data );                            
                            this.run( resourceIndex + 1 );                            
                        }, typeof currentResource.error != 'undefined' ? currentResource.error( data ) : null );
                    }
                    
                } else {
                    tendooApp.spinner.stop();
                }
            }
        }
    })
})