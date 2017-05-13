<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $this->Gui->col_width(1, 4);

    $this->Gui->add_meta( array(
        'col_id'    =>  1,
        'namespace' =>  'stats',
        'type'      =>  'unwrapped'
    ) );

    $this->Gui->add_item( array(
        'type'        =>    'dom',
        'content'    =>    $this->load->module_view( 'user_log', 'stats_dom', null, true )
    ), 'stats', 1 );

    $this->Gui->output();