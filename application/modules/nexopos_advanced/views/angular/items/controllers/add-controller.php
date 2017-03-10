<?php if( true == false ):?>
<script type="text/javascript">
<?php endif;?>
var items               =   function(
    $scope,
    $http,
    $location,
    itemTypes,
    item,
    itemAdvancedFields,
    itemFields,
    providersResource,
    categoriesResource,
    deliveriesResource,
    unitsResource,
    $routeParams,
    sharedDocumentTitle,
    sharedValidate,
    rawToOptions,
    sharedFieldEditor,
    sharedAlert
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter un article', 'nexopos_advanced' );?>' );

    $scope.category_desc  =   '<?php echo __( 'Assigner une catégorie permet de regrouper les produits similaires.', 'nexopos_advanced' );?>';
    $scope.validate         =   new sharedValidate();

    /**
     *  Blue a specific field
     *  @param object field
     *  @param object field data
     *  @param object ids
     *  @return
    **/

    $scope.validate.blur    =   function( field, variation, ids ) {

        // If visibility is hidden on some fields, validation will be skipped on that.
        if( typeof field.show == 'function' ) {
            if( ! field.show( variation, item ) ) {
                return;
            }
        }

        var validation      =   this.__run( field, variation );
        var response        =   this.__response( validation );
        var errors          =   this.__replaceTemplate( response.errors );
        var fieldClass      =   '.' + field.model + '-helper';

        if( ! response.isValid && angular.isDefined( ids ) ) {

            var current_tab                 =   variation.tabs[ ids.variation_tab_id ];
            var variation_selector          =   $scope.getClass( ids ).variation;
            var variation_tab_selector      =   $scope.getClass( ids ).variation_tab_body;

            if( angular.isUndefined( current_tab.$errors ) ) {
                current_tab.$errors         =   {};
            }

            current_tab.$errors             =   _.extend( current_tab.$errors, validation );

            angular.element( variation_tab_selector + ' ' + fieldClass )
            .closest( '.form-group' ).removeClass( 'has-success' );

            angular.element( variation_tab_selector + ' ' + fieldClass )
            .text( errors[ field.model ].msg );

            angular.element( variation_tab_selector + ' ' + fieldClass )
            .closest( '.form-group' ).addClass( 'has-error' );
        }

        return validation;
    }

    /**
     *  Blur all fields to display errors
     *  @param object fields
     *  @return void
    **/

    $scope.validate.blurAll         =   function( fields ) {
        var defaultFieldsModelsNames        =   [];
        var advancedFieldsModelsNames       =   [];

        _.each( itemFields, function( field ) {
            defaultFieldsModelsNames.push( field.model );
        });

        _.each( itemAdvancedFields, function( tab ) {
            _.each( tab, function( field ) {
                advancedFieldsModelsNames.push( field.model );
            });
        });

        // Validating default fields
        _.each( item, function( model, name ) {
            // Classic fiields
            if( _.indexOf( defaultFieldsModelsNames, name ) ) {
                // $scope.validate.blur( )
            }
        });

        // Validating advanced fields
        _.each( item.variations, function( model, name ) {
            // Classic fiields
            if( _.indexOf( advancedFieldsModelsNames, name ) ) {
                // console.log( model );
            }
        });

        console.log( item );
        return;

        if( angular.isDefined( tab ) ) {
            if( typeof tab.hide == 'function' ) {
                // A tab is validated only when it's active.
                if( ! tab.hide( tab ) ) {
                    _.each( fields, function( field ) {
                        $scope.validate.blur( field, _item );
                    });
                }
            } else { // for tab which still available the validation is run on it
                _.each( fields, function( field ) {
                    $scope.validate.blur( field, _item );
                });
            }
        } else {
            _.each( fields, function( field ) {
                $scope.validate.blur( field, _item );
            });
        }
    }

    /**
     *  Focus on fields
     *  @param
     *  @return
    **/

    $scope.validate.focus      =   function( field, item, ids ) {
        var fieldClass                  =   '.' + field.model + '-helper';
        var variation_selector          =   $scope.getClass( ids ).variation;
        var variation_tab_selector      =   $scope.getClass( ids ).variation_tab_body;

        angular.element( variation_tab_selector + ' ' + fieldClass )
        .closest( '.form-group' ).removeClass( 'has-error' );

        angular.element( variation_tab_selector + ' ' + fieldClass )
        .text( field.desc );
    }

    /**
     *  Add Group. Duplicate group fields
     *  @param  object
     *  @return void
    **/

    $scope.addGroup         =   function( group ) {
        group.push({});
    }

    /**
     *  Add Variation
     *  @param
     *  @return
    **/

    $scope.addVariation         =   function(){
        if( item.variations.length == 10 ) {
            NexoAPI.Notify().info( '<?php echo _s( 'Attention', 'nexo' );?>', '<?php echo _s( 'Vous ne pouvez pas créer plus de 10 variations d\'un même produit.', 'nexo' );?>')
            return;
        }

        var singleVariation         =   {
            name        :   item.variations[
                item.variations.length - 1
            ].name,
            tabs        :   item.getTabs()
        };

        item.variations.push( singleVariation );
    }

    /**
     *  Active Tab
     *  @param
     *  @return
    **/

    $scope.activeTab        =   function( $event, variationIndex, tabIndex ) {
        angular.element( $event.currentTarget )
        .parent( 'li' )
        .siblings()
        .removeClass( 'active' );

        angular.element( $event.currentTarget )
        .parent( 'li' )
        .addClass( 'active' );

        _.each( item.variations[variationIndex].tabs, function( value ) {
            value.active    =   false;
        });

        item.variations[variationIndex].tabs[ tabIndex ].active     =   true;
    }

    /**
     *  Detect Item Namespace
     *  @param void
     *  @return void
    **/

    $scope.detectItemNamespace      =   function(a, b){

        // Reset Variations if he comes from item selection
        if( $scope.previousPath == '/create' ) {
            item.variations         =   [{
                name        :       item.name,
                tabs        :       item.getTabs()
            }];
        }

        switch( $location.path() ) {
            case "/items/add/clothes" :
                item.namespace    =   'clothes';
            break;
            case "/items/add/coupon" :
                item.namespace   =   'coupon';
            break;
        }

        // Save Namespace
        // item.typeNamespace  =   $location.path().substr(1).replace( '/', '.' );
        // item.rawNamespace   =   $location.path().substr(1);

        // Selected Type
        _.each( itemTypes, function( value, key ) {
            if( value.namespace == item.typeNamespace ) {
                item.selectedType   =   value;
            }
        });
    }

    /**
     *  Get Icon using URL
     *  @param string icon
     *  @return string
    **/

    $scope.getIcon          =   function( string ){
        return '<?php echo module_url( 'nexopos_advanced' ) . 'images/items/'; ?>' + string;
    }

    /**
     *  Get Class
     *  Access ids object and return all ui classe for selecting variation, variation header, variation vontent
     *  @param  object ids object
     *  @return object
    **/

    $scope.getClass         =   function( ids ) {
        var classes_object          =   {
            variation               :   '.variation-' + ids.variation_id,
            variation_header        :   '.variation-header-' + ids.variation_id,
            variation_body          :   '.variation-body-' +   ids.variation_id,
            // variation_tab           :   '.variation-' + ids.variation_id + '-tab-' + ids.variation_tab_id,
            variation_tab_header    :   '.variation-' + ids.variation_id + '-tab-header-' + ids.variation_tab_id,
            variation_tab_body      :   '.variation-' + ids.variation_id + '-tab-body-' + ids.variation_tab_id,
        }

        if( angular.isDefined( ids.variation_group_id ) ) {
            // classes_object.variation_group              =   '.variation-' + ids.variation_id + '-tab-' +  ids.variation_tab_id + '-group-' + ids.variation_group_id;
            classes_object.variation_group_header       =   '.variation-' + ids.variation_id + '-tab-' + ids.variation_tab_id + '-group-header-' + ids.variation_group_id;
            classes_object.variation_group_body         =   '.variation-' + ids.variation_id + '-tab-' + ids.variation_tab_id + '-group-body-' + ids.variation_group_id;
        }

        return classes_object;
    }

    /**
     *  Render Attrs
     *  @param
     *  @return
    **/

    $scope.renderAttributes         =   function( object ) {
        if( angular.isDefined( object ) ) {
            var attrs   =   '';
            _.each( object, function( value, key ) {
                attrs   +=  key + '="' + value + '" ';
            });

            return attrs;
        }
    }

    /**
     *  Reset Group if not defined
     *  @param object group object
     *  @return void
    **/

    $scope.resetGroup               =   function( group ) {
        if( angular.isUndefined( group ) ) {
            return [{}];
        }
        return group
    }

    /**
     *  Restore Slashes on item Type
     *  @param string item slash
     *  @return string
    **/

    $scope.restoreSlashes           =   function( string ) {
        return string.replace( '.', '/' );
    }

    /**
     *  Remove Group
     *  @param int group index
     *  @return void
    **/

    $scope.removeGroup      =   function( $index, $groups ) {
        $groups.splice( $index, 1 );
    }

    /**
     *  Remove Variation
     *  @param int variation index
     *  @return void
    **/

    $scope.removeVariation  =   function( $index ){
        item.variations.splice( $index, 1 );
    }

    /**
     *  Select Type
     *  @param string item stype
     *  @return void
    **/

    $scope.selectType       =   function( type ){
        $location.path( type );
    }

    /**
     *  Show or Hide UI
     *  @param string ui namespace
     *  @return void
    **/

    $scope.show             =   function( namespace ) {
        if( namespace == 'selectType' ) {
            $scope.showItemUI       =   false;
        } else if( namespace == 'showItemUI' ){
            $scope.showItemUI       =   true;
        }
    }

    /**
     *  Submit Items
     *  @param
     *  @return
    **/

    $scope.submitItem               =   function(){

        // validating
        var validateDefaultFields       =   true;
        if( validateDefaultFields   =   $scope.validate.run( itemFields, item ).isValid == false ) {
            $scope.validate.blurAll( itemFields, item );
        }

        // Validating variations
        var validateVariations          =   0;
        _.each( itemAdvancedFields, function( tab, namespace ) {
            _.each( item.variations, function( variation ) {
                if( ! $scope.validate.run( tab, variation ).isValid ) {
                    validateVariations++;
                }

                $scope.validate.blurAll(
                    tab,
                    variation,
                    $scope.selectTab( variation.tabs, namespace )
                );
            });
        });

        if( validateDefaultFields == false || validateVariations != 0 ) {
            return sharedAlert.warning( '<?php echo _s( 'Le formulaire comprend une ou plusieurs erreurs. Assurez-vous que toutes les informations sont correctes.', 'nexopos_advanced' );?>' );
        }
    }

    /**
     *  Select Tab
     *  @param object tabs
     *  @param string tab naemspace
     *  @return object
    **/

    $scope.selectTab        =   function( tabs, namespace ) {
        var tabToReturn;
        _.each( tabs, function( tab, key ) {
            if( tab.namespace == namespace ) {
                tabToReturn =   key;
            }
        });
        return tabs[ tabToReturn ];
    }

    /**
     *  tabContent is active, check whether a tab is already active
     *  @param
     *  @return
    **/

    $scope.tabContentIsActive   =   function( tabActive, index ) {
        if( angular.isDefined( tabActive ) ) {
            return tabActive;
        }

        if( index == 0 ) {
            return true;
        }
        return false;
    }

    /**
     *  Toggle Tip
     *  @param object field
     *  @return boolean
    **/

    $scope.toggleFieldTip           =   function( field ) {
        if( angular.isUndefined( field.tip ) ) {
            field.tip   =   false;
        }
        return field.tip  = ! field.tip;
    }

    // Yes No Options
    $scope.YesNoOptions     =   [{
            value       :   'yes',
            label       :   '<?php echo _s( 'Oui', 'nexo' );?>'
        },{
            value       :   'no',
            label       :   '<?php echo _s( 'Non', 'nexo' );?>'
    }];

    $scope.groupLengthLimit     =   10;
    $scope.itemTypes            =   itemTypes;
    $scope.fields               =   itemFields;

    // Resources Loading
    providersResource.get(function( data ) {
        sharedFieldEditor( 'ref_provider', itemAdvancedFields.stock ).options        =   rawToOptions( data.entries, 'id', 'name' );
    });

    // Categories Loading
    categoriesResource.get(function( data ) {
        sharedFieldEditor( 'ref_category', $scope.fields ).options   =   rawToOptions( data.entries, 'id', 'name' );
    });

    // Deliveries Loading
    deliveriesResource.get(function( data ) {
        sharedFieldEditor( 'ref_delivery', itemAdvancedFields.stock ).options   =   rawToOptions( data.entries, 'id', 'name' );
    });

    // Loading Unit
    unitsResource.get( function( data ) {
        sharedFieldEditor( 'ref_unit', $scope.fields ).options        =   rawToOptions( data.entries, 'id', 'name' );
    });

    // Item Status
    item.variations             =   new Array;
    item.name                   =   '';

    $scope.docHeight            =   ( parseFloat( angular.element( '.content-wrapper' ).css( 'min-height' ) ) - 100 ) + 'px';

    // Watch variation
    $scope.$watch( 'item.variations', function(){
        if( item.variations.length == 0 ) {
            item.variations.push({
                name        :       item.name,
                tabs        :       item.getTabs()
            });
        }

        // Change Variation Name
        if( angular.isUndefined( item.variations[0].name ) ) {
            item.variations[0].name    =   '';
        }
    });

    // Detect item Namespace
    $scope.detectItemNamespace();

    $scope.$on('$routeChangeSuccess', function(next, current) {
        $scope.detectItemNamespace(current, next);
    });

    $scope.$on('$routeChangeStart', function(next, current) {
        $scope.previousPath    =   $location.path();
    });
};

items.$inject           =   [
    '$scope',
    '$http',
    '$location',
    'itemTypes',
    'item',
    'itemAdvancedFields',
    'itemFields',
    'providersResource',
    'categoriesResource',
    'deliveriesResource',
    'unitsResource',
    '$routeParams',
    'sharedDocumentTitle',
    'sharedValidate',
    'rawToOptions',
    'sharedFieldEditor',
    'sharedAlert'
];

tendooApp.controller( 'items', items );
