<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait permissions
{
    /**
     *  permission Get
     *  @param int delivvery id
     *  @return json
    **/

    public function permissions_get()
    {
        $data = $this->users->auth->list_groups();
        foreach ( $data as &$d){
            $perms = $this->users->auth->list_perms( $d->id );
            $d->permissions = $perms;
        }
        return $this->response([
            'entries'   =>  $data,
        ], 200 );
    }

    /**
     *  permission POST
     *  @param void
     *  @return json
    **/

    public function permissions_post()
    {
        $this->db->select('*');
        $this->db->where( array( 'perm_id' => $this->post('permission'), 'group_id' => $this->post('group')) );
        $this->db->from( 'aauth_perm_to_group' );
        $query = $this->db->get();
        
        if ($query->num_rows() != 0) {
            return $this->__alreadyExists();
        } else {
            $this->db->insert( 'aauth_perm_to_group', [
                'perm_id'        =>  $this->post( 'permission' ),
                'group_id'        =>  $this->post( 'group' ),
            ]);    
        }
        $this->__success();
    }

    /**
     *  delete
     *  @param void
     *  @return json
    **/

    public function permissions_delete()
    {
        if( isset( $_GET['entries'])){
            $entries = $_GET['entries'];
            foreach ( $entries as $entry ){
                $entry = json_decode( $entry );
                $this->db->select('*');
                $this->db->where( 'name', $entry[0]);
                $this->db->from( 'aauth_perms' );
                $query = $this->db->get();
                $row = $query->row();
                
                $permission_id = $row->id;
                $group_id = $entry[1];
                $this->db->where( array( 'perm_id' => $permission_id, 'group_id' => $group_id) );
                if ( $this->db->delete( 'aauth_perm_to_group' ) )
                {
                    return $this->__success();
                }        
            }
        }
    }
}
