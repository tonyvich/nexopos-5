<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->Gui->col_width(1, 2);

$this->Gui->add_meta( array(
    'col_id'    =>  1,
    'namespace' =>  'nexopos-advanced-general',
    'type'      =>  'box',
    'title'     =>  __( 'Informations sur la boutique', 'nexopos_advanced' ),
    'footer'    =>  [
        'submit'    =>  [
            'label' =>  __( 'Sauvegarder les réglages', 'nexopos_advanced' )
        ]
    ],
    'gui_saver' =>  true
) );

$this->Gui->add_item(array(
    'type'        =>    'text',
    'label'        =>    __('Nom de la boutique', 'nexopos_advanced' ),
    'name'        =>    'shop_name',
    'description'    =>    __( 'Ce nom pourra être utilisé sur les factures et à divers autres endroits.', 'nexopos_advanced' )
), 'nexopos-advanced-general', 1 );

$this->Gui->output();
