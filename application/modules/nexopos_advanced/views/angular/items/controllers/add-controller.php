<?php if( true == false ):?>
<script type="text/javascript">
<?php endif;?>
var items               =   function(
    $scope,
    $http,
    $location,

    // internal dependencies

    itemsTypes,
    item,
    itemsAdvancedFields,
    itemsFields,
    itemsResource,
    itemsVariationsResource,
    providersResource,
    categoriesResource,
    deliveriesResource,
    unitsResource,
    taxesResource,
    $routeParams,

    // Shared Dependencies

    sharedDocumentTitle,
    sharedValidate,
    sharedRawToOptions,
    sharedFieldEditor,
    sharedAlert,
    sharedMoment,
    sharedFilterItem,

    // External dependencies
    localStorageService
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter un article', 'nexopos_advanced' );?>' );

    $scope.category_desc    =   '<?php echo __( 'Assigner une catégorie permet de regrouper les produits similaires.', 'nexopos_advanced' );?>';
    $scope.validate         =   new sharedValidate();
    $scope.taxes            =   new Array;

    /**
     *  Blue a specific field
     *  @param object field
     *  @param object field data
     *  @param object ids
     *  @return
    **/

    $scope.validate.blur    =   function( field, variation_tab, ids ) {

        if( ! angular.isDefined( variation_tab ) ) {
            return false;
        }

        // If visibility is hidden on some fields, validation will be skipped on that.
        if( typeof field.show == 'function' ) {
            if( ! field.show( variation_tab.models, item ) ) {
                return;
            }
        }

        if( ! angular.isDefined( variation_tab.models ) && angular.isDefined( ids ) ) {
            variation_tab.models    =   {};
        }

        // if validation runs on default fields, we don't fetch models from .models but directly on the object wrapper (specially for default fields)
        var validation      =   angular.isDefined( ids ) ?
            this.__run( field, variation_tab.models ) :
            this.__run( field, variation_tab );

        var response        =   this.__response( validation );
        var errors          =   this.__replaceTemplate( response.errors );
        var fieldClass      =   '.' + field.model + '-helper';

        if( angular.isDefined( ids ) ) {

            var variation_selector          =   $scope.getClass( ids ).variation;
            var variation_tab_selector      =   $scope.getClass( ids ).variation_tab_body;

            if( angular.isUndefined( variation_tab.errors ) ) {
                variation_tab.errors         =   {};
            }

            variation_tab.errors             =   _.extend( variation_tab.errors, validation );

            // If we're validating a form within a group, we just make sure that he group selector exists.
            if( $scope.getClass( ids ).variation_group_body ) {

                variation_tab_selector      =   $scope.getClass( ids ).variation_group_body;

                // if tab groups_errors is not set
                if( typeof $scope.item.variations[ ids.variation_id ].tabs[ ids.variation_tab_id ].groups_errors == 'undefined' ) {
                    $scope.item.variations[ ids.variation_id ].tabs[ ids.variation_tab_id ].groups_errors     =   {};
                }

                // Bring validaiton error badge to the tab of the variation
                // We just fetch the group name and use it to group errors
                var groups_errors   =   $scope.item.variations[ ids.variation_id ]
                .tabs[ ids.variation_tab_id ]
                .groups_errors[ ids.variation_tab.namespace ];

                if( typeof groups_errors == 'undefined' ) {
                    groups_errors    =   [];
                }

                if( typeof groups_errors[ ids.variation_group_id ] == 'undefined' ) {
                    groups_errors[ ids.variation_group_id ]     =   {};
                }

                groups_errors[ ids.variation_group_id ]     =     _.extend(
                    groups_errors[ ids.variation_group_id ], validation
                );

                // let refresh variation groups errors;
                $scope.item.variations[ ids.variation_id ]
                .tabs[ ids.variation_tab_id ]
                .groups_errors[ ids.variation_tab.namespace ]    =   groups_errors;

            }
        } else {
            var variation_tab_selector      =   '.default-fields-wrapper';
        }

        if( ! response.isValid  ) {
            angular.element( variation_tab_selector + ' ' + fieldClass )
            .closest( '.form-group' ).removeClass( 'has-success' );

            angular.element( variation_tab_selector + ' ' + fieldClass )
            .text( errors[ field.model ].msg );

            angular.element( variation_tab_selector + ' ' + fieldClass )
            .closest( '.form-group' ).addClass( 'has-error' );
        } else {
            // delete error for grouped field
            if( angular.isDefined( $scope.getClass( ids ).variation_group_body ) ) {
                // Delete validaiton error for group in tab object;
                var groups_errors   =   $scope.item.variations[ ids.variation_id ]
                .tabs[ ids.variation_tab_id ]
                .groups_errors[ ids.variation_tab.namespace ];

                // suppression d'une erreur dans le groupe
                delete groups_errors[ ids.variation_group_id ][ field.model ];
            }

            // delete if the tab has an error to avoid error
            if( angular.isDefined( variation_tab.errors ) ) {
                delete variation_tab.errors[ field.model ]; // delete error for other fields
            }
        }

        $scope.saveOnLocalStorage();

        return response.isValid ? null : validation;
    }

    /**
     *  Blur all fields to display errors
     *  @param object fields
     *  @return void
    **/

    $scope.validate.blurAll         =   function() {

        var global_validation       =   [];

        _.each( itemsFields, function( field ) {
            var validationResult    =   $scope.validate.blur( field, item );
            if( validationResult != null ) {
                global_validation.push( validationResult );
            }
        });

        _.each( $scope.item.variations, function( variation, variation_id ) {
            _.each( variation.tabs, function( tab, variation_tab_id ) {
                var ids             =   {
                    variation_id        :   variation_id,
                    variation_tab_id    :   variation_tab_id
                };

                // We won't validate hidden tabs
                if( typeof tab.hide == 'function' ) {
                    if( tab.hide( item ) == true ) {
                        return false;
                    }
                }

                var allFields       =   itemsAdvancedFields[ tab.namespace ];

                // We won't validate hidden field
                _.each( allFields, function( field, variation_field_id ) {
                    if( field.show( variation, item ) && field.type != 'group' ){

                        var validationResult    =   $scope.validate.blur( field, tab, ids );
                        if( validationResult != null ) {
                            global_validation.push( validationResult );
                        }

                    } else if( field.show( variation, item ) && field.type == 'group' ) {
                        _.each( field.subFields, function( subField ) {
                            _.each( tab.models[ field.model ], function( group_model, variation_group_id ){

                                ids.variation_group_id      =   variation_group_id;
                                ids.variation_tab           =   tab;

                                var validationResult    =   $scope.validate.blur( subField, group_model, ids );
                                if( validationResult != null ) {
                                    global_validation.push( validationResult );
                                }

                            })
                        });
                    }
                })
            });
        });

        return global_validation;
    }

    /**
     *  Focus on fields
     *  @param object field
     *  @param object field model data
     *  @param object ids
     *  @return
    **/

    $scope.validate.focus      =   function( field, model, ids ) {

        var fieldClass                  =   '.' + field.model + '-helper';

        // for advanced fields
        if( angular.isDefined( ids ) ) {
            var variation_selector          =   $scope.getClass( ids ).variation;
            var variation_tab_selector      =   $scope.getClass( ids ).variation_tab_body;

            // If we're validating a form within a group, we just make sure that he group selector exists.
            if( $scope.getClass( ids ).variation_group_body ) {
                variation_tab_selector      =   $scope.getClass( ids ).variation_group_body;
            }
        } else { // for default fields
            var variation_tab_selector      =   '.default-fields-wrapper';
        }

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
     *  @param void
     *  @return void
    **/

    $scope.addVariation         =   function(){
        if( $scope.item.variations.length == 10 ) {
            NexoAPI.Notify().info( '<?php echo _s( 'Attention', 'nexo' );?>', '<?php echo _s( 'Vous ne pouvez pas créer plus de 10 variations d\'un même produit.', 'nexo' );?>')
            return;
        }

        var singleVariation         =   {
            tabs        :   $scope.item.getTabs()
        };

        _.each( singleVariation, function( variation, $tab_id ) {
            _.each( variation.tabs, function( tab, $tab_key ) {
                tab.models      =   {};
            });
        });

        $scope.item.variations.push( singleVariation );
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

        _.each( $scope.item.variations[variationIndex].tabs, function( value ) {
            value.active    =   false;
        });

        $scope.item.variations[variationIndex].tabs[ tabIndex ].active     =   true;
    }

    /**
     *  Count all errors
     *  @param object variation object
     *  @return int
    **/

    $scope.countAllErrors       =   function( variation ) {
        var errors      =   0;
        errors  +=  _.keys( variation.errors ).length;

        if( angular.isDefined( variation.groups_errors ) ) {
            _.each( variation.groups_errors, function( group ) {
                _.each( group, function( error ){
                    errors  +=  _.keys( error ).length;
                })
            });
        }

        return errors;
    }

    /**
     *  Detect Item Namespace
     *  @param void
     *  @return void
    **/

    $scope.initItem      =   function(a, b){

        $scope.item                 =   new item;
        $scope.item.name            =   '';
        $scope.item.variations      =   [{
            models          :       {
                name        :   $scope.item.name
            },
            tabs            :       $scope.item.getTabs()
        }];

        _.each( $scope.item.variations, function( variation, $tab_id ) {
            _.each( variation.tabs, function( tab, $tab_key ) {
                tab.models      =   {};
            });
        });

        switch( $location.path() ) {
            case "/items/add/clothes" :
                $scope.item.namespace    =   'clothes';
            break;
            case "/items/add/coupon" :
                $scope.item.namespace   =   'coupon';
            break;
        }

        // Selected Type
        _.each( itemsTypes, function( type, key ) {
            if( type.namespace == $scope.item.typeNamespace ) {
                $scope.item.selectedType   =   type;
            }
        });

        // When everything seems to be done, then we can check if the item exist on the local store
        if( localStorageService.isSupported ) {
            // The item is reset if you access from type selection
            // Maybe a prompt can ask whether the saved item should be deleted :\ ?
            if( $location.path() == '/items/types' ) {
                localStorageService.remove( 'item' );
            } else {
                if( typeof localStorageService.get( 'item' ) === 'object' ) {
                    console.log( $scope.item );
                    let savedItem           =   localStorageService.get( 'item' );
                    _.each( savedItem, ( field, field_name) => {
                        if( field_name != 'variations' ) {
                            $scope.item[ field_name ]   =   field;
                        }
                    });

                    _.each( savedItem.variations, ( savedVariation, key ) => {
                        $scope.item.variations[ key ]   =   {
                            models          :   savedVariation.models,
                            tabs            :   $scope.item.getTabs()
                        };

                        //Looping tabs
                        _.each( $scope.item.variations[ key ].tabs, ( tab, tab_key ) => {
                            tab.models      =   savedVariation.tabs[ tab_key ].models
                        });
                    });
                    /// $scope.item         =   _.extend( $scope.item, localStorageService.get( 'item' ) );
                }
            }
        }
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

        // if ids is not default, just return a non defined value.
        if( typeof ids == 'undefined' ) {
            return {};
        }

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
     *  Purify Item
     *  @param object item
     *  @return object purified item
    **/

    $scope.purifyItem           =   function( item ) {
        // nothing
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

    $scope.removeGroup      =   function( $index, $groups, ids ) {
        sharedAlert.confirm( '<?php echo _s( 'Souhaitez-vous supprimer ce groupe ?', 'nexopos_advanced' );?>', function( action ) {
            if( action ) {
                // delete all error related to the deleted group
                $scope.item.variations[ ids.variation_id ].tabs[ ids.variation_tab_id ].groups_errors[ ids.variation_tab.namespace ].splice( $index, 1 );

                $groups.splice( $index, 1 );
            }
        });
    }

    /**
     *  Remove Variation
     *  @param int variation index
     *  @return void
    **/

    $scope.removeVariation  =   function( $index ){
        sharedAlert.confirm( '<?php echo _s( 'Souhaitez-vous supprimer cette variation ?', 'nexopos_advanced' );?>', function( action ) {
            if( action ) {
                $scope.item.variations.splice( $index, 1 );
            }
        });
    }

    /**
     *  Save On Local Storage
     *  @param void
     *  @return void
    **/

    $scope.saveOnLocalStorage   =   ()  => {
        if( localStorageService.isSupported ) {
            // We'll only save if localStore is enabled
            if( localStorageService.getStorageType() == 'localStorage' ) {
                $scope.$watch( 'item', ( before, after ) => {
                    // console.log( $scope.item );
                    localStorageService.set( 'item', $scope.item );
                });
            }
        }
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
     *  Submit Items (needs review)
     *  @param
     *  @return
    **/

    $scope.submitItem               =   function(){

        // validating
        var global_validation       =   $scope.validate.blurAll();
        var warningMessage          =   '<?php echo _s( 'Le formulaire comprend {0} erreur(s). Assurez-vous que toutes les informations sont correctes.', 'nexopos_advanced' );?>';

        if( global_validation.length > 0 ) {
            return sharedAlert.warning( warningMessage.format( global_validation.length ) );
        }

        // When submiting item
        var itemToSubmit                    =   sharedFilterItem(
            item,
            itemsFields,
            itemsAdvancedFields
        );

        itemToSubmit[ 'author' ]            =   '<?php echo User::id();?>';
        itemToSubmit[ 'date_creation' ]     =   sharedMoment.now();
        itemToSubmit[ 'namespace' ]         =   $scope.item.namespace;

        // Item Resource POST*
        itemsResource.save( itemToSubmit, function( returned ){
            $location.path( 'items' );
        });
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
    $scope.itemsTypes           =   itemsTypes;
    $scope.fields               =   itemsFields;

    // Resources Loading
    providersResource.get(function( data ) {
        sharedFieldEditor( 'ref_provider', itemsAdvancedFields.stock ).options        =   sharedRawToOptions( data.entries, 'id', 'name' );
    });

    // Categories Loading
    categoriesResource.get(function( data ) {
        sharedFieldEditor( 'ref_category', $scope.fields ).options   =   sharedRawToOptions( data.entries, 'id', 'name' );
    });

    // Deliveries Loading
    deliveriesResource.get(function( data ) {
        sharedFieldEditor( 'ref_delivery', itemsAdvancedFields.stock ).options   =   sharedRawToOptions( data.entries, 'id', 'name' );
    });

    // Loading Unit
    unitsResource.get( function( data ) {
        sharedFieldEditor( 'ref_unit', $scope.fields ).options        =   sharedRawToOptions( data.entries, 'id', 'name' );
    });

    // taxes Resource
    taxesResource.get( function( data ) {
        sharedFieldEditor( 'ref_taxe', $scope.fields ).options        =   sharedRawToOptions( data.entries, 'id', 'name' );
    });

    // Display a dynamic price when a taxes is selected
    sharedFieldEditor( 'sale_price', itemsAdvancedFields.basic ).show          =   function( tab, item ) {
        if( $scope.item.ref_taxe ) {
            if( angular.isUndefined( $scope.taxes[ $scope.item.ref_taxe ] ) ) {
                // To Avoid several calls to the database
                $scope.taxes[ $scope.item.ref_taxe ]           =   {};
                taxesResource.get({
                    id      :   $scope.item.ref_taxe
                },function( entries ) {
                    $scope.taxes[ $scope.item.ref_taxe ]       =   entries;
                });

                if( angular.isDefined( tab.models.sale_price ) ) {
                    if( $scope.taxes[ $scope.item.ref_taxe ].type == 'percent' ) {
                        var percentage      =   ( parseFloat( tab.models.sale_price ) * parseFloat( $scope.taxes[ $scope.item.ref_taxe ].value ) ) / 100;
                        var newPrice        =   parseFloat( tab.models.sale_price ) + percentage;
                        this.addon          =   newPrice;
                    } else {
                        var newPrice        =   parseFloat( tab.models.sale_price ) + parseFloat( $scope.taxes[ $scope.item.ref_taxe ].value );
                        this.addon          =   newPrice;
                    }
                }
            }

            if( _.keys( $scope.taxes[ $scope.item.ref_taxe ] ).length > 0 ) {
                if( angular.isDefined( tab.models ) ) {
                    if( angular.isDefined( tab.models.sale_price ) ) {
                        if( $scope.taxes[ $scope.item.ref_taxe ].type == 'percent' ) {
                            var percentage      =   ( parseFloat( tab.models.sale_price ) * parseFloat( $scope.taxes[ $scope.item.ref_taxe ].value ) ) / 100;
                            var newPrice        =   parseFloat( tab.models.sale_price ) + percentage;
                            this.addon          =   newPrice;
                        } else {
                            var newPrice        =   parseFloat( tab.models.sale_price ) + parseFloat( $scope.taxes[ $scope.item.ref_taxe ].value );
                            this.addon          =   newPrice;
                        }
                    }
                }
            }


        }
        return true;
    }

    $scope.docHeight            =   ( parseFloat( angular.element( '.content-wrapper' ).css( 'min-height' ) ) - 100 ) + 'px';

    // Detect item Namespace
    $scope.$on('$routeChangeSuccess', function(next, current) {
        $scope.initItem(current, next);
    });

    $scope.$on('$routeChangeStart', function(next, current) {
        $scope.previousPath    =   $location.path();
    });
};

items.$inject           =   [
    '$scope',
    '$http',
    '$location',
    'itemsTypes',
    'item',
    'itemsAdvancedFields',
    'itemsFields',
    'itemsResource',
    'itemsVariationsResource',
    'providersResource',
    'categoriesResource',
    'deliveriesResource',
    'unitsResource',
    'taxesResource',
    '$routeParams',
    'sharedDocumentTitle',
    'sharedValidate',
    'sharedRawToOptions',
    'sharedFieldEditor',
    'sharedAlert',
    'sharedMoment',
    'sharedFilterItem',
    'localStorageService'
];

tendooApp.controller( 'items', items );
