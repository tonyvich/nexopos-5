tendooApp.factory( 'customersTabs', function(){
    return {
        getTabs        :   function(){
            var tabs    =   new Array;
                tabs    =   [{
                    'namespace'     :  'billing',
                    'title'         :  '<?php echo _s( 'Adresse de facturation', 'nexopos_advanced' );?>',
                    'active'        :   false,
                    'index'         :   1,
                    'active'        :   true
                },{
                    'namespace'     :   'shipping',
                    'title'         :   '<?php echo _s( 'Adresse de livraison', 'nexopos_advanced' );?>',
                    'active'        :   false,
                    'index'         :   2
                }];
            return tabs;
        }
    };
});
