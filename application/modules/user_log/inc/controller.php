<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserLogController extends Tendoo_Module 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function log_session(){
        $ip        = $this->input->get("ip_address");
        $user_id   = $this->input->get("user_id");

        // Closing sessions 
        $this->db->select("
            id,
            user,
            IP_address,
            date_connexion,
            date_deconnexion,
            closed,
            TIMEDIFF(date_deconnexion, date_connexion) as duree
        ");

        $this->db->where("TIMESTAMPDIFF(MINUTE, date_connexion, date_deconnexion) > 5");
        $query = $this->db->get("user_log_sessions");
        
        echo $query->num_rows();

        if( $query->num_rows() > 0 ){
            foreach( $query->result() as $row ){
                $this->db->where("id",$row->id);
                $this->db->update("user_log_sessions",array("closed" => "yes", "duree_session" => $row->duree));
            }
        }
        
        // Registering current sessions 

        $this->db->where( array("IP_address" => $ip, "user" => $user_id, "closed" => "no") );
        $query = $this->db->get("user_log_sessions");
        
        //If session exist and not closed

        if( $query->num_rows() != 0){
            $this->db->where( array("IP_address" => $ip, "user" => $user_id, "closed" => "no") );
            $this->db->update( "user_log_sessions", array( "date_deconnexion" => date("Y-m-d H:i:s")));
        } else if( $query->num_rows() == 0 ){
            
            //If session does'nt exist 
            
            $this->db->insert('user_log_sessions', array(
                "user"             =>      $user_id,
                "IP_address"       =>      $ip,
                "date_connexion"   =>      date("Y-m-d H:i:s"),
                "closed"           =>      "no"
            ));
        }
    }
    
}