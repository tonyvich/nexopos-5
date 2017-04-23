tendooApp.factory( 'itemsViewTabs', function(){
    return  <?php echo json_encode( $this->events->apply_filters( 'item_view_tabs', [
        [
            'title'           =>    __( 'Modifier', 'nexopos_advanced' ),
            'namespace'       =>   'item-edit'
        ],[
            'title'           =>   __( 'Approvisionnement', 'nexopos_advanced' ),
            'namespace'       =>   'item-stock-income'
        ],[
            'title'           =>   __( 'Ajustement du stock', 'nexopos_advanced' ),
            'namespace'       =>   'item-stock-adjustment'
        ],[
            'title'           =>   __( 'Rapports', 'nexopos_advanced' ),
            'namespace'       =>   'item-report'
        ]
    ] ) );?>
})