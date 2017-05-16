tendooApp.factory( 'categoriesFields', [ 'sharedOptions', function( sharedOptions ){
    return <?php echo json_encode( $this->events->apply_filters( 'nexopos_categories_fields', [
        [
            'type'              =>   'hidden',
            'label'             =>   __( 'Categories Name', "nexopos_advanced" ),
            'model'             =>   'name',
            'desc'              =>   '',
            'validation'        =>   [
                'required'        =>   'true'
            ]
        ], [
            'type'              =>   'select',
            'label'             =>   __( 'Catégorie Parente', 'nexopos_advanced' ),
            'model'             =>   'ref_parent',
            'options'           =>   'sharedOptions.yesOrNo',
            'desc'              =>   __( 'Une catégorie peut appartenir à une autre Exemple : Femmes > Robes > Soirées.', 'nexopos_advanced' )
        ], [
            'type'              =>   'image_select',
            'label'             =>   __( 'Image Descriptive', "nexopos_advanced" ),
            'model'             =>   'image_url',
            'desc'              =>   __( 'Veuillez assigner une image à cette catégorie.', 'nexopos_advanced' ),
            'size'              =>   'original'
        ], [
            'type'              =>   'textarea',
            'label'             =>   __( 'Description', "nexopos_advanced" ),
            'model'             =>   'description',
            'desc'              =>   __( 'Fournir plus de détails sur la catégorie.', 'nexopos_advanced' )
        ]
    ] ) );?>
}]);
