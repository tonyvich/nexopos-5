<?php
global $onMediaManager;
if( $onMediaManager == true ) {
    $this->load->module_view( 'media-manager', 'angular.run' );
    $this->load->module_view( 'media-manager', 'angular.shared.config.dom-config' );
    $this->load->module_view( 'media-manager', 'angular.shared.config.lazyload-config' );
    $this->load->module_view( 'media-manager', 'angular.shared.config.html5-config' );
    $this->load->module_view( 'media-manager', 'angular.shared.config.route-config' );
}
