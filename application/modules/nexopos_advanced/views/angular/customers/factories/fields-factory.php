tendooApp.factory( 'customersFields', [ '$location', 'sharedOptions', function( $location, sharedOptions ){
    return [
        {
            type    :   'hidden',
            model   :   'name',
            validation  :   {
                required    :   true
            },
            desc        :   '<?php echo _s( 'Nom du client.', 'nexopos_advanced' );?>'
        },{
            type    :   'text',
            model   :   'surname',
            label   :   '<?php echo _s('Prénom', 'nexopos_advanced');?>',
            validation   :   {
                required  :  true
            },
            show        :   function(){
                return true;
            },
            desc        :   '<?php echo _s( 'Prénom du client.', 'nexopos_advanced' );?>'
        },{
            type    :   'select',
            model   :   'status',
            label   :   '<?php echo _s('Statut', 'nexopos_advanced');?>',
            show        :   function(){
                return true;
            },
            options :   sharedOptions.status,
            desc        :   '<?php echo _s( 'Statut du client.', 'nexopos_advanced' );?>'
        },{
            type    :   'select',
            model   :   'sex',
            label   :   '<?php echo _s('Sexe', 'nexopos_advanced');?>',
            validation   :   {
                required  :  true
            },
            show        :   function(){
                return true;
            },
            options :  sharedOptions.maleOrFemale,
            desc        :   '<?php echo _s( 'Genre du client', 'nexopos_advanced' );?>'
        },{
            type    :   'text',
            model   :   'phone',
            label   :   '<?php echo _s('Numéro de téléphone', 'nexopos_advanced');?>',
            validation   :   {
                required  :  true
            },
            show        :   function(){
                return true;
            },
            desc        :   '<?php echo _s( 'Numero de téléphone.', 'nexopos_advanced' );?>'
        },{
            type    :   'text',
            model   :   'email',
            label   :   '<?php echo _s('Adresse mail', 'nexopos_advanced');?>',
            validation   :   {
                email :  true
            },
            show        :   function(){
                return true;
            },
            desc        :   '<?php echo _s( 'Adresse email du client.', 'nexopos_advanced' );?>'
        },{
            type    :   'select',
            model   :   'ref_group',
            label   :   '<?php echo _s('Groupe', 'nexopos_advanced');?>',
            show        :   function(){
                return true;
            },
            options :  sharedOptions.yesOrNo,
            desc        :   '<?php echo _s( 'Groupe auquel appartient le client.', 'nexopos_advanced' );?>'
        }
    ];
}]);
