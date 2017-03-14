<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait users
{
    /**
     *  user Get
     *  @param int user id
     *  @return json
    **/

    public function users_get( $id = null )
    {
        if( $id == null ) {

            $this->db->select( '
                aauth_users.id as id,
                aauth_users.name as name,
                aauth_users.email as email,
                aauth_users.pass as pass,
                aauth_users.banned as banned,
                aauth_users.last_login as last_login,
                aauth_users.last_activity as last_activity,
                aauth_users.last_login_attempt as last_login_attempt,
                aauth_users.forgot_exp as forgot_exp,
                aauth_users.remember_time as remember_time,
                aauth_users.remember_exp as remember_exp,
                aauth_users.verification_code as verification_code,
                aauth_users.ip_address as ip_address,
                aauth_users.login_attempts as login_attempts
            ' );

            $this->db->from( 'aauth_users' );
            // Order Request
            if( $this->get( 'order_by' ) ) {
                $this->db->order_by( $this->get( 'order_by' ), $this->get( 'order_type' ) );
            }

            if( $this->get( 'limit' ) ) {
                $this->db->limit( $this->get( 'limit' ), $this->get( 'current_page' ) );
            }

            $query      =   $this->db->get();

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'aauth_users' )->num_rows()
            ], 200 );
        }

        $result     =   $this->db->where( 'id', $id )->get( 'aauth_users' )->result();

        return $result ? $this->response( ( array ) @$result[0], 200 ) : $this->__404();
    }

    /**
     *  user POST
     *  @return json
    **/

    // public function users_post()
    // {
    //     if( $this->db->where( 'name', $this->post( 'name' ) )->get( 'aauth_users' )->num_rows() ) {
    //         $this->__alreadyExists();
    //     }

    //     $this->db->insert( 'aauth_users', [
    //         'name'                  =>  $this->post( 'name' ),
    //         'code'                  =>  $this->post( 'code' ),
    //         'description'           =>  $this->post( 'description' ),
    //         'author'                =>  $this->post( 'author' ),
    //         'date_creation'         =>  $this->post( 'date_creation' )
    //     ]);

    //     $this->__success();
    // }

    /**
    * user Delsete
    *@return json
    **/

    // public function users_delete()
    // {
    //     if( is_array( $_GET[ 'ids' ] ) ) {
    //         foreach( $_GET[ 'ids' ] as $id ) {
    //             $this->db->where( 'id', ( int ) $id )->delete( 'aauth_users' );
    //         }
    //         return $this->__success();
    //     }
    //     return $this->__failed();
    // }

    /**
     *  users Update. Update a current user entry.
     *  @param  int entry id
     *  @return json
    **/

    // public function users_put( $id )
    // {
    //     $alreadyExists      =   $this->db->where( 'name', $this->put( 'name' ) )
    //     ->where( 'id !=', $id )
    //     ->get( 'aauth_users' )
    //     ->num_rows();

    //     if( $alreadyExists ) {
    //         $this->__alreadyExists();
    //     }

    //     $this->db->where( 'id', $id )->update( 'aauth_users', [
    //         'name'                  =>  $this->put( 'name' ),
    //         'code'                  =>  $this->put( 'code' ),
    //         'description'           =>  $this->put( 'description' ),
    //         'author'                =>  $this->put( 'author' ),
    //         'date_modification'     =>  $this->put( 'date_modification' ),
    //     ]);

    //     $this->__success();
    // }
}
