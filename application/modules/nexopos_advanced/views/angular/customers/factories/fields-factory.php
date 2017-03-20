tendooApp.factory( 'customerFields', [ '$location', 'sharedOptions', function( $location, sharedOptions ){
    return [
        {
            type    :   'hidden',
            model   :   'name',
            validation  :   {
                required    :   true
            },
            label   :   '<?php echo _s( 'Nom du client', 'nexopos' );?>'
        }
    ]
}]);
