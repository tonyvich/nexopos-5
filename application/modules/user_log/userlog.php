<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This class is designed for the management of tendoo permission

class UserLogModule extends Tendoo_Module 
{

    public function __construct() 
    {
        parent::__construct();
        $this->events->add_action( 'load_dashboard', [ $this, 'dashboard_loader' ] );
        $this->events->add_action( 'dashboard_footer', [ $this, 'perm_footer' ] );
        $this->events->add_action( 'do_enable_module', [ $this, 'enable_module' ]);
    }

    /**
     * Load Dashboard
     **/

    public function dashboard_loader()
    {
        include_once( dirname( __FILE__ ) . '/inc/controller.php' );
        $this->Gui->register_page_object( 'user_log', new UserLogController );
    }

    public function perm_footer()
    {
        $this->load->module_view( 'user_log', 'mainboard_footer' );
    }

    /**
     * Enabling module
    **/

    public function enable_module(){
        $this->db->query( 
        'CREATE TABLE IF NOT EXISTS `' . $this->db->dbprefix . $prefix . 'user_log_sessions` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `user` int(11) NOT NULL,
          `IP_address` varchar(20) NOT NULL,
          `date_connexion` datetime,
          `date_deconnexion` datetime,
          `closed` varchar(3),
          `duree_session` int(11), 
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;' );

        $this->db->query( 
        'CREATE TABLE IF NOT EXISTS `' . $this->db->dbprefix . $prefix . 'user_log_actions` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `user` int(11) NOT NULL,
          `action` TEXT NOT NULL,
          `date_action` datetime,
          `session` int(11), 
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;' );
    }
}
new UserLogModule;