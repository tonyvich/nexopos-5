<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait medias
{
    
    /**
     *  delete
     *  @param void
     *  @return json
    **/

    public function medias_delete()
    {
        if( isset( $_GET['entries'])){
            $entries = $_GET['entries'];

            foreach ( $entries as $entry ){
                $entry = json_decode( $entry, true );
                
                // Deleting files 
                $name = $entry['name'];
                $mime = substr( $entry['url'], -3);
                
                $month = substr( $entry['date_creation'], 5, 2);
                $year = substr( $entry['date_creation'], 0, 4);
                $path = UPLOADPATH . $year . '/' . $month . '/';
                if( !is_dir( $path )){
                    return $this->__failed();
                }
                $full = $path.$name."-full.".$mime;
                $medium = $path.$name."-medium.".$mime;
                $original = $path.$name."-original.".$mime;
                $thumb = $path.$name."-thumb.".$mime;

                if( !unlink( $full )){
                    return $this->__failed();            
                }

                unlink( $medium );
                unlink( $original );
                unlink( $thumb );

                // Delete database entries
                 $this->db->where( 'id', $entry['id']);
                 $this->db->delete( 'media_managerv2' );
            }

            return $this->__success();
        }

        return $this->__failed();
    }
}
