<?php
class NexoPOS_Barcode_Library 
{
    /**
     * Barcode Generation
     * @param barcode limit
     * @return barcode
    **/
    
    public function generate_barcode( $maximum_number, $barcode_generated )
    {
        $min            =   '';
        $max            =   '';
        for( $i = 0; $i < $maximum_number ; $i++ ) {
            $min        .= '0';
            $max        .= '9';
        }

        // to avoid infinite load
        $limit          =   strlen( $min );
        $try            =   0;
        do {
            if( $try == $limit ) {
                return false;
            }
            
            $barcode    =   mt_rand( $min, $max );
            $try++;
        } while( in_array( $barcode, $barcode_generated ) );

        return $barcode;
    }
}