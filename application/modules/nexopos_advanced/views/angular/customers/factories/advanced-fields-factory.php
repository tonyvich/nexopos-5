tendooApp.factory( 'customersAdvancedFields', [
    'sharedOptions',
    'customersTabs',
    'rawToOptions',
    '$location',
    function(
        sharedOptions,
        customersTabs,
        rawToOptions,
        $location
    )
    {
    return {
        billing    :
        [
            {
                type        :   'text',
                label       :   '<?php echo _s( 'Entreprise', 'nexopos_advanced' );?>',
                model       :   'company',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Entreprise du lieu de facturation.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Adresse 1', 'nexopos_advanced' );?>',
                model       :   'first_address',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Première adresse de facturation.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Adresse 2', 'nexopos_advanced' );?>',
                model       :   'second_address',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Seconde adresse de facturation.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Boite postale', 'nexopos_advanced' );?>',
                model       :   'pobox',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Boite Postale pour la première adresse de facturation.', 'nexopos_advanced' );?>'
            },{
                type        :   'select',
                label       :   '<?php echo _s( 'Pays', 'nexopos_advanced' );?>',
                model       :   'country',
                options     :   sharedOptions.yesOrNo,
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Pays du lieu de facturation.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Ville', 'nexopos_advanced' );?>',
                model       :   'town',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Ville du lieu de facturation.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Etat', 'nexopos_advanced' );?>',
                model       :   'state',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Etat du lieu de facturation.', 'nexopos_advanced' );?>'
            }
        ],
        shipping        :   [
            {
                type        :   'text',
                label       :   '<?php echo _s( 'Entreprise', 'nexopos_advanced' );?>',
                model       :   'company',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Entreprise du lieu de livraison', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Adresse 1', 'nexopos_advanced' );?>',
                model       :   'first_address',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Première adresse du lieu de livraison.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Adresse 2', 'nexopos_advanced' );?>',
                model       :   'second_address',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Seconde adresse du lieu de livraison.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Boite postale', 'nexopos_advanced' );?>',
                model       :   'pobox',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Boite postale de l\'adresse de livraison.', 'nexopos_advanced' );?>'
            },{
                type        :   'select',
                label       :   '<?php echo _s( 'Pays', 'nexopos_advanced' );?>',
                model       :   'country',
                options     :   sharedOptions.yesOrNo,
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Pays du lieu de livraison.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Ville', 'nexopos_advanced' );?>',
                model       :   'town',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Ville du lieu de livraison.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Etat', 'nexopos_advanced' );?>',
                model       :   'state',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Etat du lieu de livraison.', 'nexopos_advanced' );?>'
            }
        ]
    }
}]);
