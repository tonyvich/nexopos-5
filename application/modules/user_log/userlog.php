<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This class is designed for the management of tendoo permission

class UserLogModule extends Tendoo_Module 
{

    public function __construct() 
    {
        parent::__construct();
        $this->events->add_action( 'load_dashboard', [ $this, 'dashboard_loader' ] );
        $this->events->add_action( 'do_enable_module', [ $this, 'enable_module' ]);
        $this->events->add_action( 'dashboard_footer', function() {
            get_instance()->load->module_view( 'user_log', 'directive' );
        });
        $this->events->add_filter( 'admin_menus', [ $this, 'menus' ] );
        $this->register();
    }

    /**
     * Load Dashboard
     **/

    public function dashboard_loader()
    {
        $this->events->add_filter( 'dashboard_dependencies', [ $this, 'dependencies' ] );
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

        // Setting default options 
        $this->options->set("user_log_enable_disconnect","enabled",1);
        $this->options->set("user_log_idle_time","20",1);
    }

    /**
     *  Menus (set menus)
     *  @param
     *  @return
    **/

    public function menus( $menus ) {
        
        $menus = array_insert_before('modules', $menus, 'userlog', [
            array(
                'title'    =>  __("User Log Module","user_log"),
                'icon'     =>  'fa fa-users',
                'disable'  =>  true
            ),
            array(
                'title'    =>  __("Statistiques","user_log"),
                'href'     =>  site_url( [ 'dashboard', 'user_log', 'stats' ] )
            ),
            array(
                'title'    => __("Réglages","user_log"),
                'href'     => site_url( [ 'dashboard', 'user_log', 'settings' ] )
            )
        ]);
        
        return $menus;
    }

    /**
     *  Register (load assets)
     *  @param
     *  @return
    **/

    public function register()
    {
        $bower_url      =   '../modules/user_log/bower_components/';
        $js_url         =   '../modules/user_log/js/';
        $css_url        =   '../modules/user_log/css/';
        $root_url       =   '../bower_components/';

        $this->enqueue->css_namespace( 'dashboard_header' ); 

        $this->enqueue->js_namespace( 'dashboard_footer' );
        $this->enqueue->js( $bower_url. 'chart.js/dist/Chart.min' );
        $this->enqueue->js( $bower_url. 'angular-chart.js/dist/angular-chart.min' );
    }

    /**
     *  Dependencies ( add dependency to tendooApp)
     *  @param
     *  @return
    **/

    public function dependencies( $deps ){
        $deps[] = 'chart.js';
        return $deps;
    }
}
new UserLogModule;