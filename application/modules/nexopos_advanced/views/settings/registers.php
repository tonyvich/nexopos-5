<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->Gui->col_width(1, 2);

$this->Gui->add_meta( array(
    'col_id'        =>  1,
    'namespace'     =>  'nexopos-advanced-registers',
    'title'         =>  __( 'Fonctionnalités', 'nexopos_advanced' ),
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

$this->Gui->add_item(array(
    'type'          =>    'select',
    'options'       =>    array(
        'no'        =>  __( 'Non', 'nexopos_advanced' ),
        'yes'       =>  __( 'Oui', 'nexopos_advanced' )
    ),
    'label' => __("Effets sonores",'nexopos_advanced'),
    'name'  => 'shop_checkout_sound_fx',
    'description'   =>  __( 'Active ou désactive les effets sonores de la caisse', 'nexopos_advanced' )
),'nexopos-advanced-registers',1);

$this->Gui->add_item(array(
    'type'          =>    'select',
    'options'       =>    array(
        'no'        =>  __( 'Non', 'nexopos_advanced' ),
        'yes'       =>  __( 'Oui', 'nexopos_advanced' )
    ),
    'label' => __("Impression automatique",'nexopos_advanced'),
    'name'  => 'shop_checkout_autoprint',
    'description'   =>  __( 'Impression automatique des factures', 'nexopos_advanced' )
),'nexopos-advanced-registers',1);

$this->Gui->add_item(array(
    'type'          =>    'select',
    'options'       =>    array(
        'no'        =>  __( 'Non', 'nexopos_advanced' ),
        'yes'       =>  __( 'Oui', 'nexopos_advanced' )
    ),
    'label' => __("Remises",'nexopos'),
    'name'  => 'shop_checkout_discount_status',
    'description'   =>  __( 'Remises sur les produits', 'nexopos_advanced' )
),'nexopos-advanced-registers',1);

$this->Gui->add_item(array(
    'type'          =>    'select',
    'options'       =>    array(
        'no'        =>  __( 'Non', 'nexopos_advanced' ),
        'yes'       =>  __( 'Oui', 'nexopos_advanced' )
    ),
    'label' => __("Edition d'article dans le panier",'nexopos_advanced'),
    'name'  => 'shop_checkout_item_status',
    'description'   =>  __( 'Permet aux utilisateurs de modifier les produits ajouté au panier', 'nexopos_advanced' )
),'nexopos-advanced-registers',1);

$this->Gui->add_item(array(
    'type'          =>    'select',
    'options'       =>    array(
        'no'        =>  __( 'Non', 'nexopos_advanced' ),
        'yes'       =>  __( 'Oui', 'nexopos_advanced' )
    ),
    'label' => __("Taxes",'nexopos'),
    'name'  => 'shop_checkout_vat_status',
    'description'   =>  __( 'Taxes des articles', 'nexopos_advanced' )
),'nexopos-advanced-registers',1);

$this->Gui->add_item(array(
    'type'          =>    'select',
    'options'       =>    array(
        'no'        =>  __( 'Non', 'nexopos_advanced' ),
        'yes'       =>  __( 'Oui', 'nexopos_advanced' )
    ),
    'label' => __("Livraisons",'nexopos_advanced'),
    'name'  => 'shop_checkout_shipping_status',
    'description'   =>  __( 'Livraisons des articles', 'nexopos_advanced' )
),'nexopos-advanced-registers',1);

$this->Gui->add_item(array(
    'type'          =>    'select',
    'options'       =>    array(
        'no'        =>  __( 'Non', 'nexopos_advanced' ),
        'yes'       =>  __( 'Oui', 'nexopos_advanced' )
    ),
    'label' => __("Plein ecran",'nexopos_advanced'),
    'name'  => 'shop_checkout_fullscreen_status',
    'description'   =>  __( 'Voulez vous utiliser le mode plein ecran?', 'nexopos_advanced' )
),'nexopos-advanced-registers',1);

$this->Gui->add_item(array(
    'type'          =>    'select',
    'options'       =>    array(
        'no'        =>  __( 'Non', 'nexopos_advanced' ),
        'yes'       =>  __( 'Oui', 'nexopos_advanced' )
    ),
    'label' => __("Factures sms",'nexopos_advanced'),
    'name'  => 'shop_checkout_smsinvoice_status',
    'description'   =>  __( 'Envoi des factures par SMS (Enregistrement des clients requis)', 'nexopos_advanced' )
),'nexopos-advanced-registers',1);

$this->Gui->add_item(array(
    'type'          =>    'select',
    'options'       =>    array(
        'no'        =>  __( 'Non', 'nexopos_advanced' ),
        'yes'       =>  __( 'Oui', 'nexopos_advanced' )
    ),
    'label' => __("Enregistrer clients",'nexopos_advanced'),
    'name'  => 'shop_checkout_create_customer_status',
    'description'   =>  __( 'Voulez vous enregistrer vos clients?', 'nexopos_advanced' )
),'nexopos-advanced-registers',1);

$this->Gui->add_item(array(
    'type'          =>    'select',
    'options'       =>    array(
        'no'        =>  __( 'Non', 'nexopos_advanced' ),
        'yes'       =>  __( 'Oui', 'nexopos_advanced' )
    ),
    'label' => __("Coupons",'nexopos_advanced'),
    'name'  => 'shop_checkout_coupon_status',
    'description' => __("Voulez vous utiliser des coupons (pour les clients fidèles par exemple)","nexopos_advanced")
),'nexopos-advanced-registers',1);

$this->Gui->add_item(array(
    'type'          =>    'select',
    'options'       =>    array(
        'no'        =>  __( 'Non', 'nexopos_advanced' ),
        'yes'       =>  __( 'Oui', 'nexopos_advanced' )
    ),
    'label' => __("Remises par article",'nexopos_advanced'),
    'name'  => 'shop_checkout_item_discount_status',
    'description' => __("Vous permet de définir les remises par article","nexopos_advanced")
),'nexopos-advanced-registers',1);

$this->Gui->output();
