<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	$this->Gui->col_width(1,2);
    
    $this->Gui->add_meta( array(
        'col_id'    =>  1,
        'namespace' =>  'nexopos_general',
        'title'     =>  __( 'Nexopos options', 'nexopos' ),
        'type'      =>  'box',
        'gui_saver' => true,
        'footer'    =>  [
            'submit' => [
                'label' => __('Sauvegarder','nexopos')
            ]
        ]
    ));

    $this->Gui->add_item(array(
        'type' => 'text',
        'label' => __('Nom du site','nexopos'),
        'name'  => 'shop_name',
        'placeholder' => 'Nom du site'
    ),'nexopos_general',1);

    $this->Gui->add_item(array(
        'type' => 'tel',
        'label' => __('Numéro de téléphone','nexopos'),
        'name'  => 'shop_phone',
        'placeholder' => 'Numéro de téléphone'
    ),'nexopos_general',1);

    $this->Gui->add_item(array(
        'type' => 'text',
        'label' => __('Numéro de fax','nexopos'),
        'name'  => 'shop_fax',
        'placeholder' => 'Numéro de fax'
    ),'nexopos_general',1);

    $this->Gui->add_item(array(
        'type' => 'email',
        'label' => __('Adresse email','nexopos'),
        'name'  => 'shop_email',
        'placeholder' => 'Adresse email'
    ),'nexopos_general',1);

    $this->Gui->add_item(array(
        'type' => 'text',
        'label' => __("Heure d'ouverture",'nexopos'),
        'name'  => 'shop_opening',
        'placeholder' => "Heure d'ouverture'"
    ),'nexopos_general',1);

    $this->Gui->add_item(array(
        'type' => 'text',
        'label' => __("Heure de fermeture",'nexopos'),
        'name'  => 'shop_closing',
        'placeholder' => "Heure de fermeture"
    ),'nexopos_general',1);

    $this->Gui->add_item(array(
        'type' => 'text',
        'label' => __("Boite postale",'nexopos'),
        'name'  => 'shop_pobox',
        'placeholder' => "Boite postale"
    ),'nexopos_general',1);

    $this->Gui->add_item(array(
        'type' => 'text',
        'label' => __("Heure d'ouverture",'nexopos'),
        'name'  => 'shop_address',
        'placeholder' => "Heure de fermeture"
    ),'nexopos_general',1);

    $this->Gui->add_item(array(
        'type' => 'text',
        'label' => __("Pays de la boutique",'nexopos'),
        'name'  => 'shop_country',
        'placeholder' => "Pays de la boutique"
    ),'nexopos_general',1);

    $this->Gui->add_item(array(
        'type' => 'text',
        'label' => __("Symbole de la devise",'nexopos'),
        'name'  => 'shop_currency_symbol',
        'placeholder' => "Symbole de la devise"
    ),'nexopos_general',1);

    $this->Gui->add_item(array(
        'type' => 'text',
        'label' => __("Format ISO de la devise",'nexopos'),
        'name'  => 'shop_currency_iso',
        'placeholder' => "Format ISO de la devise"
    ),'nexopos_general',1);

    $this->Gui->add_item(array(
        'type' => 'text',
        'label' => __("Position de la devise",'nexopos'),
        'name'  => 'shop_currency_position',
        'placeholder' => "Position de la devise"
    ),'nexopos_general',1);

	$this->Gui->output();