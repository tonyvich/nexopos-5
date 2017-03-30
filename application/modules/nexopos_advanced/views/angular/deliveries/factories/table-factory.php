tendooApp.factory( 'deliveriesTable', function(){
    return {
        columns     :   [
            {
                text    :   '<?php echo _s( 'Intitulé', 'nexopos_advanced' );?>',
                namespace   :   'name'
            },
            {
                text        :   '<?php echo _s( 'Coût d\'achat', 'nexopos_advanced' );?>',
                namespace   :   'purchase_cost',
                is          :   'money'
            },
            {
                text    :   '<?php echo _s( 'Coût Automatique', 'nexopos_advanced' );?>',
                namespace   :   'auto_cost'
            },
            {
                text    :   '<?php echo _s( 'Livré le', 'nexopos_advanced' );?>',
                namespace   :   'shipping_date',
                is          :   'date_span'
            },
            {
                text    :   '<?php echo _s( 'Crée le', 'nexopos_advanced' );?>',
                namespace   :   'date_creation',
                is          :   'date_span'
            },
            {
                text    :   '<?php echo _s( 'Modifié le', 'nexopos_advanced' );?>',
                namespace   :   'date_modification',
                is          :   'date_span'
            },
            {
                text    :   '<?php echo _s( 'Par', 'nexopos_advanced' );?>',
                namespace   :   'author_name'
            }
        ]
    }
});
