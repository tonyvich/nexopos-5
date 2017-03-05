tendooApp.factory( 'couponsFields', [ 'options', function( options ){
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
        }
    },{
        type    :   'select',
        label   :   '<?php echo _s( 'Type de réduction', 'nexopos_advanced' );?>',
        model   :   'discount_type',
        options     :   options.percentOrFlat,
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
        label       :   '<?php echo _s( "Limite d\'utilisation", 'nexopos_advanced' );?>',
        model       :   'usage_limit',
        validation  :   {
            required : true,
            number   : true
        }
    },{
        type        :   'datepick',
        label       :   '<?php echo _s( 'Début des réductions', 'nexopos_advanced' );?>',
        model       :   'start_date',
        useCurrent  :   'minutes',
        language    :   'eng',
        options     :   {
            format: 'YYYY/MM/DD HH:mm',
            showClear: true,
        },
        validation : {
            required : true
        }
    },{
        type        :   'datepick',
        label       :   '<?php echo _s( 'Fin des réductions', 'nexopos_advanced' );?>',
        model       :   'end_date',
        useCurrent  :   'minutes',
        language    :   'eng',
        options     :   {
            format: 'YYYY/MM/DD HH:mm',
            showClear: true
        },
        validation : {
            required : true
        }
    },{
        type        :   'dropdown_multiselect',
        label       :   '<?php echo _s( 'Produits Concernés', 'nexopos_advanced' );?>',
        model       :   'included_items_ids',
        options     :   [
            {
                "id": "1",
                "label": "France",
                "capital": "Paris"
            },
            {
                "id": "2",
                "label": "United Kingdom",
                "capital": "London"
            },
            {
                "id": "3",
                "label": "Germany",
                "capital": "Berlin"
            }
        ],
        validation      :   {
            required    :   true
        },
        desc            :   '<?php echo _s( 'Appliquer ce code à quelques produits spécifiques', 'nexopos_advanced' );?>'
    },{
        type        :   'textarea',
        label       :   '<?php echo _s( 'Description', 'nexopos_advanced' );?>',
        model       :   'description',
    }]
}]);
