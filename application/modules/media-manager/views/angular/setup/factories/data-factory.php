tendooApp.factory( 'setupData', function(){
    return new function(){

        this.options        =   new Object;

        /**
         *  reset Setup
         *  @param
         *  @return
        **/

        this.reset      =   function(){
            this.options    =   new Object;
        }

        /**
         *  set value
         *  @param string key
         *  @param string value
         *  @return void
        **/

        this.set        =   function( key, value ) {
            $this.options[ key ]    =   value;
        }

    }
})
