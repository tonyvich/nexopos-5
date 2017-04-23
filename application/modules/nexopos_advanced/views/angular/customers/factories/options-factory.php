tendooApp.factory( 'sharedOptions', function(){
    return {
        yesOrNo         :   [
            {
                value       :   'yes',
                label       :   '<?php echo _s( 'Oui', 'nexopos_advanced' );?>'
            },{
                value       :   'no',
                label       :   '<?php echo _s( 'Non', 'nexopos_advanced' );?>'
            }
        ]
    }
});
