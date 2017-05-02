<?php 
class NexoPOS_Misc_Library
{
    /**
     * Get Currencies
     * @param void
     * @return array
    **/
    
    public function get_currencies()
    {
        global $Options;
        $rawCurrencies      =   json_decode( file_get_contents( MODULESPATH . '/nexopos_advanced/inc/currencies.json' ), true );
        
        $shopCurrency       =   @$Options[ 'shop_currency' ];

        if( ! in_array( $shopCurrency, [ 'default', null ], true ) ) {
            $stdClass   =   new stdClass;
            $stdClass->symbol   =   @$rawCurrencies[ $shopCurrency ][ 'symbol' ];
            $stdClass->name     =   @$rawCurrencies[ $shopCurrency ][ 'name' ];
            $stdClass->iso      =   @$rawCurrencies[ $shopCurrency ][ 'code' ];
            return $stdClass;
        }

        $stdClass   =   new stdClass;
        $stdClass->symbol   =   @$Options[ 'shop_currency_symbol' ];
        $stdClass->name     =   '';
        $stdClass->iso      =   @$Options[ 'shop_currency_iso' ];
        return $stdClass;
    }
}