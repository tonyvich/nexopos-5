<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config[ 'nexopos-name' ]       =   __( 'NexoPOS', 'nexopos_advanced' );

$config[ 'nexopos_barcodes' ]   =   [
    [
        'value'       =>   'EAN_2',
        'label'       =>   'ean 2'
    ],[
        'value'       =>   'EAN_5',
        'label'       =>   'ean 5'
    ],[
        'value'       =>   'EAN_8',
        'label'       =>   'ean 8'
    ],[
        'value'       =>   'EAN_13',
        'label'       =>   'ean 13'
    ],[
        'value'       =>   'CODABAR',
        'label'       =>   'Codabar'
    ],[
        'value'       =>   'UPC_A',
        'label'       =>   'upc A'
    ],[
        'value'       =>   'UPC_E',
        'label'       =>   'UPC E'
    ],[
        'value'       =>   'CODE_11',
        'label'       =>   'Code 11'
    ],[
        'value'       =>   'PHARMA_CODE',
        'label'       =>   'Parma Code'
    ],[
        'value'       =>   'RMS4CC',
        'label'       =>   'RMS4CC'
    ],[
        'value'       =>   'CODE_39',
        'label'       =>   'CODE 39'
    ],[
        'value'       =>   'CODE_128',
        'label'       =>   'Code 128'
    ],[
        'value'       =>   'MSI',
        'label'       =>   'MSI'
    ],[
        'value'       =>   'MSI_CHECKSUM',
        'label'       =>   'MSI CheckSum'
    ],[
        'value'       =>   'qr_code',
        'label'       =>   'QR COde'
    ],[
        'value'       =>   'data_matrix',
        'label'       =>   'Data Matrix'
    ]
];
