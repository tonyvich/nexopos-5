<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config[ 'mm-upload-sizes' ]        =   [
    'full'      =>  [ 625, 371 ],
    'medium'    =>  [ 300, 168 ],
    'thumb'     =>  [ 150, 150, 'thumbnail' ],
    'original'  =>  true
];

// upload path
$config[ 'mm-upload-path' ]          =   UPLOADPATH;

// Manager Mimes
$config[ 'mm-supported-mime' ]       =   'gif|jpg|png';
