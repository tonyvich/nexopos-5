<?php global $Options;?>
angular.element( document ).ready( function(){
    tendooApp.factory( 'sharedMoment', function( $interval ){
        return function(){
            $this                   =   this;
            this.serverTimeZone         =   '<?php echo @$Options[ 'site_timezone' ];?>';
            this.serverDate             =   moment( '<?php echo date_now();?>' );

            /**
             *  Time From Now
             *  @param string date
             *  @return string
            **/

            this.timeFromNow            =   function( datetime ) {
                console.log( datetime, this.serverDate );
                return moment( datetime ).from( this.serverDate );
            }

            $interval( function(){
                $this.serverDate.add( 1, 's' );
                // console.log( $this.serverDate.toString() );
            }, 1000 );

            /**
             *  Return Now Date
             *  @param void
             *  @return void
            **/

            this.now                    =   function(){
                return this.serverDate.toString();
            }
        }
    });
});
