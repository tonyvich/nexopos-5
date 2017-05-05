<?php if( true == false ):?>
<script type="text/javascript">
<?php endif;?>
var items               =   function(
    $scope,
    $http,
    $location,

    // internal dependencies

    itemsTypes,
    itemsTabs,
    itemsAdvancedFields,
    itemsFields,
    itemsResource,
    itemsVariationsResource,
    providersResource,
    categoriesResource,
    deliveriesResource,
    unitsResource,
    taxesResource,
    departmentsResource,
    $routeParams,

    // Shared Dependencies

    sharedDocumentTitle,
    sharedValidate,
    sharedRawToOptions,
    sharedFieldEditor,
    sharedAlert,
    sharedMoment,
    sharedFilterItem,
    sharedResourceLoader,
    sharedFormManager,
    sharedCurrency,

    // External dependencies
    localStorageService
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter un article', 'nexopos_advanced' );?>' );

    // checks heritage from sharedFormManager
    $scope                  =   _.extend( $scope, new sharedFormManager );
    $scope.resourceLoader   =   new sharedResourceLoader;
    $scope.category_desc    =   '<?php echo __( 'Assigner une catégorie permet de regrouper les produits similaires.', 'nexopos_advanced' );?>';
    $scope.validate         =   new sharedValidate();
    $scope.taxes            =   new Array;
    $scope.advancedFields   =   new itemsAdvancedFields();

    // Add hooks
    $scope.hooks.addFilter( 'addGroup', ( group ) => {
        $scope.saveOnLocalStorage(); 
        return group;
    });

    $scope.hooks.addFilter( 'addVariation', ( variation ) => {
        $scope.saveOnLocalStorage(); 
        return variation;
    });

    $scope.hooks.addFilter( 'duplicateVariation', ( variation ) => {
        $scope.saveOnLocalStorage(); 
        return variation;
    });

    $scope.hooks.addFilter( 'removeGroup', ( $index ) => {
        $scope.saveOnLocalStorage(); 
        return $index;
    });

    $scope.hooks.addFilter( 'removeVariation', ( $index ) => {
        $scope.saveOnLocalStorage(); 
        return $index;
    });

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
            if( ! field.show( variation_tab.models, $scope.item ) ) {
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
     *  @deprecated
    **/

    $scope.validate.blurAll         =   function() {

        var global_validation       =   [];

        _.each( itemsFields, function( field ) {
            var validationResult    =   $scope.validate.blur( field, $scope.item );
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
                    if( tab.hide( $scope.item ) == true ) {
                        return false;
                    }
                }

                var allFields       =   $scope.advancedFields[ tab.namespace ];

                // We won't validate hidden field
                _.each( allFields, function( field, variation_field_id ) {
                    if( field.show( variation, $scope.item ) && field.type != 'group' ){

                        var validationResult    =   $scope.validate.blur( field, tab, ids );
                        if( validationResult != null ) {
                            global_validation.push( validationResult );
                        }

                    } else if( field.show( variation, $scope.item ) && field.type == 'group' ) {
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
     *  Detect Item Namespace
     *  @param void
     *  @return void
    **/

    $scope.initItem      =   function(a, b){

        $scope.item                 =   new itemsTabs();
        $scope.item.name            =   '';
        $scope.item.variations      =   [{
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

        // When everything seems to be done, then we can check if the item exist on the local store
        if( localStorageService.isSupported ) {
            // The item is reset if you access from type selection
            // Maybe a prompt can ask whether the saved item should be deleted :\ ?
            if( typeof localStorageService.get( 'item' ) === 'object' ) {

                let savedItem           =   localStorageService.get( 'item' );
                
                if( savedItem != null ) {

                        _.each( savedItem, ( field, field_name) => {
                        if( field_name != 'variations' ) {
                            $scope.item[ field_name ]   =   field;
                        }
                    });

                    let tabs        =   new itemsTabs;

                    _.each( savedItem.variations, ( savedVariation, key ) => {
                        // is that really useful ?
                        $scope.item.variations[ key ]   =   {
                            models          :   savedVariation.models,
                            tabs            :   $scope.item.getTabs()
                        };

                        //Looping tabs
                        _.each( $scope.item.variations[ key ].tabs, ( tab, tab_key ) => {
                            tab.models      =   savedVariation.tabs[ tab_key ].models
                        });
                    });
                }
            }
        }
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
     *  Submit Items (needs review)
     *  @param
     *  @return
    **/

    $scope.submitItem               =   function(){

        $scope.validate.variations_walker( $scope.advancedFields, $scope.item.variations ).then( function() {
            // We can submit the item
        });

        return;

        $scope.validate.walker( itemsFields, $scope.item ).then( ( errors ) => {
            // console.log( errors );

            
            $scope.validate.variations_walker( $scope.advancedFields, $scope.item.variations ).then( function() {
                // We can submit the item
            })
        });

        return;

        // validating
        var global_validation       =   $scope.validate.blurAll();
        
        // Must be removed
        return;

        var warningMessage          =   '<?php echo _s( 'Le formulaire comprend {0} erreur(s). Assurez-vous que toutes les informations sont correctes.', 'nexopos_advanced' );?>';

        if( global_validation.length > 0 ) {
            return sharedAlert.warning( warningMessage.format( global_validation.length ) );
        }

        // When submiting item
        var itemToSubmit                    =   sharedFilterItem(
            $scope.item,
            itemsFields,
            $scope.advancedFields
        );

        itemToSubmit[ 'author' ]            =   '<?php echo User::id();?>';
        itemToSubmit[ 'date_creation' ]     =   sharedMoment.now();
        itemToSubmit[ 'namespace' ]         =   $scope.item.namespace;

        // Item Resource POST*
        itemsResource.save( itemToSubmit, function( returned ){
            localStorageService.remove( 'item' );
            $location.path( 'items' );
        });
    }

    /**
     * Close Init
     * @param void
     * @return void
    **/
    
    $scope.closeInit                =   function () {
        // Display a dynamic price when a taxes is selected
        sharedFieldEditor( 'sale_price', $scope.advancedFields.basic ).show          =   function( tab, item ) {
            if( $scope.item.ref_tax ) {
                if( angular.isUndefined( $scope.taxes[ $scope.item.ref_tax ] ) ) {
                    // To Avoid several calls to the database
                    $scope.taxes[ $scope.item.ref_tax ]           =   {};
                    taxesResource.get({
                        id      :   $scope.item.ref_tax
                    },function( entries ) {
                        $scope.taxes[ $scope.item.ref_tax ]       =   entries;
                    });

                    if( angular.isDefined( tab.models.sale_price ) ) {
                        if( $scope.taxes[ $scope.item.ref_tax ].tax_type == 'percent' ) {
                            var percentage      =   ( parseFloat( tab.models.sale_price ) * parseFloat( $scope.taxes[ $scope.item.ref_tax ].tax_percent ) ) / 100;
                            var newPrice        =   parseFloat( tab.models.sale_price ) + percentage;
                            this.addon          =   sharedCurrency.toAmount( newPrice )
                        } else {
                            var newPrice        =   parseFloat( tab.models.sale_price ) + parseFloat( $scope.taxes[ $scope.item.ref_tax ].tax_amount );
                            this.addon          =   sharedCurrency.toAmount( newPrice )
                        }
                    }
                }

                if( _.keys( $scope.taxes[ $scope.item.ref_tax ] ).length > 0 ) {
                    if( angular.isDefined( tab.models ) ) {
                        if( angular.isDefined( tab.models.sale_price ) ) {
                            if( $scope.taxes[ $scope.item.ref_tax ].tax_type == 'percent' ) {
                                var percentage      =   ( parseFloat( tab.models.sale_price ) * parseFloat( $scope.taxes[ $scope.item.ref_tax ].tax_percent ) ) / 100;
                                var newPrice        =   parseFloat( tab.models.sale_price ) + percentage;
                                this.addon          =   sharedCurrency.toAmount( newPrice )
                            } else {
                                var newPrice        =   parseFloat( tab.models.sale_price ) + parseFloat( $scope.taxes[ $scope.item.ref_tax ].tax_amount );
                                this.addon          =   sharedCurrency.toAmount( newPrice )
                            }
                        }
                    }
                }
            }
            return true;
        }

        // Init Item
        $scope.initItem();
    }

    // Yes No Options
    $scope.YesNoOptions     =   [{
            value       :   'yes',
            label       :   '<?php echo _s( 'Oui', 'nexopos_advanced' );?>'
        },{
            value       :   'no',
            label       :   '<?php echo _s( 'Non', 'nexopos_advanced' );?>'
    }];

    $scope.groupLengthLimit     =   10;
    $scope.itemsTypes           =   itemsTypes;
    $scope.fields               =   itemsFields;

    if( typeof $routeParams.types != 'undefined' ) {
        // Resources Loading
        $scope.resourceLoader.push({
            resource    :   providersResource,
            success    :   function( data ) {
                sharedFieldEditor( 'ref_provider', $scope.advancedFields.stock ).options        =   sharedRawToOptions( data.entries, 'id', 'name' );
            }   
        }).push({
            resource    :   categoriesResource,
            success    :   function( data ) {
                sharedFieldEditor( 'ref_category', $scope.fields ).options   =   sharedRawToOptions( data.entries, 'id', 'name' );
            }
        }).push({
            resource    :   deliveriesResource,
            success    :   function( data ) {
                sharedFieldEditor( 'ref_delivery', $scope.advancedFields.stock ).options   =   sharedRawToOptions( data.entries, 'id', 'name' );
            }
        }).push({
            resource    :   unitsResource,
            success    :   function( data ) {
                sharedFieldEditor( 'ref_unit', $scope.fields ).options        =   sharedRawToOptions( data.entries, 'id', 'name' );
            }
        }).push({
            resource    :   taxesResource,
            success    :   function( data ) {
                sharedFieldEditor( 'ref_tax', $scope.fields ).options        =   sharedRawToOptions( data.entries, 'id', 'name' );
            }
        }).push({
            resource    :   departmentsResource,
            success    :   function( data ) {
                sharedFieldEditor( 'ref_department', $scope.fields ).options        =   sharedRawToOptions( data.entries, 'id', 'name' );
                $scope.closeInit();
            }
        });
    } else {
        // delete cached item
        localStorageService.remove( 'item' );
    }

    $scope.$on('$routeChangeStart', function(next, current) {
        $scope.previousPath    =   $location.path();
    });

    $scope.resourceLoader.run();

    $scope.docHeight            =   ( parseFloat( angular.element( '.content-wrapper' ).css( 'min-height' ) ) - 100 ) + 'px';
};

items.$inject           =   [
    '$scope',
    '$http',
    '$location',
    'itemsTypes',
    'itemsTabs',
    'itemsAdvancedFields',
    'itemsFields',
    'itemsResource',
    'itemsVariationsResource',
    'providersResource',
    'categoriesResource',
    'deliveriesResource',
    'unitsResource',
    'taxesResource',
    'departmentsResource',
    '$routeParams',
    'sharedDocumentTitle',
    'sharedValidate',
    'sharedRawToOptions',
    'sharedFieldEditor',
    'sharedAlert',
    'sharedMoment',
    'sharedFilterItem',
    'sharedResourceLoader',
    'sharedFormManager',
    'sharedCurrency',
    'localStorageService'
];

tendooApp.controller( 'items', items );
