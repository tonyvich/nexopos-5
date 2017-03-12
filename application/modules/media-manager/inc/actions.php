<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once( dirname( __FILE__ ) . '/controllers/media.php' );
include_once( dirname( __FILE__ ) . '/controllers/angular.php' );

class Media_Manager_Actions extends Tendoo_Module
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  register Controller
     *  @param  void
     *  @return void
    **/

    public function register_controllers()
    {
        $this->Gui->register_page_object( 'nexopos', new Media_Manager_Main_Controller );
        $this->Gui->register_page_object( 'angular', new Media_Manager_Angular_Controller );
    }

    /**
     *  Load Dashboard header
     *  @param void
     *  @return void
    **/

    public function load_dashboard()
    {
        $this->Gui->register_page_object( 'medias', new Media_Manager_Main_Controller );
    }

   /**
     *  enable module
     *  @param string module namespace
     *  @return void
    **/

    public function enable_module( $string )
    {
        if( $string =='media-manager' )
        {
            global $Options;
            if( @$Options[ 'media-installed' ] == null ) 
            {
                $this->db->query('CREATE TABLE IF NOT EXISTS `'.$this->db->dbprefix.'media_files` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `name` varchar(200) NOT NULL,
                        `description` text,
                        `date_creation` datetime NOT NULL,
                        `date_modification` datetime NOT NULL,
                        `author` int(11) NOT NULL,
                        `link` text NOT NULL,
                        `slug` varchar(200) NOT NULL,
                        `type` varchar(200) NOT NULL,
                        PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;');
                $this->options->set( 'media-installed', true );
            }
        }
    }


    public function dashboard_footer()
    {
        $this->load->module_view( 'media-manager', 'dashboard/footer' );
    }

    /**
     *  Dashboard header. Create base tag
     *  @param void
     *  @return void
    **/

    public function dashboard_header()
    {
        echo '<basemediamanager href="' . site_url( [ 'dashboard', 'media-manager', $this->uri->segment(3) ] ). '"/>';
    }
}
