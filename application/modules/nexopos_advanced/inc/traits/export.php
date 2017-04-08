<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait export
{
    private function cleanString($text) {
        $utf8 = array(
            '/[áàâãªä]/u'   =>   'a',
            '/[ÁÀÂÃÄ]/u'    =>   'A',
            '/[ÍÌÎÏ]/u'     =>   'I',
            '/[íìîï]/u'     =>   'i',
            '/[éèêë]/u'     =>   'e',
            '/[ÉÈÊË]/u'     =>   'E',
            '/[óòôõºö]/u'   =>   'o',
            '/[ÓÒÔÕÖ]/u'    =>   'O',
            '/[úùûü]/u'     =>   'u',
            '/[ÚÙÛÜ]/u'     =>   'U',
            '/ç/'           =>   'c',
            '/Ç/'           =>   'C',
            '/ñ/'           =>   'n',
            '/Ñ/'           =>   'N',
            '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
            '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
            '/[“”«»„]/u'    =>   ' ', // Double quote
            '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
        );
        return preg_replace(array_keys($utf8), array_values($utf8), $text);
    }

    /**
     *  export to CSV
     *  @param  void
     *  @return json
    **/

    public function export_to_csv_post()
    {

    }

    /**
     *  export to PDF
     *  @param  void
     *  @return json
    **/

    public function export_to_pdf_post()
    {

    }

    /**
     *  export to XLS
     *  @param   void
     *  @return void
    **/

    public function export_to_xls_post()
    {
        $final_data       =   [];
        foreach( $this->post( 'headers' ) as $header ) {
            $col_name                       =   $header[ 'namespace' ];
            @$final_data[ $col_name ]       =   [ @$header[ 'text' ] ];
            foreach( $this->post( 'data' ) as $data ) {
                $final_data[ $col_name ][]  =   $data[ $col_name ];
            }
        }

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
        $objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
        $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
        $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
        $objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");


        // Add some data
        $objPHPExcel->setActiveSheetIndex(0);
        $col_index  =   0;
        $letters    =   [ 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z' ];

        foreach( $final_data as $col ) {
            foreach( $col as $row_index => $row ) {
                // Since A0 doesn't exists
                $objPHPExcel->getActiveSheet()->SetCellValue( $letters[ $col_index ] . ( $row_index + 1 ), $row );
            }
            $col_index++;
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Simple');


        // Save Excel 2007 file
        $file_name      =   strtolower( $this->cleanString( str_replace( ' ', '-', $this->post( 'name' ) ) ) );
        $file_location  =   UPLOADPATH . $file_name . '.xlsx';
        $objWriter      =   new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save( $file_location );
        $this->response([
            'file'  =>  site_url([ 'public', 'upload', $file_name . '.xlsx' ])
        ]);
    }
}
