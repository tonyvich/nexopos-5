<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Library UserLog
 * Access to logging modules functionnality
*/

class user_log_library {

    public $CI;

    public function __construct(){
        $this->CI = & get_instance();
    }

    /**
     *  Log Actions 
     *  @param array
     *  @return boolean
    **/

    public function log_action( $action ){
        $user_id = @$action['user'];
        $user_action = @$action['action'];
        $date_action = date("Y-m-d H:i:s");
        $session_id = 0;
        
        if( $user_id == null ){
            return false;
        } else {
            $this->CI->db->where( array('user' => $user_id, 'closed' => 'no'));
            $session = $this->CI->db->get("user_log_sessions");
            if( $session->num_rows == 1 ){
                foreach ( $session->result() as $row ){
                    $session_id = $row->id;
                }
            } 
        }

        $this->CI->db->insert("user_log_actions", array( 'user' => $user_id, 'action' => $user_action, 'date_action' => $date_action, 'session' => $session_id ));
        return true;
    }
}