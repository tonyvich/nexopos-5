tendooApp.factory( 'providers', [ 'sharedRawToOptions', function( sharedRawToOptions ){
    var data    =   {
        raw     :   <?php echo json_encode( ( Array )$this->providers->get() );?>
    };

    data.options    =   sharedRawToOptions( data.raw, 'ID', 'NOM' );

    return data;
}]);
