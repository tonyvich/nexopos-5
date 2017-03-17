<?php global $Options;?>
angular.element( document ).ready( function(){
    tendooApp.factory( 'sharedCurrency', function(){
        return new function(){

            this.currencyPosition   =   '<?php echo @$Options[ 'shop_currency_position' ] == null ? 'before' : @$Options[ 'shop_currency_position' ];?>';
            this.currencyFormat     =   '<?php echo @$Options[ 'shop_currency_formating' ] == null ? '0,0.00' : @$Options[ 'shop_currency_formating' ];?>';
            this.currencySymbol     =   '<?php echo @$Options[ 'shop_currency_symbol' ] == null ? '' : @$Options[ 'shop_currency_symbol' ];?>';

            /**
             *  Currency Position on Format
             *  @return string
            **/

            this.format     =   function() {
                if( this.currencyPosition == 'before' ) {
                    return this.currencySymbol + ' ' + this.currencyFormat;
                } else if( this.currencyPosition == 'before_close' ) {
                    return this.currencySymbol + this.currencyFormat;
                } else if( this.currencyPosition == 'after' ) {
                    return this.currencyFormat + ' ' + this.currencySymbol;
                } else if( this.currencyPosition == 'after_close' ) {
                    return this.currencyFormat + this.currencySymbol;
                }

                return format;
            }

        }
    });
});
