<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->Gui->col_width(1, 2);

$this->Gui->add_meta( array(
    'col_id'        =>  1,
    'namespace'     =>  'nexopos-advanced-registers',
    'title'         =>  __( 'Fonctionanlités', 'nexopos_advanced' ),
    'type'          =>  'box',
    'gui_saver'     =>  true,
    'footer'        =>  [
        'submit'    =>  [
            'label' =>  __( 'Enregistrer les réglages' )
        ]
    ]
) );

$this->Gui->add_item(array(
    'type'          =>    'select',
    'name'          =>    'shop_checkout_register',
    'label'         =>    __('Activer les caisses multiples', 'nexopos_advanced'),
    'options'       =>    array(
        'no'        =>  __( 'Non', 'nexopos_advanced' ),
        'yes'       =>  __( 'Oui', 'nexopos_advanced' )
    ),
    'description'   =>  __( 'Cette option activera l\'utilisation de plus d\'une caisse enregistreuse', 'nexopos_advanced' )
), 'nexopos-advanced-registers', 1 );

$this->Gui->output();
