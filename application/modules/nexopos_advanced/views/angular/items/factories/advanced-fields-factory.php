tendooApp.factory( 'itemAdvancedFields', [
    'sharedOptions',
    'barcodeOptions',
    'item',
    'rawToOptions',
    '$location',
    function(
        sharedOptions,
        barcodeOptions,
        item,
        rawToOptions,
        $location
    ){
    return {
        coupon          :   [
            {
                type    :   'select',
                model   :   'ref_coupon',
                label   :   '<?php echo _s( 'Assigner à un coupon', 'nexo' );?>',
                desc    :   '<?php echo _s( 'Si vous souhaitez vendre des coupons/bon de commande/cartes cadeau, vous pouvez assigner ce produit à un coupon', 'nexo' );?>',
                options   : sharedOptions.yesOrNo,
                show    :   function() {
                    return item.namespace == 'coupon' ? true : false;
                }
            }
        ],
        basic           :   [
            {
                type        :   'text',
                label       :   '<?php echo _s( 'Nom de la variation', 'nexo' );?>',
                model       :   'name',
                show        :   function(){
                    return item.variations.length > 1;
                },
                desc        :   '<?php echo _s( 'Veuillez choisir une désignation unique pour cette variation', 'nexo' );?>',
                validation  :   {
                    required    :   true,
                    min_length  :   5
                }
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Prix de vente', 'nexo' );?>',
                model       :   'sale_price',
                desc        :   '<?php echo _s( 'Définissez la valeur à laquelle le produit sera vendu.' ,'nexo' );?>',
                show        :   function( item ){
                    return true;
                },
                validation  :   {
                    required    :   true,
                    decimal     :   true
                }
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Prix d\'achat', 'nexo' );?>',
                model       :   'purchase_price',
                desc        :   '<?php echo _s( 'Définissez la valeur à laquelle le produit a été acheté.' ,'nexo' );?>',
                show        :   function( variation, item ){
                    return _.indexOf( [ 'coupon' ], item.namespace ) == -1 ? true : false;
                },
                validation      :   {
                    decimal     :   true
                }
            },{
                type        :   'select',
                label       :   '<?php echo _s( 'Activer les Promotion', 'nexo' );?>',
                model       :   'enable_special_price',
                desc        :   '<?php echo _s( 'Vous permet de vendre le produit à un prix spéciale.' ,'nexo' );?>',
                options     :   sharedOptions.yesOrNo,
                show        :   function(){
                    return true;
                }
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Prix spécial', 'nexo' );?>',
                model       :   'special_price',
                desc        :   '<?php echo _s( 'Ce prix sera utilisé lorsque le prix promotionel sera valable.' ,'nexo' );?>',
                show        :   function( variation, item, fields ){
                    if( _.propertyOf( variation.models )( 'enable_special_price' ) == 'yes' ) {
                        return true;
                    }
                    return false;
                }
            },{
                type        :   'datepick',
                label       :   '<?php echo _s( 'Date de départ', 'nexo' );?>',
                model       :   'special_price_starts',
                desc        :   '<?php echo _s( 'Vous permet de définir la date de début de la promotion.' ,'nexo' );?>',
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
                }
            },{
                type        :   'datepick',
                label       :   '<?php echo _s( 'Date de fin', 'nexo' );?>',
                model       :   'special_price_ends',
                desc        :   '<?php echo _s( 'Vous permet de définir la date de fin de la promotion.' ,'nexo' );?>',
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
                }
            }
        ],
        shipping        :   [
            {
                type        :   'text',
                label       :   '<?php echo _s( 'Poids', 'nexo' );?>',
                show        :   function(){
                    return true;
                },
                model       :   'weight',
                desc        :   '<?php echo _s( 'Si le produit a un poid significatif, vous pouvez le mentionner.', 'nexo' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Taille', 'nexo' );?>',
                show        :   function(){
                    return true;
                },
                model       :   'height',
                desc        :   '<?php echo _s( 'Si le produit a une taille significative, vous pouvez la mentionner.', 'nexo' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Largeur', 'nexo' );?>',
                show        :   function(){
                    return true;
                },
                model       :   'width',
                desc        :   '<?php echo _s( 'Si le produit a une largeur significative, vous pouvez la mentionner.', 'nexo' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Longueur', 'nexo' );?>',
                show        :   function(){
                    return true;
                },
                model       :   'length',
                desc        :   '<?php echo _s( 'Si le produit a une longueur significative, vous pouvez la mentionner.', 'nexo' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Couleur', 'nexo' );?>',
                show        :   function(){
                    return true;
                },
                model       :   'color',
                desc        :   '<?php echo _s( 'Chaque variation peut avoir une coleur qui la distingue des autres.', 'nexo' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Contenance', 'nexo' );?>',
                show        :   function(){
                    return true;
                },
                model       :   'capacity',
                desc        :   '<?php echo _s( 'Si le produit à une contenance liquide, vous pouvez la spécifier ici.', 'nexo' );?>'
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Volume', 'nexo' );?>',
                show        :   function(){
                    return true;
                },
                model       :   'volume',
                desc        :   '<?php echo _s( 'Si le produit se mesure en volume, vous pouvez le spécifier ici.', 'nexo' );?>'
            }
        ],
        stock           :   [{
            type        :   'group',
            label       :   '<?php echo _s( 'Stock', 'nexo' );?>',
            show        :   function(){
                return true;
            },
            class       :   'col-lg-12 col-sm-12 col-xs-12',
            model       :   'stock',
            subFields      :   [
                {
                    type        :   'select',
                    model       :   'ref_delivery',
                    label       :   '<?php echo _s( 'Livraison', 'nexo' );?>',
                    show        :   function(){
                        return true;
                    },
                    desc        :   '<?php echo _s( 'Les livraisons permettent de regrouper les approvisionnement.', 'nexo' );?>',
                    validation  :   {
                        required    :   true
                    },
                    buttons     :   [{
                        class   :   'default',
                        click   :   function() {
                            $location.path( 'deliveries/add' );
                        },
                        icon    :   'fa fa-plus'
                    }]
                },{
                    type        :   'select',
                    model       :   'ref_provider',
                    label       :   '<?php echo _s( 'Fournisseur', 'nexo' );?>',
                    show        :   function(){
                        return true;
                    },
                    desc        :   '<?php echo _s( 'Si cette variation dispose d\'un stock provenant de plusieurs founisseurs, vous pouvez affecter chaque quantité à un fournisseur.', 'nexo' );?>',
                    validation  :   {
                        required    :   true
                    },
                    buttons     :   [{
                        class   :   'default',
                        click   :   function() {
                            $location.path( 'providers/add' );
                        },
                        icon    :   'fa fa-plus'
                    }]
                },{
                    type        :   'text',
                    label       :   '<?php echo _s( 'Quantité', 'nexo' );?>',
                    model       :   'quantity',
                    show        :   function(){
                        return true;
                    },
                    desc        :   '<?php echo _s( 'Définissez une valeur numérique.', 'nexo' );?>',
                    validation  :   {
                        required    :   true,
                        numeric     :   true
                    }
                }
            ]
        }],
        barcode         :   [
            {
                type        :   'text',
                label       :   '<?php echo _s( 'Unité de Gestion de Stock', 'nexo' );?>',
                model       :   'sku',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'L\'unité de gestion de stock permet de distinguer les variations (ou les produits)', 'nexo' );?>',
                validation  :   {
                    required    :   true
                }
            },{
                type        :   'select',
                label       :   '<?php echo _s( 'Type du Codebarre', 'nexo' );?>',
                model       :   'barcode_type',
                show        :   function(){
                    return true;
                },
                options         :   [{
                    value       :   'ean8',
                    label       :   'EAN 8'
                },{
                    value       :   'ean13',
                    label       :   'EAN 13'
                },{
                    value       :   'codabar',
                    label       :   'Codabar'
                },{
                    value       :   'upc_a',
                    label       :   'UPC A'
                },{
                    value       :   'upc_e',
                    label       :   'UPC E'
                },{
                    value       :   'jan_13',
                    label       :   'JAN-13'
                },{
                    value       :   'isbn',
                    label       :   'ISBN'
                },{
                    value       :   'issn',
                    label       :   'ISSN'
                },{
                    value       :   'code_39',
                    label       :   'CODE 39'
                },{
                    value       :   'code_128',
                    label       :   'Code 128'
                },{
                    value       :   'msi_plessey',
                    label       :   'MSI Plessey'
                },{
                    value       :   'qr_code',
                    label       :   'QR COde'
                },{
                    value       :   'data_matrix',
                    label       :   'Data Matrix'
                }],
                desc        :   '<?php echo _s( 'Vous pouvez utiliser le type du code barre déjà dans le produit.', 'nexo' );?>',
                validation  :   {
                    required    :   true
                }
            },{
                type        :   'text',
                label       :   '<?php echo _s( 'Code Barre', 'nexo' );?>',
                model       :   'barcode',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'La valeur du codebarre peut être spécifiée dans ce champ.', 'nexo' );?>'
            },{
                type        :   'select',
                label       :   '<?php echo _s( 'Etiquette', 'nexo' );?>',
                model       :   'barcode_action',
                show        :   function(){
                    return true;
                },
                options     :   barcodeOptions,
                desc        :   '<?php echo _s( 'Vous pouvez générer une étiquette pour ce produit durant l\'enregistrement.', 'nexo' );?>',
                validation  :   {
                    required    :   true
                }
            }
        ],
        images          :   [
            {
                type        :   'image_select',
                label       :   '<?php echo _s( 'image principale', 'nexo' );?>',
                model       :   'featured_image',
                show        :   function(){
                    return true;
                },
                desc        :   '<?php echo _s( 'Veuillez choisir une image à la une pour cette variation', 'nexo' );?>'
            }
        ],
        galleries          :   [
            {
                type        :   'group',
                label       :   '<?php echo _s( 'Image', 'nexo' );?>',
                show        :   function(){
                    return true;
                },
                class       :   'col-lg-12 col-sm-12 col-xs-12',
                model       :   'stock',
                subFields   :   [
                    {
                        type        :   'image_select',
                        label       :   '<?php echo _s( 'Image', 'nexo' );?>',
                        model       :   'image[]',
                        show        :   function(){
                            return true;
                        },
                        desc        :   '<?php echo _s( 'Veuillez choisir une image à la une pour cette variation', 'nexo' );?>'
                    }
                ]
            }
        ]
    }
}]);
