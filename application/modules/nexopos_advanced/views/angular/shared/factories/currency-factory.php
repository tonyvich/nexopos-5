<?php global $Options;?>
<?php if( true == false ):?><script><?php endif;?>
angular.element( document ).ready( function(){
    tendooApp.factory( 'sharedCurrency', function(){
        return new function(){

            this.currencyPosition   =   '<?php echo @$Options[ 'shop_currency_position' ] == null ? 'before' : @$Options[ 'shop_currency_position' ];?>';
            this.currencyFormat     =   '<?php echo @$Options[ 'shop_currency_formating' ] == null ? '0,0.00' : @$Options[ 'shop_currency_formating' ];?>';
            this.currencySymbol     =   '<?php echo $this->nexopos_misc_library->get_currencies()->symbol;?>';
            this.currencyISO        =   '<?php echo $this->nexopos_misc_library->get_currencies()->iso;?>';
            this.defaultFormat      =   '0,0.0';

            /** numeral.register( 'locale', 'EUR', {
                currency: {
                    symbol: '€'
                }
            });

            numeral.register( 'locale', 'USD', {
                currency: {
                    symbol: '€'
                }
            }); **/

            /**
             *  Currency Position on Format
             *  @return string
            **/

            this.format     =   function() {
                let value;
                if( this.currencyPosition == 'before' ) {
                     value  =   '$' + ' ' + this.currencyFormat;
                } else if( this.currencyPosition == 'before_close' ) {
                    value   =   '$' + this.currencyFormat;
                } else if( this.currencyPosition == 'after' ) {
                    value   =   this.currencyFormat + ' ' + '$';
                } else if( this.currencyPosition == 'after_close' ) {
                    value   =   this.currencyFormat + '$';
                }

                return typeof value != undefined ? value : this.defaultFormat;
            }

            /**
             * Turn a String into a money
             * @param string current amount
             * @return string formated amount
            **/
            
            this.toAmount 	=	function( money ) {
                if( parseInt( money ) >= 0 ) {
                    value   =   numeral( parseFloat( money ), this.currencyISO ).format( this.format() );
                    value   =   value.replace( '$', this.currencySymbol );
                    return value;
                }

                return money;
            }

        }
    });
});
