tendooApp.factory( 'customersGroupsFields', [ 'options', function( options ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Nom du groupe', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '',
        validation  :   {
            required        :   true
        }
    },{
        type    :   'select',
        label   :   '<?php echo __( 'Activer les réductions', 'nexopos_advanced' );?>',
        model   :   'enable_discount',
        options     :   options.yesOrNo,
        validation : {
            required : true
        }
    },{
        type        :   'datepick',
        label       :   '<?php echo __( 'Début des réductions', 'nexopos_advanced' );?>',
        model       :   'discount_start',
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
        model       :   'discount_end',
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
        type    :   'select',
        label   :   '<?php echo __( 'Type de réduction', 'nexopos_advanced' );?>',
        model   :   'discount_type',
        options     :   options.percentOrFlat,
        validation : {
            required : true
        }
    },{
        type        :   'text',
        label       :   '<?php echo __( 'Valeur de la réduction', 'nexopos_advanced' );?>',
        model       :   'discount_value',
        validation  :   {
            required : true,
            decimal   : true
        }
    },{
        type        :   'textarea',
        label       :   '<?php echo __( 'Description', 'nexopos_advanced' );?>',
        model       :   'description',
    }]
}]);
