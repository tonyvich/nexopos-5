tendooApp.factory( 'customersGroupsFields', [ 'sharedOptions', function( sharedOptions ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Nom du groupe', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '<?php echo _s( 'Désignation du groupe.', 'nexopos_advanced' );?>',
        validation  :   {
            required        :   true
        }
    },{
        type    :   'select',
        label   :   '<?php echo __( 'Activer les réductions', 'nexopos_advanced' );?>',
        model   :   'enable_discount',
        desc    :   '<?php echo _s( 'Permet d\'appliquer un prix spéciale aux clients appartenant à ce groupe.', 'nexopos_advanced' );?>',
        options     :   sharedOptions.yesOrNo,
        validation : {
            required : true
        }
    },{
        type        :   'datepick',
        label       :   '<?php echo __( 'Début des réductions', 'nexopos_advanced' );?>',
        model       :   'discount_start',
        useCurrent  :   'minutes',
        desc    :   '<?php echo _s( 'Date de départ des réductions.', 'nexopos_advanced' );?>',
        language    :   'eng',
        options     :   {
            format: 'YYYY/MM/DD HH:mm',
            showClear: true,
        },
        beforeValidation    :   ( date )  =>  {
            if( typeof date == 'object' ) {
                return  data.format( 'YYYY/MM/DD HH:mm' )
            }
            return date;
        }
    },{
        type        :   'datepick',
        label       :   '<?php echo __( 'Fin des réductions', 'nexopos_advanced' );?>',
        model       :   'discount_end',
        useCurrent  :   'minutes',
        desc        :   '<?php echo _s( 'Date de fin des réductions.', 'nexopos_advanced' );?>',
        language    :   'eng',
        options     :   {
            format: 'YYYY/MM/DD HH:mm',
            showClear: true
        },
        beforeValidation    :   ( date )  =>  {
            if( typeof date == 'object' ) {
                return  data.format( 'YYYY/MM/DD HH:mm' )
            }
            return date;
        }
    },{
        type    :   'select',
        label   :   '<?php echo __( 'Type de réduction', 'nexopos_advanced' );?>',
        model   :   'discount_type',
        options     :   sharedOptions.percentOrFlat,
        desc    :   '<?php echo _s( 'Vous pouvez appliquer des réductions fixes ou variables.', 'nexopos_advanced' );?>',
    },{
        type        :   'text',
        label       :   '<?php echo __( 'Valeur de la réduction', 'nexopos_advanced' );?>',
        model       :   'discount_value',
        desc        :   '<?php echo _s( 'Sera considéré comme pourcentage ou montant fixe de la réduction.', 'nexopos_advanced' );?>',
        validation  :   {
            decimal   : true
        }
    },{
        type        :   'textarea',
        desc        :   '<?php echo _s( 'Détails du groupe.', 'nexopos_advanced' );?>',
        label       :   '<?php echo __( 'Description', 'nexopos_advanced' );?>',
        model       :   'description',
    }]
}]);
