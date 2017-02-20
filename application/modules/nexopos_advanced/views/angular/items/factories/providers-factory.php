tendooApp.factory( 'providers', [ 'rawToOptions', function( rawToOptions ){
    var data    =   {
        raw     :   <?php echo json_encode( ( Array )$this->providers->get() );?>
    };

    data.options    =   rawToOptions( data.raw, 'ID', 'NOM' );

    return data;
}]);
