tendooApp.factory( 'barcodeOptions', function( ){
    return [{
        value   :   'generate',
        label   :   '<?php echo _s( 'Générer une étiquette', 'nexopos_advanced' );?>'
    },{
        value   :   'dont_generate',
        label   :   '<?php echo _s( 'Ne pas générer une étiquette', 'nexopos_advanced' );?>'
    }];
});
