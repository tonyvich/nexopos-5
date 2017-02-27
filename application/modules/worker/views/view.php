<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->Gui->col_width(1, 4);

$this->Gui->add_meta( array(
    'col_id'    =>  1,
    'namespace' =>  'worker',
    'type'      =>  'unwrapper'
) );

$this->Gui->add_item( array(
    'type'        =>    'dom',
    'content'    =>    $this->load->module_view( 'worker', 'worker-dom', null, true )
), 'worker', 1 );

$this->Gui->output();
