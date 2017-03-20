tendooApp.factory( 'customerTabs', function(){
    return {
        getTabs        :   function(){
            var tabs    =   new Array;
                tabs    =   [{
                    'namespace'     :   'general',
                    'title'         :   '<?php echo _s( 'Informations generale', 'nexopos_advanced' );?>',
                    'active'        :   true,
                    'index'         :   0
                },{
                    'namespace'     :  'billing',
                    'title'         :  '<?php echo _s( 'Informations de facturation', 'nexopos_advanced' );?>',
                    'active'        :   false,
                    'index'         :   1
                },{
                    'namespace'     :   'shipping',
                    'title'         :   '<?php echo _s( 'Informations de livraison', 'nexopos_advanced' );?>',
                    'active'        :   false,
                    'index'         :   2
                }];
            return tabs;
        }
    };
});
