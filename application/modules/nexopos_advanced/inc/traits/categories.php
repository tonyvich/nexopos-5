<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait categories
{
    /**
     *  category Get
     *  @param int category id
     *  @return json
    **/

    public function categories_get( $id = null )
    {
        if( $id == null ) {

            $this->db->select( '
                aauth_users.name        as author_name,
                nexopos_categories.id as id,
                nexopos_categories.name as name,
                nexopos_categories.description as description,
                nexopos_categories.image_url as image_url,
                nexopos_categories.author as author,
                nexopos_categories.ref_parent as ref_parent,
                parent_categories.name as parent_name,
                nexopos_categories.date_creation as date_creation,
                nexopos_categories.date_modification as date_modification
            ' );

            $this->db->from( 'nexopos_categories' );

            // Exclude
            if( $this->get( 'exclude' ) ) {
                $this->db->where( 'nexopos_categories.id !=', $this->get( 'exclude' ) );
            }

            // Order Request
            if( $this->get( 'order_by' ) ) {
                $this->db->order_by( $this->get( 'order_by' ), $this->get( 'order_type' ) );
            }

            if( $this->get( 'limit' ) ) {
                $this->db->limit( $this->get( 'limit' ), $this->get( 'limit' ) * $this->get( 'current_page' ) );
            }

            // Search
            if( $this->get( 'search' ) ) {
                $this->db->like( 'aauth_users.name', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_categories.id', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_categories.name', $this->get( 'search' ) );
                $this->db->or_like( 'nexopos_categories.description', $this->get( 'search' ) );
                $this->db->or_like( 'parent_categories.name', $this->get( 'search' ) );
            }

            $this->db->join( 'aauth_users', 'aauth_users.id = nexopos_categories.author' );
            $this->db->join( 'nexopos_categories as parent_categories', 'parent_categories.id = nexopos_categories.ref_parent', 'left' );

            $query      =   $this->db->get();

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_categories' )->num_rows()
            ], 200 );
        }

        $result     =   $this->db->where( 'id', $id )->get( 'nexopos_categories' )->result();

        return $result ? $this->response( ( array ) @$result[0], 200 ) : $this->__404();
    }

    /**
     *  category POST
     *  @return json
    **/

    public function categories_post()
    {
        if( $this->db->where( 'name', $this->post( 'name' ) )->get( 'nexopos_categories' )->num_rows() ) {
            $this->__alreadyExists();
        }

        $this->db->insert( 'nexopos_categories', [
            'name'                  =>  $this->post( 'name' ),
            'description'           =>  $this->post( 'description' ),
            'author'                =>  $this->post( 'author' ),
            'ref_parent'            =>  $this->post( 'ref_parent' ),
            'date_creation'         =>  $this->post( 'date_creation' ),
        ]);

        $this->__success();
    }

    public function categories_delete()
    {
        if( is_array( $_GET[ 'ids' ] ) ) {
            foreach( $_GET[ 'ids' ] as $id ) {
                $this->db->where( 'id', ( int ) $id )->delete( 'nexopos_categories' );
            }
            return $this->__success();
        }
        return $this->__failed();
    }

    /**
     *  Categorie Update
     *  @param int category id
     *  @return json
    **/

    public function categories_put( $id )
    {
        $alreadyExists      =   $this->db->where( 'name', $this->put( 'name' ) )
        ->where( 'id !=', $id )
        ->get( 'nexopos_categories' )
        ->num_rows();

        if( $alreadyExists ) {
            $this->__alreadyExists();
        }

        $this->db->where( 'id', $id )->update( 'nexopos_categories', [
            'name'                  =>  $this->put( 'name' ),
            'description'           =>  $this->put( 'description' ),
            'author'                =>  $this->put( 'author' ),
            'ref_parent'            =>  $this->put( 'ref_parent' ),
            'date_modification'     =>  $this->put( 'date_modification' ),
        ]);

        $this->__success();
    }


}
