tendooApp.factory( 'customerAdvancedFields', [
    'sharedOptions',
    'customerTabs',
    'rawToOptions',
    '$location',
    function(
        sharedOptions,
        customerTabs,
        rawToOptions,
        $location
    )
    {
    return {
        general         :   
        [
            {
                type    :   'hidden',
                model   :   'name',
                validation  :   {
                    required    :   true
                }
            },{
                type    :   'text',
                model   :   'surname',
                label   :   '<?php echo _s('Prénom', 'nexopos_advanced');?>',
                validation   :   {
                    required  :  true
                },
                show        :   function(){
                    return true;
                }
            },{
                type    :   'select',
                model   :   'status',
                label   :   '<?php echo _s('Statut', 'nexopos_advanced');?>',
                show        :   function(){
                    return true;
                },
                options :   sharedOptions.status
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
                options :  sharedOptions.maleOrFemale
            },{
                type    :   'text',
                model   :   'phone',
                label   :   '<?php echo _s('Numéro de téléphone', 'nexopos_advanced');?>',
                validation   :   {
                    required  :  true
                },
                show        :   function(){
                    return true;
                }
            },{
                type    :   'text',
                model   :   'email',
                label   :   '<?php echo _s('Adresse mail', 'nexopos_advanced');?>',
                validation   :   {
                    email :  true
                },
                show        :   function(){
                    return true;
                }
            },{
                type    :   'select',
                model   :   'ref_group',
                label   :   '<?php echo _s('Groupe', 'nexopos_advanced');?>',
                show        :   function(){
                    return true;
                },
                options :  sharedOptions.yesOrNo
            }
        ],
        billing    :   
        [
            {
                type        :   'text',
                label       :   '<?php echo _s( 'Entreprise', 'nexopos_advanced' );?>',
                model       :   'company',
                show        :   function(){
                    return true;
                },
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Adresse 1', 'nexopos_advanced' );?>',
                model       :   'first_address',
                show        :   function(){
                    return true;
                }
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Adresse 2', 'nexopos_advanced' );?>',
                model       :   'second_address',
                show        :   function(){
                    return true;
                }
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Boite postale', 'nexopos_advanced' );?>',
                model       :   'pobox',
                show        :   function(){
                    return true;
                }
            },{
                type        :   'select',
                label       :   '<?php echo _s( 'Pays', 'nexopos_advanced' );?>',
                model       :   'country',
                options     :   sharedOptions.yesOrNo,
                show        :   function(){
                    return true;
                }
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Ville', 'nexopos_advanced' );?>',
                model       :   'town',
                show        :   function(){
                    return true;
                }
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Etat', 'nexopos_advanced' );?>',
                model       :   'state',
                show        :   function(){
                    return true;
                }
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
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Adresse 1', 'nexopos_advanced' );?>',
                model       :   'first_address',
                show        :   function(){
                    return true;
                }
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Adresse 2', 'nexopos_advanced' );?>',
                model       :   'second_address',
                show        :   function(){
                    return true;
                }
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Boite postale', 'nexopos_advanced' );?>',
                model       :   'pobox',
                show        :   function(){
                    return true;
                }
            },{
                type        :   'select',
                label       :   '<?php echo _s( 'Pays', 'nexopos_advanced' );?>',
                model       :   'country',
                options     :   sharedOptions.yesOrNo,
                show        :   function(){
                    return true;
                }
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Ville', 'nexopos_advanced' );?>',
                model       :   'town',
                show        :   function(){
                    return true;
                }
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Etat', 'nexopos_advanced' );?>',
                model       :   'state',
                show        :   function(){
                    return true;
                }
            }      
        ]
    }
}]);
