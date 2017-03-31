<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NexoPOS_Admin_Menus
{
    public function register( $menus )
    {
        global $Options;

        // If multi store is disabled
        if( @$Options[ 'shop_stores_enable' ] != 'yes' ) {
            // Inventory
            $menus  =   array_insert_after( 'dashboard', $menus, 'nexopos-inventory', [
                array(
                    'title' =>  __( 'Inventaire', 'nexopos' ),
                    'disable'   =>  true,
                    'icon'      =>  'fa fa-archive'
                ),
                array(
                    'title' =>  __( 'Livraisons', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/deliveries' ] )
                ),
                array(
                    'title' =>  __( 'Nouvelle Livraison', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/deliveries', 'add' ] )
                ),
                array(
                    'title' =>  __( 'Produits', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/items' ] )
                ),
                array(
                    'title' =>  __( 'Nouveau Produit', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/items', 'types' ] )
                ),
                array(
                    'title' =>  __( 'Importer Des Produits', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/items', 'import' ] )
                ),
                array(
                    'title' =>  __( 'Catégories', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/categories' ] )
                ),
                array(
                    'title' =>  __( 'Nouvelle Catégorie', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/categories', 'add' ] )
                ),
                array(
                    'title' =>  __( 'Départements', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/departments' ] )
                ),
                array(
                    'title' =>  __( 'Nouveau Département', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/departments', 'add' ] )
                ),
                array(
                    'title' =>  __( 'Taxes', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/taxes' ] )
                ),
                array(
                    'title' =>  __( 'Nouvelle Taxe', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/taxes', 'add' ] )
                ),
                array(
                    'title' =>  __( 'Unités', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/units' ] )
                ),
                array(
                    'title' =>  __( 'Nouvelle Unité', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/units', 'add' ] )
                )
            ]);

            // Customers
            $menus  =   array_insert_before( 'nexopos-inventory', $menus, 'nexopos-customers', [
                array(
                    'title'     =>      __( 'Clients', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos/customers' ] ),
                    'icon'      =>      'fa fa-users'
                ),
                array(
                    'title'     =>      __( 'Nouveau Client', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos/customers', 'add' ] )
                ),
                array(
                    'title'     =>      __( 'Groupes', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos/customers-groups' ] )
                ),
                array(
                    'title'     =>      __( 'Nouveau Groupe', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos/customers-groups', 'add' ] )
                )
            ]);

            // settings
            $menus  =   array_insert_after( 'nexopos-inventory', $menus, 'nexopos-settings', [
                array(
                    'title'     =>      __( 'Réglages NexoPOS', 'nexopos' ),
                    'icon'      =>      'fa fa-cogs ',
                    'disable'   =>      true
                ),
                array(
                    'title'     =>      __( 'Généraux', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos-settings', 'general' ] ),
                ),
                array(
                    'title'     =>      __( 'Caisses Enregistreuses', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos-settings', 'registers' ] ),
                ),
                array(
                    'title'     =>      __( 'Produits', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos-settings', 'items' ] ),
                ),
                array(
                    'title'     =>      __( 'Clients', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos-settings', 'customers' ] ),
                ),
                array(
                    'title'     =>      __( 'Factures/Reçu', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos-settings', 'invoices' ] ),
                ),
                array(
                    'title'     =>      __( 'Avancé', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos-settings', 'advanced' ] ),
                ),
                array(
                    'title'     =>      __( 'Boutiques', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos-settings', 'stores' ] )
                )
            ]);

            // Providers
            $menus  =   array_insert_after( 'nexopos-inventory', $menus, 'nexopos-providers', [
                array(
                    'title' =>  __( 'Fournisseurs', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/providers' ] ),
                    'icon'  =>  'fa fa-truck'
                ),
                array(
                    'title' =>  __( 'Nouveau Fournisseur', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/providers', 'add' ] )
                ),
            ]);

            // Coupon
            $menus  =   array_insert_before( 'nexopos-customers', $menus, 'nexopos-coupons', [
                array(
                    'title'     =>      __( 'Coupons', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos/coupons' ]),
                    'icon'      =>      'fa fa-gift'
                ),
                array(
                    'title'     =>      __( 'Nouveau Coupon', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos/coupons', 'add' ]),
                ),
            ]);

            // Reports
            $menus  =   array_insert_before( 'nexopos-settings', $menus, 'nexopos-reports', [
                array(
                    'title'     =>      __( 'Rapports', 'nexopos' ),
                    'disable'   =>      true,
                    'icon'      =>      'fa fa-bar-chart'
                ),
                array(
                    'title'     =>      __( 'Ventes Détaillés', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos/reports', 'detailed' ] )
                ),
                array(
                    'title'     =>      __( 'Ventes Journalières', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos/reports', 'daily' ] )
                ),
                array(
                    'title'     =>      __( 'Profit & Pertes', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos/reports', 'incomes_losses' ] )
                ),
                array(
                    'title'     =>      __( 'Dépenses', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos/reports', 'expense' ] )
                ),
                array(
                    'title'     =>      __( 'Taxes', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos/reports', 'taxes' ] )
                ),
                array(
                    'title'     =>      __( 'Stock', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos/reports', 'stock' ] )
                ),
                array(
                    'title'     =>      __( 'Caissiers', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos/reports', 'cashiers' ] )
                ),
                array(
                    'title'     =>      __( 'Clients', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos/reports', 'customers' ] )
                ),
                array(
                    'title'     =>  __( 'Commandes', 'nexopos' ),
                    'href'      =>      site_url( [ 'dashboard', 'nexopos/reports', 'orders' ] )
                )
            ]);

            // Sales
            $menus  =   array_insert_after( 'dashboard', $menus, 'nexopos-sales', [
                array(
                    'title'     =>  __( 'Sales', 'nexopos' ),
                    'icon'      =>  'fa fa-shopping-cart',
                    'href'      =>  site_url( [ 'dashboard', 'nexopos/sales' ] )
                )
            ]);

            if( @$Options[ 'shop_checkout_register' ] == 'yes' ) {
                // Pos Registers
                $menus  =   array_insert_after( 'dashboard', $menus, 'nexopos-registers', [
                    array(
                        'title'     =>  __( 'Registers', 'nexopos' ),
                        'icon'      =>  'fa fa-desktop',
                        'href'      =>  site_url( [ 'dashboard', 'nexopos/registers' ] )
                    ),
                    array(
                        'title'     =>  __( 'New Register', 'nexopos' ),
                        'icon'      =>  'fa fa-desktop',
                        'href'      =>  site_url( [ 'dashboard', 'nexopos/registers', 'add' ] )
                    )
                ]);
            } else {
                // POS Menu
                $menus  =   array_insert_after( 'dashboard', $menus, 'nexopos', [
                    array(
                        'title'     =>  __( 'Open POS', 'nexopos' ),
                        'icon'      =>  'fa fa-desktop',
                        'href'      =>  site_url( [ 'dashboard', 'nexopos', 'checkout' ] )
                    )
                ]);
            }

            // Expenses
            $menus  =   array_insert_after( 'nexopos-sales', $menus, 'nexopos-expenses', [
                array(
                    'title' =>  __( 'Dépenses', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/expenses' ] ),
                    'icon'  =>  'fa fa-money'
                ),
                array(
                    'title' =>  __( 'Ajouter une dépense', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/expenses', 'add' ] )
                ),
                array(
                    'title' =>  __( 'Catégories des dépenses', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/expenses-categories' ] )
                ),
                array(
                    'title' =>  __( 'Ajouter une catégorie', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/expenses-categories', 'add' ] )
                )
            ]);
        } else {
            $menus  =   array_insert_after( 'dashboard', $menus, 'nexopos-stores', [
                array(
                    'title' =>  __( 'Boutiques', 'nexopos' ),
                    'disable'   =>  true,
                    'icon'      =>  'fa fa-cubes'
                ),
                array(
                    'title' =>  __( 'Boutiques', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/stores' ] )
                ),
                array(
                    'title' =>  __( 'Ajouter une boutique', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos/stores/add' ] )
                ),
                array(
                    'title' =>  __( 'Réglages', 'nexopos' ),
                    'href'  =>  site_url( [ 'dashboard', 'nexopos-settings/stores' ] )
                ),
            ]);
        }

        return $menus;
    }
}
