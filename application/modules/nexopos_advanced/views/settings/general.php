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
    'label' => __("Heure d'ouverture",'nexopos_advanced'),
    'name'  => 'shop_opening',
    'description' => __("Heure a partir de laquelle les clients peuvent effectuer les opérations dans le point de vente","nexopos")
),'nexopos-advanced-general',1);

$this->Gui->add_item(array(
    'type' => 'text',
    'label' => __("Heure de fermeture",'nexopos'),
    'name'  => 'shop_closing',
    'description' => __("Heure de fin des opérations clients dans le point de vente","nexopos_advanced")
),'nexopos-advanced-general',1);

$this->Gui->add_item(array(
    'type' => 'text',
    'label' => __("Boite postale",'nexopos'),
    'name'  => 'shop_pobox',
    'description' => __("Boite postale principale de la boutique","nexopos_advanced")
),'nexopos-advanced-general',1);

$this->Gui->add_item(array(
    'type' => 'text',
    'label' => __("Adresse",'nexopos'),
    'name'  => 'shop_address',
    'description' => __("Adresse de la boutique","nexopos_advanced")
),'nexopos-advanced-general',1);

$this->Gui->add_item(array(
    'type' => 'text',
    'label' => __("Pays de la boutique",'nexopos'),
    'name'  => 'shop_country',
    'description' => __("Pays ou est localisé la boutique","nexopos_advanced")
),'nexopos-advanced-general',1);


$this->Gui->add_item(array(
    'type' => 'text',
    'label' => __("Symbole de la devise",'nexopos_advanced'),
    'name'  => 'shop_currency_symbol',
    'description' => __("Symbole de la devise du pays de localisation Exemple: €","nexopos")
),'nexopos-advanced-general',1);

$this->Gui->add_item(array(
    'type' => 'text',
    'label' => __("Format ISO de la devise",'nexopos_advanced'),
    'name'  => 'shop_currency_iso',
    'description' => __("Representation ISO de la devise Exemple : EUR","nexopos")
),'nexopos-advanced-general',1);

$this->Gui->add_item(array(
    'type' => 'select',
    'label' => __("Position de la devise",'nexopos_advanced'),
    'name'  => 'shop_currency_position',
    'options'       =>    array(
        'before'        =>  __( 'Avant', 'nexopos_advanced' ),
        'after'       =>  __( 'Après', 'nexopos_advanced' )
    ),
    'description' => __("Avant ou après le montant","nexopos_advanced")
),'nexopos-advanced-general',1);

$this->Gui->add_item(array(
    'type' => 'text',
    'label' => __("Separateur",'nexopos_advanced'),
    'name'  => 'shop_decimal_thousand_divider',
    'description' => __("Séparateur a utilser pour les chiffres décimaux Exemple: .","nexopos_advanced")
),'nexopos-advanced-general',1);

$this->Gui->add_item(array(
    'type' => 'text',
    'label' => __("Limite de chiffres après la virgule",'nexopos_advanced'),
    'name'  => 'shop_decimal_limit',
    'description' => __("Nombre de chiffres utilisés apres la virgule (a une incidence sur les résultat des calculs réalisé dans l'application)","nexopos_advanced")
),'nexopos-advanced-general',1);

$this->Gui->output();
