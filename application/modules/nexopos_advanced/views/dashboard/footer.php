<?php
global $onNexoPOS;
if( $onNexoPOS == true ) {
    $this->load->module_view( 'nexopos_advanced', 'angular.shared.config.dom-config' );
    $this->load->module_view( 'nexopos_advanced', 'angular.shared.config.lazyload-config' );
    $this->load->module_view( 'nexopos_advanced', 'angular.shared.config.html5-config' );
    $this->load->module_view( 'nexopos_advanced', 'angular.shared.config.route-config' );
}
