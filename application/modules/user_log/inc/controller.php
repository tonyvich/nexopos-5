<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserLogController extends Tendoo_Module 
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  Log session  (log users session)
     *  @param void 
     *  @return void 
    **/

    public function log_session()
    {
        global $Options; 
        $ip        = $this->input->ip_address(); // Get the IP of the connected User 
        $user_id   = User::id();
        $lazyTime  = $Options["user_log_idle_time"] * 1000;
        
        // Closing inactive sessions 
        $this->db->select("
            id,
            user,
            IP_address,
            date_connexion,
            date_deconnexion,
            closed,
            TIMESTAMPDIFF(MINUTE, date_connexion, date_deconnexion) as duree
        ");

        $this->db->where("TIMESTAMPDIFF(SECOND, date_deconnexion, NOW()) > 60");
        $this->db->where("closed = 'no'");
        $query = $this->db->get("user_log_sessions");

        if( $query->num_rows() > 0 )
        {
            foreach( $query->result() as $row ){
                $this->db->where("id",$row->id);
                print_r( $row );
                $this->db->update("user_log_sessions",array("closed" => "yes", "duree_session" => $row->duree));
            }
        }
        
        // Registering current sessions 
        $this->db->where( array("IP_address" => $ip, "user" => $user_id, "closed" => "no") );
        $query = $this->db->get("user_log_sessions");
        
        //If session exist and not closed
        if( $query->num_rows() != 0)
        {
            echo "here0";
            $this->db->where( array("IP_address" => $ip, "user" => $user_id, "closed" => "no") );
            $this->db->update( "user_log_sessions", array( "date_deconnexion" => date("Y-m-d H:i:s"))); // Update disconnect date
        } 
        else if( $query->num_rows() == 0 )
        {
            echo "here";
            //If session does'nt exist 
            $this->db->insert('user_log_sessions', array(
                "user"             =>      $user_id,
                "IP_address"       =>      $ip,
                "date_connexion"   =>      date("Y-m-d H:i:s"),
                "date_deconnexion" =>      date("Y-m-d H:i:s"),
                "closed"           =>      "no"
            ));
        }
    }

    /**
     *  Get ( get Data )
     *  @param
     *  @return
    **/

    public function get()
    {
        $sessions = $this->db->get("user_log_sessions")->result();
        $actions  = $this->db->get("user_log_actions")->result();
        $users = $this->db->get("aauth_users")->result();

        $data['sessions'] = $sessions;
        $data['actions']  = $actions;
        $data['users'] = $users;

        echo( json_encode( $data ));
    }

    /**
     *  outer (Disconnect Iddle users)
     *  @param
     *  @return
    **/

    public function outer()
    {
        global $Options;
        $lazyTime  = $Options["user_log_idle_time"] * 1000;
        $ip        = $this->input->ip_address();
        $user_id   = User::id();
        
        // Closing the idle user session 
        $this->db->select("
            id,
            user,
            IP_address,
            date_connexion,
            date_deconnexion,
            closed,
            TIMESTAMPDIFF(MINUTE, date_connexion, date_deconnexion) as duree
        ");

        $this->db->where("user = $user_id");
        $this->db->where("IP_address = '$ip'");
        $this->db->where("closed = 'no'");
        $query = $this->db->get("user_log_sessions");

        if( $query->num_rows() > 0 ){
            foreach( $query->result() as $row ){
                $this->db->where("id", $row->id);
                $this->db->update("user_log_sessions",array("closed" => "yes", "duree_session" => $row->duree));
            }
        }
        
        // Loading libraries
        $this->load->library('aauth',  array(),  'auth');
        $this->auth->logout(); // Log out the user
        redirect(array( 'sign-in?redirect=dashboard/'));
    }

    /**
     *  Settings 
     *  @param void
     *  @return void
    **/

    public function settings()
    {
        $this->Gui->set_title(__("Paramètres Module de log","user_log"));
        $this->load->module_view("user_log","settings_view");
    }

    /**
     *  stats (display user stats)
     *  @param void
     *  @return void
    **/

    public function stats()
    {
        $this->events->add_action( 'dashboard_footer', 
            function() {
                get_instance()->load->module_view( 'user_log', 'stats_footer' );
            });
        
        $this->Gui->set_title(__("Statistiques","user_log"));
        $this->load->module_view("user_log","stats_view");
    }
    
}