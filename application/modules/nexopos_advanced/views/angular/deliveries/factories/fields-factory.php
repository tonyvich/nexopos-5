tendooApp.factory( 'deliveriesFields', [ 'sharedOptions', function( sharedOptions ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Delivery Name', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '',
        validation  :   {
            required        :   true
        }
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Coût d\'achat', "nexopos_advanced" );?>',
        model   :   'purchase_cost',
        desc    :   '<?php echo _s( 'Le coût d\'achat représente la valeur d\'achat de tout l\'approvisionnement hors taxe.' , 'nexopos_advanced' );?>',
        validation  :   {
            required        :   true,
            decimal         :   true
        }
    },{
        type    :   'select',
        label   :   '<?php echo __( 'Coût Automatique', 'nexopos_advanced' );?>',
        model   :   'auto_cost',
        options     :   sharedOptions.yesOrNo,
        desc    :   '<?php echo _s( 'Chaque approvisionnement à un coût. Il peut être calculé automatiquement selon le coût de chaque produit, ou vous pouvez le définir manuellement', 'nexopos_advanced' );?>'
    },{
        type        :   'datepick',
        label       :   '<?php echo __( 'Date de livraison', 'nexopos_advanced' );?>',
        model       :   'shipping_date',
        desc        :   '<?php echo _s( 'Vous pouvez définir une date à laquelle la livraison a été ou sera livrée.', 'nexopos_advanced' );?>',
        useCurrent  :   'minutes',
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
        type        :   'textarea',
        label       :   '<?php echo __( 'Description', 'nexopos_advanced' );?>',
        model       :   'description',
        desc        :   '<?php echo _s( 'Vous pouvez définir une date à laquelle la livraison a été ou sera livrée.', 'nexopos_advanced' );?>'
    }]
}]);
