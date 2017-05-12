<?php
    $this->Gui->col_width(1,2);
    $this->Gui->add_meta(
        array(
            'type'        =>    'box-primary',
            'namespace'   =>    'settings',
            'col_id'      =>    1,
            'gui_saver'   =>    true,
            'footer'      =>    array(
                'submit'  =>    array(
                    'label'    =>    __("Enregistrer paramètres")    
                )
            )
        )
    );

    $this->Gui->add_item(
        array(
            'type'             =>    'select',
            'name'             =>    'user_log_enable_disconnect',
            'label'            =>    __('Déconnecter les utilisateurs inactifs','user_log'),
            'options'          =>    array(
                'true'   => __('Oui','user_log'),
                'false'  => __('Non','user_log')    
            )
        ), 
        'settings', 
        1
    );

    $this->Gui->add_item(
        array(
            'type'         =>   'text',
            'name'         =>   'user_log_idle_time',
            'label'        =>   __("Temps avant déconnexion",'user_log'),
            'description'  =>   __("Temps d'inactivité avant déconnexion en minutes",'user_log')
        ),'settings',1
    );

    $this->Gui->output();