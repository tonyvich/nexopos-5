<?php if( true == false ):?><script><?php endif;?>
tendooApp.directive( 'itemEdit', function(){
    return {
        restrict        :   'E',
        templateUrl     :   'templates/items/edit',
        controller      :   [ 
            
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
            'localStorageService',

            function( 
                
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

            
            $scope                      =   _.extend( $scope, new sharedFormManager );
            $scope.resourceLoader       =   new sharedResourceLoader;
            $scope.category_desc        =   '<?php echo __( 'Assigner une catégorie permet de regrouper les produits similaires.', 'nexopos_advanced' );?>';
            $scope.validate             =   new sharedValidate();
            $scope.taxes                =   new Array;
            $scope.groupLengthLimit     =   10;
            $scope.itemsTypes           =   itemsTypes;
            $scope.fields               =   itemsFields;
            $scope.advancedFields       =   new itemsAdvancedFields();

            /**
            *  Add Variation
            *  @param void
            *  @return void
            **/

            $scope.addVariation         =   function(){
                if( this.item.variations.length == 10 ) {
                    NexoAPI.Notify().info( '<?php echo _s( 'Attention', 'nexopos_advanced' );?>', '<?php echo _s( 'Vous ne pouvez pas créer plus de 10 variations d\'un même produit.', 'nexopos_advanced' );?>')
                    return;
                }

                var singleVariation         =   {
                    tabs        :   this.item.getTabs()
                };

                _.each( singleVariation, function( variation, $tab_id ) {
                    _.each( variation.tabs, function( tab, $tab_key ) {
                        tab.models      =   {};
                    });
                });

                this.item.variations.push( this.hooks.applyFilters( 'addVariation', singleVariation ) );
            }

            /**
            *  Remove Variation
            *  @param int variation index
            *  @return void
            **/

            $scope.removeVariation  =   function( $index ){
                sharedAlert.confirm( '<?php echo _s( 'Souhaitez-vous supprimer cette variation ?', 'nexopos_advanced' );?>', ( action ) => {
                    if( action ) {
                        this.item.variations.splice( this.hooks.applyFilters( 'removeVariation', $index ), 1 );
                    }
                });
            }

            /**
            *  Remove Group
            *  @param int group index
            *  @return void
            **/

            $scope.removeGroup      =   function( $index, $groups, ids ) {
                sharedAlert.confirm( '<?php echo _s( 'Souhaitez-vous supprimer ce groupe ?', 'nexopos_advanced' );?>', ( action ) => {
                    if( action ) {

                        if( typeof this.item.variations[ ids.variation_id ].tabs[ ids.variation_tab_id ].groups_errors != 'undefined' ) {
                            // delete all error related to the deleted group
                            this.item.variations[ ids.variation_id ].tabs[ ids.variation_tab_id ].groups_errors[ ids.variation_tab.namespace ].splice( $index, 1 );
                        }                    

                        $groups.splice( this.hooks.applyFilters( 'removeGroup', $index ), 1 );
                    }
                });
            }

            /**
             * Duplicated a given variation
             * @param object variation
             * @param int variation index
             * @return void
            **/
            
            $scope.duplicate 	=	function( variation, $index ) {
                let copied_variation;
                copied_variation    =   {
                    models      :   angular.copy( variation.models ),
                    tabs        :   this.item.getTabs()
                };

                // copy only models from original 
                copied_variation.tabs.forEach( ( value, key ) => {
                    value.models    =   angular.copy( variation.tabs[ key ].models );
                });

                this.hooks.applyFilters( 'duplicateVariation', copied_variation );

                this.item.variations.splice( $index + 1, 0, copied_variation );

                setTimeout( () => {
                    angular.element( '.variation-' + ( $index + 1 ) ).hide().fadeIn( 500 );
                }, 50 );
            }

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
             *  Blur a specific field
             *  @param object field
             *  @param object field data
             *  @param object ids
             *  @return
            **/

            $scope.validate.blur    =   function( field, variation_tab, ids ) {

                let showErrors      =   () => {
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
                    return response;
                }

                if( ! angular.isDefined( variation_tab ) ) {
                    return false;
                }

                // If visibility is hidden on some fields, validation will be skipped on that.
                // @deprecated
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

                // this only run if the field has a callback method.
                if( typeof validation[ field.model ] != 'undefined' ) {
                    if( typeof validation[ field.model ].callback != 'undefined' ) {
                        let promise         =   validation[ field.model ].callback( field, variation_tab.models, {} );
                        return promise.then( ( errors ) => {
                            if( ! angular.equals({}, errors ) ) {
                                validation[ field.model ].msg       =   "<?php echo _s( 'Ce code barre est déjà en cours d\'utilisation.', 'nexopos_advanced' );?>";
                                let response                        =   showErrors({ validation, ids });
                            }
                        });
                    }
                }                 

                let response        =   showErrors({ validation, ids });
                
                return response.isValid ? null : validation;
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

                // When everything seems to be done, then we can check if the item exist on the local store
                if( localStorageService.isSupported ) {
                    return;
                    // The item is reset if you access from type selection
                    // Maybe a prompt can ask whether the saved item should be deleted :\ ?
                    if( $location.path() == '/items/types' ) {
                        localStorageService.remove( 'item_' + $routeParams.id );
                    } else {
                        if( typeof localStorageService.get( 'item_' + $routeParams.id ) === 'object' ) {

                            let savedItem           =   localStorageService.get( 'item_'  + $routeParams.id );
                            
                            if( savedItem != null ) {

                                _.each( savedItem, ( field, field_name) => {
                                    if( field_name != 'variations' ) {
                                        $scope.item[ field_name ]   =   field;
                                    }
                                });

                                let tabs        =   new itemsTabs;

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
                            }
                        
                        }
                    }
                }
            }

            /**
             *  Submit Items (needs review)
             *  @param
             *  @return
            **/

            $scope.submitItem               =   function(){

                $scope.validate.walker({
                    fields : $scope.fields,
                    models : $scope.item
                }).then( ( errors ) => {
                    $scope.validate.variations_walker({
                        fields      :   $scope.advancedFields,
                        item        :   $scope.item
                    }).then( function() {
                        $scope.$apply();
                        
                        // Counting all errors
                        let allErrors   =   _.keys( errors ).length;

                        // variations errors
                        _.each( $scope.item.variations, ( variation ) => {
                            allErrors   +=  _.keys( variation.errors ).length;

                            // looking groups wrapper
                            _.each( variation.groups_errors, ( group_errors ) => {
                                // lopping groups errors
                                _.each( group_errors, ( errors ) => {
                                    allErrors   +=  _.keys( errors ).length;
                                });
                            });
                        });
                        
                        // if the form has some errors
                        if( allErrors > 0 ) {
                            let warningMessage          =   '<?php echo _s( 'Le formulaire comprend {0} erreur(s). Assurez-vous que toutes les informations sont correctes.', 'nexopos_advanced' );?>';
                            return sharedAlert.warning( warningMessage.format( allErrors ) );
                        }

                        // no errors let's continue
                        // When submiting item
                        var itemToSubmit                    =   sharedFilterItem(
                            $scope.item,
                            itemsFields,
                            $scope.advancedFields
                        );

                        itemToSubmit[ 'author' ]                =   '<?php echo User::id();?>';
                        itemToSubmit[ 'date_modification' ]     =   sharedMoment.now();
                        itemToSubmit[ 'namespace' ]             =   $scope.item.namespace;

                        // Item Resource Update
                        itemsResource.update({
                            id      :   $routeParams.id
                        }, itemToSubmit, function( returned ){
                            localStorageService.remove( 'item' );
                            $location.path( 'items' );
                        });
                    });
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

            /**
            * Load Item
            * @param void
            * @return void
            **/
            
            $scope.loadItem 	            =   function(){
                itemsResource.get({
                    id  :   $routeParams.id
                }, ( item ) => {

                    $scope.closeInit();

                    // Assign available field to the item
                    // When the item is completely loaded
                    $scope.fields.forEach( ( field ) => {
                        $scope.item[ field.model ]   =   item[ field.model ];
                    });

                    let emptyVariation              =   angular.copy( $scope.item.variations[0] );
                    // $scope.item.variations          =   [];

                    item.variations.forEach( ( variation, index ) => {
                        
                        $scope.item.variations[ index ]     =   angular.copy( emptyVariation );

                        // Browse field model name and add it to the item variation
                        for( let tab in $scope.advancedFields ) {

                            // get the right tab index
                            let tabIndex    =   null;

                            $scope.item.variations[ index ].tabs.forEach( ( variationTab, tabId ) => {
                                if( variationTab.namespace == tab ) {
                                    tabIndex    =   tabId;
                                }
                            });
                            
                            $scope.advancedFields[ tab ].forEach( ( field, fieldIndex ) => {

                                if( field.type != 'group' ) {

                                    $scope.item.variations[ index ].tabs[ tabIndex ].models[ field.model ]   =   variation[ field.model ];
                                    
                                } else {
                                    // This works for groups
                                    $scope.item.variations[ index ].tabs[ tabIndex ].models[ field.model ]     =   [];

                                    if( variation[ field.model ].length > 0 ) {
                                        // Looping groups
                                        for( let groupIndex in variation[ field.model ] ) {
                                            
                                            // Looping the subField to get their model name
                                            if( typeof field.subFields != 'undefined' ) {

                                                // create group model
                                                $scope.item.variations[ index ].tabs[ tabIndex ].models[ field.model ][ groupIndex ]           =   {}
                                                $scope.item.variations[ index ].tabs[ tabIndex ].models[ field.model ][ groupIndex ].models    =   {};

                                                field.subFields.forEach( ( subField ) => {
                                                    $scope.item.variations[ index ].tabs[ tabIndex ].models[ field.model ][ groupIndex ].models[ subField.model ]     =   variation[ field.model ][ groupIndex ][ subField.model ];   
                                                });
                                            }
                                        }
                                    } else {
                                        // To handle empty values
                                        $scope.item.variations[ index ].tabs[ tabIndex ].models[ field.model ]              =   [];
                                        $scope.item.variations[ index ].tabs[ tabIndex ].models[ field.model ][0]           =   {}
                                        $scope.item.variations[ index ].tabs[ tabIndex ].models[ field.model ][0].models    =   {}
                                        field.subFields.forEach( ( subField ) => {
                                            $scope.item.variations[ index ].tabs[ tabIndex ].models[ field.model ][0].models[ subField.model ]     =   null;
                                        });
                                    }                                    
                                }                                
                            });   
                        };
                    });   
                }, ( data ) => {
                    if( data.status == '404' ) {
                        $location.path( '/errors/404' );
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
                            localStorageService.set( 'item', $scope.item );
                        });
                    }
                }
            }

            /**
             * Overwrite add a new variations
             * @param void
             * @return void
            **/

            $scope.removeVariation      =   ( variation_id ) => {

            }

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
                    $scope.loadItem();
                }
            });

            $scope.resourceLoader.run();
        }]
    }
})