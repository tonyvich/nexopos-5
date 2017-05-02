tendooApp.factory( 'itemsAdvancedFields', [
    '$location',
    'sharedOptions',
    'barcodeOptions',
    'sharedRawToOptions',
    'itemsResource',
    'itemsVariationsResource',
    'sharedAlert',
    function(
        $location,
        sharedOptions,
        barcodeOptions,
        sharedRawToOptions,
        itemsResource,
        itemsVariationsResource,
        sharedAlert
    ){
    return function(){
        this.coupon         =   [
            {
                type    :   'select',
                model   :   'ref_coupon',
                label   :   '<?php echo _s( 'Assigner à un coupon', 'nexopos_advanced' );?>',
                desc    :   '<?php echo _s( 'Si vous souhaitez vendre des coupons/bon de commande/cartes cadeau, vous pouvez assigner ce produit à un coupon', 'nexopos_advanced' );?>',
                options   : sharedOptions.yesOrNo,
                show    :   function( variation, item ) {
                    return item.namespace == 'coupon' ? true : false;
                }
            }
        ];

        this.basic          =   [
            {
                type        :   'text',
                label       :   '<?php echo _s( 'Nom de la variation', 'nexopos_advanced' );?>',
                model       :   'name',
                show        :   function( variation, item ){
                    if( typeof item.variations != 'undefined' ) {
                        return item.variations.length > 1;
                    }
                    return false;
                },
                desc        :   '<?php echo _s( 'Veuillez choisir une désignation unique pour cette variation', 'nexopos_advanced' );?>',
                validation  :   {
                    required    :   true,
                    min_length  :   5
                }
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Prix de vente', 'nexopos_advanced' );?>',
                model       :   'sale_price',
                desc        :   '<?php echo _s( 'Définissez la valeur à laquelle le produit sera vendu.' ,'nexopos_advanced' );?>',
                show        :   function( variation, item ){
                    return true;
                },
                validation  :   {
                    required    :   true,
                    decimal     :   true
                }
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Prix d\'achat', 'nexopos_advanced' );?>',
                model       :   'purchase_price',
                desc        :   '<?php echo _s( 'Définissez la valeur à laquelle le produit a été acheté.' ,'nexopos_advanced' );?>',
                show        :   function( variation, item ){
                    return _.indexOf( [ 'coupon' ], item.namespace ) == -1 ? true : false;
                },
                validation      :   {
                    decimal     :   true
                }
            },{
                type        :   'select',
                label       :   '<?php echo _s( 'Activer les Promotion', 'nexopos_advanced' );?>',
                model       :   'enable_special_price',
                desc        :   '<?php echo _s( 'Vous permet de vendre le produit à un prix spéciale.' ,'nexopos_advanced' );?>',
                options     :   sharedOptions.yesOrNo,
                show        :   function(){
                    return true;
                }
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Prix spécial', 'nexopos_advanced' );?>',
                model       :   'special_price',
                desc        :   '<?php echo _s( 'Ce prix sera utilisé lorsque le prix promotionel sera valable.' ,'nexopos_advanced' );?>',
                show        :   function( variation, item, fields ){
                    if( _.propertyOf( variation.models )( 'enable_special_price' ) == 'yes' ) {
                        return true;
                    }
                    return false;
                }
            },{
                type        :   'datepick',
                label       :   '<?php echo _s( 'Date de départ', 'nexopos_advanced' );?>',
                model       :   'special_price_starts',
                desc        :   '<?php echo _s( 'Vous permet de définir la date de début de la promotion.' ,'nexopos_advanced' );?>',
                show        :   function( variation ){
                    if( _.propertyOf( variation.models )( 'enable_special_price' ) == 'yes' ) {
                        return true;
                    }
                    return false;
                },
                onSet           :   function( $broadcast ){
                    $broadcast('start-date-changed');
                },
                beforeRender    :   function ( $dates, $view, $leftDate, $upDate, $rightDate, model ) {
                    if ( model[ 'dateTimeEnd' ] ) {
                        var activeDate = moment( model[ 'dateTimeEnd' ] );
                        $dates.filter(function (date) {
                            return date.localDateValue() >= activeDate.valueOf()
                        }).forEach(function (date) {
                            date.selectable = false;
                        })
                    }
                },
                options     :   {
                    format: 'YYYY/MM/DD HH:mm',
                    showClear: true
                },
                beforeValidation    :   ( date )  =>  {
                    if( typeof date == 'object' ) {
                        return  data.format( 'YYYY/MM/DD HH:mm' )
                    }
                    return date;
                }
            },{
                type        :   'datepick',
                label       :   '<?php echo _s( 'Date de fin', 'nexopos_advanced' );?>',
                model       :   'special_price_ends',
                desc        :   '<?php echo _s( 'Vous permet de définir la date de fin de la promotion.' ,'nexopos_advanced' );?>',
                show        :   function( variation ){
                    if( _.propertyOf( variation.models )( 'enable_special_price' ) == 'yes' ) {
                        return true;
                    }
                    return false;
                },
                onSet           :   function( $broadcast ){
                    $broadcast('end-date-changed');
                },
                beforeRender    :   function ( $dates, $view, $leftDate, $upDate, $rightDate, model ) {
                    if ( model[ 'dateTimeStart' ] ) {
                        var activeDate  = moment( model[ 'dateTimeStart' ] ).subtract(1, $view).add(1, 'minute');

                        $dates.filter(function (date) {
                            return date.localDateValue() <= activeDate.valueOf()
                        }).forEach(function (date) {
                            date.selectable = false;
                        })
                    }
                },
                options     :   {
                    format: 'YYYY/MM/DD HH:mm',
                    showClear: true
                },
                beforeValidation    :   ( date )  =>  {
                    if( typeof date == 'object' ) {
                        return  data.format( 'YYYY/MM/DD HH:mm' )
                    }
                    return date;
                }
            }
        ];

        this.shipping       =   [
            {
                type        :   'text',
                label       :   '<?php echo _s( 'Poids', 'nexopos_advanced' );?>',
                show        :   function(){
                    return true;
                },
                model       :   'weight',
                desc        :   '<?php echo _s( 'Si le produit a un poid significatif, vous pouvez le mentionner.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Taille', 'nexopos_advanced' );?>',
                show        :   function(){
                    return true;
                },
                model       :   'height',
                desc        :   '<?php echo _s( 'Si le produit a une taille significative, vous pouvez la mentionner.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Largeur', 'nexopos_advanced' );?>',
                show        :   function(){
                    return true;
                },
                model       :   'width',
                desc        :   '<?php echo _s( 'Si le produit a une largeur significative, vous pouvez la mentionner.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Longueur', 'nexopos_advanced' );?>',
                show        :   function(){
                    return true;
                },
                model       :   'length',
                desc        :   '<?php echo _s( 'Si le produit a une longueur significative, vous pouvez la mentionner.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Couleur', 'nexopos_advanced' );?>',
                show        :   function(){
                    return true;
                },
                model       :   'color',
                desc        :   '<?php echo _s( 'Chaque variation peut avoir une coleur qui la distingue des autres.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Contenance', 'nexopos_advanced' );?>',
                show        :   function(){
                    return true;
                },
                model       :   'capacity',
                desc        :   '<?php echo _s( 'Si le produit à une contenance liquide, vous pouvez la spécifier ici.', 'nexopos_advanced' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Volume', 'nexopos_advanced' );?>',
                show        :   function(){
                    return true;
                },
                model       :   'volume',
                desc        :   '<?php echo _s( 'Si le produit se mesure en volume, vous pouvez le spécifier ici.', 'nexopos_advanced' );?>'
            }
        ];

        this.stock          =   [{
            type        :   'group',
            label       :   '<?php echo _s( 'Stock', 'nexopos_advanced' );?>',
            show        :   function(){
                return true;
            },
            class       :   'col-lg-12 col-sm-12 col-xs-12',
            model       :   'stock',
            subFields      :   [
                {
                    type        :   'select',
                    model       :   'ref_delivery',
                    label       :   '<?php echo _s( 'Livraison', 'nexopos_advanced' );?>',
                    show        :   function(){
                        return true;
                    },
                    desc        :   '<?php echo _s( 'Les livraisons permettent de regrouper les approvisionnement.', 'nexopos_advanced' );?>',
                    validation  :   {
                        required    :   true
                    },
                    buttons     :   [{
                        class   :   'default',
                        click   :   function( item ) {
                            return $location.url( 'deliveries/add?fallback=items/add/' + item.namespace );
                        },
                        icon    :   'fa fa-plus'
                    }]
                },{
                    type        :   'select',
                    model       :   'ref_provider',
                    label       :   '<?php echo _s( 'Fournisseur', 'nexopos_advanced' );?>',
                    show        :   function(){
                        return true;
                    },
                    desc        :   '<?php echo _s( 'Si cette variation dispose d\'un stock provenant de plusieurs founisseurs, vous pouvez affecter chaque quantité à un fournisseur.', 'nexopos_advanced' );?>',
                    validation  :   {
                        required    :   true
                    },
                    buttons     :   [{
                        class   :   'default',
                        click   :   function( item ) {
                            return $location.url( 'providers/add?fallback=items/add/' + item.namespace );
                        },
                        icon    :   'fa fa-plus'
                    }]
                },{
                    type        :   'text',
                    label       :   '<?php echo _s( 'Quantité', 'nexopos_advanced' );?>',
                    model       :   'quantity',
                    show        :   function(){
                        return true;
                    },
                    desc        :   '<?php echo _s( 'Définissez une valeur numérique.', 'nexopos_advanced' );?>',
                    validation  :   {
                        required    :   true,
                        numeric     :   true
                    }
                }
            ]
        }];

        this.barcode        =   [
            {
                type        :   'text',
                label       :   '<?php echo _s( 'Unité de Gestion de Stock', 'nexopos_advanced' );?>',
                model       :   'sku',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'L\'unité de gestion de stock permet de distinguer les variations (ou les produits)', 'nexopos_advanced' );?>',
                validation  :   {
                    required    :   true,
                    callback    :   function( item, field, $event ){
                        // Validation run only if the field is not empty
                        if( item[ field.model ] != '' ) {
                            itemsVariationsResource.get({
                                id      :   item[ field.model ],
                                as      :   'sku'
                            }, function( returned ) {
                                // greater than 2 since the object already has system keys : $promise and $resolved
                                if( _.keys( returned ).length > 2 ) {
                                    var message     =   '<?php echo _s( 'L\'Unité de gestion de stock : {0}, est déjà en cours d\'utilisation. Veuillez remplacer cette valeur, sinon il sera impossible de sauvegarder le produit.', 'nexopos_advanced' );?>';
                                    sharedAlert.warning( message.format( item[ field.model ] ) );
                                }
                            });
                        }
                    }
                }
            },{
                type        :   'select',
                label       :   '<?php echo _s( 'Type du Codebarre', 'nexopos_advanced' );?>',
                model       :   'barcode_type',
                show        :   function(){
                    return true;
                },
                options         :   <?php echo json_encode( $this->events->apply_filters( 'nexopos_barcodes', $this->config->item( 'nexopos_barcodes' ) ) );?>,
                desc        :   '<?php echo _s( 'Vous pouvez utiliser le type du code barre déjà dans le produit.', 'nexopos_advanced' );?>',
                validation  :   {
                    required    :   true
                }
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Code Barre', 'nexopos_advanced' );?>',
                model       :   'barcode',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'La valeur du codebarre peut être spécifiée dans ce champ. Où ce code peut être généré automatiquement.', 'nexopos_advanced' );?>',
                validation    :   {
                    callback    :   function( item, field, $event ){
                        // Validation run only if the field is not empty
                        if( item[ field.model ] != '' ) {
                            itemsVariationsResource.get({
                                id      :   item[ field.model ],
                                as      :   'barcode'
                            }, function( returned ) {
                                // greater than 2 since the object already has system keys : $promise and $resolved
                                if( _.keys( returned ).length > 2 ) {
                                    var message     =   '<?php echo _s( 'Le code barre : {0}, est déjà en cours d\'utilisation. Veuillez remplacer cette valeur, sinon il sera impossible de sauvegarder le produit.', 'nexopos_advanced' );?>';
                                    sharedAlert.warning( message.format( item[ field.model ] ) );
                                }
                            });
                        }
                    }
                },
                buttons         :   [{
                    click         :   ( item, variation ) => {
                        variation.tabs.forEach( ( tab ) => {
                            if( tab.namespace == 'barcode' ) {
                                if( typeof  tab.models.generate_barcode == undefined ) {
                                    tab.models.generate_barcode   =   'no';
                                } else {
                                    if( tab.models.generate_barcode == 'yes' ) {
                                        tab.models.generate_barcode  =   'no';
                                    } else {
                                        tab.models.generate_barcode  =   'yes';
                                    }
                                }                          
                            }
                        });
                    },
                    class       :   'default',
                    label       :   '<?php echo _s( 'Manuel', 'nexopos_advanced' );?>'
                }],
                disabled        :   ( field, tab ) => {
                    if( typeof tab.models != 'undefined' ) {
                        if( tab.models.generate_barcode == 'yes' ) {
                            field.buttons[0].label      =   '<?php echo _s( 'Automatique', 'nexopos_advanced' );?>';
                            return true;
                        }
                    }
                    field.buttons[0].label      =   '<?php echo _s( 'Manuel', 'nexopos_advanced' );?>';
                    return false;                    
                }
            }
        ];

        this.images          =   [
            {
                type        :   'image_select',
                label       :   '<?php echo _s( 'image principale', 'nexopos_advanced' );?>',
                model       :   'featured_image',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Veuillez choisir une image à la une pour cette variation', 'nexopos_advanced' );?>'
            }
        ];

        this.galleries      =   [
            {
                type        :   'group',
                label       :   '<?php echo _s( 'Image', 'nexopos_advanced' );?>',
                show        :   function(){
                    return true;
                },
                class       :   'col-lg-12 col-sm-12 col-xs-12',
                model       :   'images',
                subFields   :   [
                    {
                        type        :   'image_select',
                        label       :   '<?php echo _s( 'Image', 'nexopos_advanced' );?>',
                        model       :   'image',
                        show        :   function(){
                            return true;
                        },
                        desc        :   '<?php echo _s( 'Veuillez choisir une image à la une pour cette variation', 'nexopos_advanced' );?>'
                    }
                ]
            }
        ];
    }
}]);
