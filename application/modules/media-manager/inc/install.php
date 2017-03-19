<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media_Manager_Install extends Tendoo_Module
{
    public function __construct()
    {
        parent::__construct();

    }

    /**
     *  Install tables
     *  @param string prefix
     *  @return void
    **/

    public function tables( $prefix = '' )
    {
        $this->db->query( 'CREATE TABLE IF NOT EXISTS `' . $this->db->dbprefix . $prefix . 'media_manager` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(200) NOT NULL,
          `desccription` text,
          `author` int(11) NOT NULL,
          `date_creation` datetime NOT NULL,
          `date_modification` datetime NOT NULL,
          `url` varchar(200) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;' );
    }

    /**
     *  remove tables
     *  @param string table prefix
     *  @return void
    **/

    public function remove_tables( $prefix = '' )
    {
        $this->db->query('DROP TABLE IF EXISTS `'. $this->db->dbprefix . $prefix . 'media_manager`;');
    }
}
