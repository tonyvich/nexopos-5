tendooApp.factory( 'setupSiteType', function(){
    return [{
        label       :   '<?php echo _s( 'Clothe Store', 'nexopos_advanced' );?>',
        namespace   :   'clothes_store'
    },{
        label       :   '<?php echo _s( 'Bar', 'nexopos_advanced' );?>',
        namespace   :   'bar'
    },{
        label       :   '<?php echo _s( 'Restaurant & Bistro', 'nexopos_advanced' );?>',
        namespace   :   'restaurant'
    },{
        label       :   '<?php echo _s( 'Boutique digitale', 'nexopos_advanced' );?>',
        namespace   :   'good_store'
    },{
        label       :   '<?php echo _s( 'Pharmacie', 'nexopos_advanced' );?>',
        namespace   :   'pharmacy'
    },{
        label       :   '<?php echo _s( 'Agence de prestation de services', 'nexopos_advanced' );?>',
        namespace   :   'services'
    }];
})
