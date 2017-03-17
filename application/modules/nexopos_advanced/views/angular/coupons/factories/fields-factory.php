tendooApp.factory( 'couponsFields', [ 'sharedOptions', function( sharedOptions ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Nom du coupon', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '',
        validation  :   {
            required        :   true
        }
    },{
        type        :   'text',
        label       :   '<?php echo _s( 'Code', 'nexopos_advanced' );?>',
        model       :   'code',
        validation  :   {
            required : true
        },
        desc        :   '<?php echo _s( 'Ce code sera utilisable sur l\'interface de vente.', 'nexopos_advanced' );?>'
    },{
        type    :   'select',
        label   :   '<?php echo _s( 'Type de réduction', 'nexopos_advanced' );?>',
        model   :   'discount_type',
        options     :   sharedOptions.percentOrFlat,
        validation : {
            required : true
        },
        desc        :   '<?php echo _s( 'Le type permettra d\'appliquer une réduction variable (pourcentage) ou fixe', 'nexopos_advanced' );?>'
    },{
        type        :   'text',
        label       :   '<?php echo _s( 'Pourcentage', 'nexopos_advanced' );?>',
        model       :   'discount_percent',
        desc        :    '<?php echo _s( 'Si vous avez choisi une réduction en pourcentage', 'nexopos_advanced' );?>',
        validation  :   {
            required : true,
            decimal  : true
        }
    },{
        type        :   'text',
        label       :   '<?php echo _s( 'Montant', 'nexopos_advanced' );?>',
        model       :   'discount_amount',
        desc        :    '<?php echo _s( 'Si vous avez choisi une réduction en montant', 'nexopos_advanced' );?>',
        validation  :   {
            required : true,
            decimal  : true
        }
    },{
        type        :   'text',
        label       :   '<?php echo _s( "Limite d'utilisation", 'nexopos_advanced' );?>',
        model       :   'usage_limit',
        desc        :   '<?php echo _s( 'Un coupon limité ne pourra être utilisé qu\'une quantité de fois bien précise', 'nexopos_advanced' );?>',
        validation  :   {
            number   : true
        }
    },{
        type        :   'datepick',
        label       :   '<?php echo _s( 'Début des réductions', 'nexopos_advanced' );?>',
        model       :   'start_date',
        desc        :   '<?php echo _s( 'Le coupon commencera à être valide à partir de cette date.', 'nexopos_advanced' );?>',
        useCurrent  :   'minutes',
        language    :   'eng',
        options     :   {
            format: 'YYYY/MM/DD HH:mm',
            showClear: true,
        }
    },{
        type        :   'datepick',
        label       :   '<?php echo _s( 'Fin des réductions', 'nexopos_advanced' );?>',
        model       :   'end_date',
        useCurrent  :   'minutes',
        desc        :   '<?php echo _s( 'Le coupon ne sera plus valide après cette date.', 'nexopos_advanced' );?>',
        language    :   'eng',
        options     :   {
            format: 'YYYY/MM/DD HH:mm',
            showClear: true
        }
    },{
        type        :   'dropdown_multiselect',
        label       :   '<?php echo _s( 'Produits concernés', 'nexopos_advanced' );?>',
        model       :   'included_items_ids',
        options     :   [],
        desc            :   '<?php echo _s( 'Appliquer ce code à quelques produits spécifiques.', 'nexopos_advanced' );?>'
    },{
        type        :   'dropdown_multiselect',
        label       :   '<?php echo _s( 'Catégories concernés', 'nexopos_advanced' );?>',
        model       :   'included_catégories_ids',
        options     :   [],
        desc            :   '<?php echo _s( 'Appliquer ce code à quelques catégories spécifiques.', 'nexopos_advanced' );?>'
    },{
        type        :   'dropdown_multiselect',
        label       :   '<?php echo _s( 'Groupe de clients concernés', 'nexopos_advanced' );?>',
        model       :   'included_customers_groups_ids',
        options     :   [],
        desc            :   '<?php echo _s( 'Appliquer ce code à des groupes d\'utilisateurs spécifiques.', 'nexopos_advanced' );?>'
    },{
        type        :   'text',
        label       :   '<?php echo _s( 'Montant minimal', 'nexopos_advanced' );?>',
        model       :   'minimum_amount',
        desc        :    '<?php echo _s( 'le coupon ne sera utilisable que si le total de la commande ne soit égale à cette valeur.', 'nexopos_advanced' );?>',
    },{
        type        :   'text',
        label       :   '<?php echo _s( 'Montant maximal', 'nexopos_advanced' );?>',
        model       :   'maximum_amount',
        desc        :    '<?php echo _s( 'le coupon ne sera utilisable que si le total de la commande n\'excède pas cette valeur.', 'nexopos_advanced' );?>',
    },{
        type        :   'textarea',
        label       :   '<?php echo _s( 'Description', 'nexopos_advanced' );?>',
        model       :   'description',
    }]
}]);
