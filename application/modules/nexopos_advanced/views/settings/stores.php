<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->Gui->col_width(1, 2);

$this->Gui->add_meta( array(
    'col_id'    =>  1,
    'namespace' =>  'nexopos-advanced-stores',
    'title'     =>  __( 'Fonctionnalités', 'nexopos_advanced' ),
    'type'      =>  'box-primary',
    'gui_saver' =>  true,
    'footer'    =>  [
        'submit'    =>  [
            'label'     =>  __( 'Sauvegarder les réglages', 'nexopos_advanced' )
        ]
    ]
) );

$this->Gui->add_item(array(
    'type'        =>    'select',
    'name'        =>    'shop_stores_enable',
    'label'        =>    __('Activer les boutiques multiples', 'nexopos_advanced' ),
    'options'    =>    array(
        'no'        =>  __( 'Non', 'nexopos_advanced' ),
        'yes'       =>  __( 'Yes', 'nexopos_advanced' ),
    ),
    'description'       =>  __( 'Cette option activera la fonctionnalité des boutiques multiples.', 'nexopos_advanced')
), 'nexopos-advanced-stores', 1 );



$this->Gui->output();
