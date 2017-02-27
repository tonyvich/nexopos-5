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
        label       :   '<?php echo __( 'Code', 'nexopos_advanced' );?>',
        model       :   'code',
        validation  :   {
            required : true
        }
    },{
        type    :   'select',
        label   :   '<?php echo __( 'Type de réduction', 'nexopos_advanced' );?>',
        model   :   'discount_type',
        options     :   options.percentOrFlat,
        validation : {
            required : true
        }
    },{
        type        :   'text',
        label       :   '<?php echo __( 'Pourcentage', 'nexopos_advanced' );?>',
        model       :   'discount_percent',
        desc        :    '<?php echo __( 'Si vous avez choisi une réduction en pourcentage', 'nexopos_advanced' );?>',
        validation  :   {
            required : true,
            decimal  : true
        }
    },{
        type        :   'text',
        label       :   '<?php echo __( 'Montant', 'nexopos_advanced' );?>',
        model       :   'discount_amount',
        desc        :    '<?php echo __( 'Si vous avez choisi une réduction en montant', 'nexopos_advanced' );?>',
        validation  :   {
            required : true,
            decimal  : true
        }
    },{
        type        :   'text',
        label       :   '<?php echo __( "Limite d\'utilisation", 'nexopos_advanced' );?>',
        model       :   'usage_limit',
        validation  :   {
            required : true,
            number   : true
        }
    },{
        type        :   'datepick',
        label       :   '<?php echo __( 'Début des réductions', 'nexopos_advanced' );?>',
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
        label       :   '<?php echo __( 'Fin des réductions', 'nexopos_advanced' );?>',
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
        type        :   'textarea',
        label       :   '<?php echo __( 'Description', 'nexopos_advanced' );?>',
        model       :   'description',
    }]
}]);
