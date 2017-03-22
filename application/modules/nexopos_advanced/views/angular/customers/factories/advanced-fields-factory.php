tendooApp.factory( 'customersAdvancedFields', [
    'sharedOptions',
    'customersTabs',
    'rawToOptions',
    '$location',
    'sharedFieldEditor',
    function(
        sharedOptions,
        customersTabs,
        rawToOptions,
        $location,
        sharedFieldEditor
    )
    {
    return {
        billing    :
        [
            {
                type        :   'text',
                label       :   '<?php echo _s( 'Entreprise', 'nexopos_advanced' );?>',
                model       :   'billing_company',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Entreprise du lieu de facturation.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Adresse 1', 'nexopos_advanced' );?>',
                model       :   'billing_first_address',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Première adresse de facturation.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Adresse 2', 'nexopos_advanced' );?>',
                model       :   'billing_second_address',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Seconde adresse de facturation.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Boite postale', 'nexopos_advanced' );?>',
                model       :   'billing_pobox',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Boite Postale pour la première adresse de facturation.', 'nexopos_advanced' );?>'
            },{
                type        :   'select',
                subType     :   'country',
                label       :   '<?php echo _s( 'Pays', 'nexopos_advanced' );?>',
                model       :   'billing_country',
                options     :   [],
                show        :   function( a, b, c ){
                    return true;
                },
                desc        :   '<?php echo _s( 'Pays du lieu de facturation.', 'nexopos_advanced' );?>'
            },{
                type        :   'select',
                subType     :   'state',
                country     :   'billing_country',
                options     :   [],
                label       :   '<?php echo _s( 'Etat', 'nexopos_advanced' );?>',
                model       :   'billing_state',
                show        :   function( field, item, model ){
                    return true;
                },
                desc        :   '<?php echo _s( 'Etat du lieu de facturation.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Ville', 'nexopos_advanced' );?>',
                model       :   'billing_town',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Ville du lieu de facturation.', 'nexopos_advanced' );?>'
            }
        ],
        shipping        :   [
            {
                type        :   'text',
                label       :   '<?php echo _s( 'Entreprise', 'nexopos_advanced' );?>',
                model       :   'delivery_company',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Entreprise du lieu de livraison', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Adresse 1', 'nexopos_advanced' );?>',
                model       :   'delivery_first_address',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Première adresse du lieu de livraison.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Adresse 2', 'nexopos_advanced' );?>',
                model       :   'delivery_second_address',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Seconde adresse du lieu de livraison.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Boite postale', 'nexopos_advanced' );?>',
                model       :   'delivery_pobox',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Boite postale de l\'adresse de livraison.', 'nexopos_advanced' );?>'
            },{
                type        :   'select',
                label       :   '<?php echo _s( 'Pays', 'nexopos_advanced' );?>',
                subType     :   'country',
                model       :   'delivery_country',
                options     :   [],
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Pays du lieu de livraison.', 'nexopos_advanced' );?>'
            },{
                type        :   'select',
                label       :   '<?php echo _s( 'Etat', 'nexopos_advanced' );?>',
                subType     :   'state',
                country     :   'delivery_country',
                model       :   'delivery_state',
                options     :   [],
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Etat du lieu de livraison.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Ville', 'nexopos_advanced' );?>',
                model       :   'delivery_town',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Ville du lieu de livraison.', 'nexopos_advanced' );?>'
            }
        ]
    }
}]);
