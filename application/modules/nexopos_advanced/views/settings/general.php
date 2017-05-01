<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->Gui->col_width(1, 2);
$this->Gui->col_width( 2 , 2);

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

$this->Gui->add_item(array(
    'type' => 'tel',
    'label' => __('Numéro de téléphone','nexopos'),
    'name'  => 'shop_phone',
    'description' => __("Numéro de téléphone principal auquel on peut joindre votre boutique","nexopos_advanced")
),'nexopos-advanced-general',1);

$this->Gui->add_item(array(
    'type' => 'text',
    'label' => __('Numéro de fax','nexopos'),
    'name'  => 'shop_fax',
    'description' => __("Numéro de fax principal de la boutique","nexopos_advanced")
),'nexopos-advanced-general',1);

$this->Gui->add_item(array(
    'type' => 'email',
    'label' => __('Adresse email','nexopos'),
    'name'  => 'shop_email',
    'description' => __("Adresse email principale de la boutique","nexopos_advanced")
),'nexopos-advanced-general',1);

$this->Gui->add_item(array(
    'type' => 'text',
    'label' => __("Boite postale",'nexopos'),
    'name'  => 'shop_pobox',
    'description' => __("Boite postale principale de la boutique","nexopos_advanced")
),'nexopos-advanced-general',1);

/**
 * Section Horaires
**/

$this->Gui->add_meta( array(
    'col_id'    =>  2,
    'namespace' =>  'nexopos-advanced-general-hours',
    'type'      =>  'box',
    'title'     =>  __( 'Horaires', 'nexopos_advanced' ),
    'footer'    =>  [
        'submit'    =>  [
            'label' =>  __( 'Sauvegarder les réglages', 'nexopos_advanced' )
        ]
    ],
    'gui_saver' =>  true
) );

$this->Gui->add_item(array(
    'type' => 'text',
    'label' => __("Heure d'ouverture",'nexopos_advanced'),
    'name'  => 'shop_opening',
    'description' => __("Heure a partir de laquelle les clients peuvent effectuer les opérations dans le point de vente","nexopos")
),'nexopos-advanced-general-hours', 2 );

$this->Gui->add_item(array(
    'type' => 'text',
    'label' => __("Heure de fermeture",'nexopos'),
    'name'  => 'shop_closing',
    'description' => __("Heure de fin des opérations clients dans le point de vente","nexopos_advanced")
),'nexopos-advanced-general-hours', 2 );

/**
 * Devises
**/

$this->Gui->add_meta( array(
    'col_id'    =>  2,
    'namespace' =>  'nexopos-advanced-general-currency',
    'type'      =>  'box',
    'title'     =>  __( 'Devises', 'nexopos_advanced' ),
    'footer'    =>  [
        'submit'    =>  [
            'label' =>  __( 'Sauvegarder les réglages', 'nexopos_advanced' )
        ]
    ],
    'gui_saver' =>  true
) );

$rawCurrencies      =   json_decode( file_get_contents( MODULESPATH . '/nexopos_advanced/inc/currencies.json' ), true );

$currencies[ 'custom' ]     =   __( 'Devise Personnalisée', 'nexopos_advanced' );

foreach( $rawCurrencies as $code => $currency ) {
    $currencies[ $code ]    =   $currency[ 'name' ];
}

$this->Gui->add_item([ 
    'type'      =>  'select',
    'options'   =>  $currencies,
    'name'      =>  'shop_currency',
    'label'     =>  __( 'Définir une devise', 'nexopos_advanced' ),
    'description'   =>  __( 'Vous pouvez définir une devise à appliquer à la boutique.', 'nexopos_advanced' )
], 'nexopos-advanced-general-currency', 2 );

$this->Gui->add_item(array(
    'type' => 'text',
    'label' => __("Symbole Personnalisée",'nexopos_advanced'),
    'name'  => 'shop_currency_symbol',
    'description' => __("Symbole de la devise du pays de localisation Exemple: €","nexopos")
),'nexopos-advanced-general-currency', 2 );

$this->Gui->add_item(array(
    'type' => 'text',
    'label' => __("Code Personnalisée",'nexopos_advanced'),
    'name'  => 'shop_currency_iso',
    'description' => __("Representation personnalisée ISO de la devise Exemple : EUR","nexopos")
),'nexopos-advanced-general-currency', 2 );

$this->Gui->add_item(array(
    'type' => 'select',
    'label' => __("Position de la devise",'nexopos_advanced'),
    'name'  => 'shop_currency_position',
    'options'       =>    array(
        'before'        =>  __( 'Avant', 'nexopos_advanced' ),
        'before_close'  =>  __( 'Avant près du montant', 'nexopos_advanced' ),
        'after'         =>  __( 'Après', 'nexopos_advanced' ),
        'after_close'   =>  __( 'Après près du montant', 'nexopos_advanced' )
    ),
    'description' => __("Avant ou après le montant","nexopos_advanced")
),'nexopos-advanced-general-currency', 2 );

$this->Gui->add_item( array(
    'type'          =>    'dom',
    'content'       =>    $this->load->module_view( 'nexopos_advanced', 'scripts/general-setting', null, true )
), 'nexopos-advanced-general-currency', 2 );

// $this->Gui->add_item(array(
//     'type' => 'text',
//     'label' => __("Separateur",'nexopos_advanced'),
//     'name'  => 'shop_decimal_thousand_divider',
//     'description' => __("Séparateur a utilser pour les chiffres décimaux Exemple: .","nexopos_advanced")
// ),'nexopos-advanced-general-currency', 2 );

// $this->Gui->add_item(array(
//     'type' => 'text',
//     'label' => __("Limite de chiffres après la virgule",'nexopos_advanced'),
//     'name'  => 'shop_decimal_limit',
//     'description' => __("Nombre de chiffres utilisés apres la virgule (a une incidence sur les résultat des calculs réalisé dans l'application)","nexopos_advanced")
// ),'nexopos-advanced-general-currency', 2 );

$this->Gui->add_item(array(
    'type' => 'select',
    'label' => __("Formattage des montants",'nexopos_advanced'),
    'name'  => 'shop_currency_formating',
    'options'   =>  [
        '0,0'           =>  '10,000',
        '0,0.0'         =>  '1,000.0',
        '0,0.00'        =>  '1,000.00',
        '0,0.000'       =>  '1,000.000',
        '0,0.000'       =>  '1,000.000',
        '0.00'          =>  '1000.00'
    ],
    'description' => __("Formattage des montants","nexopos_advanced")
),'nexopos-advanced-general-currency', 2 );

/**
 * Address
**/

$this->Gui->add_meta( array(
    'col_id'    =>  1,
    'namespace' =>  'nexopos-advanced-general-address',
    'type'      =>  'box',
    'title'     =>  __( 'Addresses de la boutique', 'nexopos_advanced' ),
    'footer'    =>  [
        'submit'    =>  [
            'label' =>  __( 'Sauvegarder les réglages', 'nexopos_advanced' )
        ]
    ],
    'gui_saver' =>  true
) );

$this->Gui->add_item(array(
    'type'              => 'text',
    'label'             => __("Adresse",'nexopos'),
    'name'              => 'shop_address',
    'description'       => __("Adresse de la boutique","nexopos_advanced")
),'nexopos-advanced-general-address', 1 );

$this->Gui->add_item(array(
    'type'              => 'text',
    'label'             => __("Pays",'nexopos'),
    'name'              => 'shop_country',
    'description'       => __("Pays ou est localisé la boutique","nexopos_advanced")
),'nexopos-advanced-general-address', 1 );

$this->Gui->add_item(array(
    'type'              => 'text',
    'label'             => __( "Region", 'nexopos'),
    'name'              => 'shop_country',
    'description'       => __("Region de la boutique.","nexopos_advanced")
),'nexopos-advanced-general-address', 1 );

$this->Gui->add_item(array(
    'type'              => 'text',
    'label'             => __("Ville",'nexopos'),
    'name'              => 'shop_town',
    'description'       => __("Ville où se situe la boutique.","nexopos_advanced")
),'nexopos-advanced-general-address', 1 );

$this->Gui->output();
