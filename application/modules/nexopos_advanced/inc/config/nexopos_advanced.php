<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config[ 'nexopos-name' ]       =   __( 'NexoPOS', 'nexopos_advanced' );

$config[ 'nexopos_barcodes' ]   =   [[
    'value'       =>   'ean8',
    'label'       =>   'EAN 8'
],[
    'value'       =>   'ean13',
    'label'       =>   'EAN 13'
],[
    'value'       =>   'codabar',
    'label'       =>   'Codabar'
],[
    'value'       =>   'upc_a',
    'label'       =>   'UPC A'
],[
    'value'       =>   'upc_e',
    'label'       =>   'UPC E'
],[
    'value'       =>   'jan_13',
    'label'       =>   'JAN-13'
],[
    'value'       =>   'isbn',
    'label'       =>   'ISBN'
],[
    'value'       =>   'issn',
    'label'       =>   'ISSN'
],[
    'value'       =>   'code_39',
    'label'       =>   'CODE 39'
],[
    'value'       =>   'code_128',
    'label'       =>   'Code 128'
],[
    'value'       =>   'msi_plessey',
    'label'       =>   'MSI Plessey'
],[
    'value'       =>   'qr_code',
    'label'       =>   'QR COde'
],[
    'value'       =>   'data_matrix',
    'label'       =>   'Data Matrix'
]];
