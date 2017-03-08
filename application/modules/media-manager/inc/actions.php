<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media_Manager_Actions extends Tendoo_Module
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  Load Dashboard header
     *  @param void
     *  @return void
    **/

    public function load_dashboard()
    {
        $this->Gui->register_page_object( 'medias', new Media_Manager_Controller );
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
                        `type` varchar(200) NOT NULL
                        PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;');
                $this->options->set( 'media-installed', true );
            }
        }
    }
}
