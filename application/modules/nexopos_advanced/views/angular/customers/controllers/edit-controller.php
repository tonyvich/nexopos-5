var customersEdit               =   function(
    $scope,
    $http,
    $location,
    $route,
    $routeParams,
    customersTabs,
    customersAdvancedFields,
    customersGroupsResource,
    customersResource,
    customersFields,
    sharedFilterItem,
    sharedCountries,
    sharedStates,
    sharedMoment,
    sharedDocumentTitle,
    sharedValidate,
    sharedFieldEditor,
    sharedRawToOptions,
    sharedAlert
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Modifier un client', 'nexopos_advanced' );?>' );

    $scope.item                 =   {
        variations              :   []
    };

    $scope.item.disableVariation    =   true;
    $scope.validate                 =   new sharedValidate();
    $scope.groupLengthLimit         =   10;
    $scope.tabs                     =   customersTabs.getTabs();
    $scope.fields                   =   customersFields;
    $scope.itemsAdvancedFields       =   customersAdvancedFields;
    $scope.countries                =   sharedCountries.countries;
    $scope.states                   =   sharedStates.states

    sharedFieldEditor( 'billing_country', $scope.itemsAdvancedFields.billing ).options     =   $scope.countries;

    sharedFieldEditor( 'shipping_country', $scope.itemsAdvancedFields.shipping ).options     =   $scope.countries;

    // Setting customer group options
    customersGroupsResource.get(
        function(data){
            sharedFieldEditor( 'ref_group', $scope.fields).options = sharedRawToOptions(data.entries, 'id', 'name');
        }
    );

    // Get customers
    $scope.submitDisabled   =   true;
    customersResource.get({
        id  :  $route.current.params.id // make sure route is added as dependency
    }, ( entries ) => {
        $scope.item             =   _.extend( $scope.item, entries.customer[0] );

        // Since variations is not allowed for customers
        _.each( $scope.item.variations[0].tabs, ( tab ) => {

            _.each( entries.address, ( address ) => {
                let namespace   =   address.key.split( '_' );
                    namespace   =   namespace[0];

                if( namespace == tab.namespace ) {
                    tab.models[ address.key ]    =   address.value;
                }
            });
        });

        $scope.submitDisabled   =   false;
    });


    /**
     *  Blur a specific field
     *  @param object field
     *  @param object field data
     *  @param object ids
     *  @return
    **/

    $scope.validate.blur    =   function( field, variation_tab, ids ) {

        if( field.model == 'billing_country' || field.model == 'shipping_country' ) {
            let country_name        =   variation_tab.models[ field.model ];
            let country_states      =   {};

            _.each( $scope.states, function( state ){
                if( state.countryShortCode == country_name ) {
                    country_states = state.regions;
                }
            });

            if( field.model == 'billing_country' ) {
                sharedFieldEditor( 'billing_state', $scope.itemsAdvancedFields.billing ).options     =   country_states;
            } else { // for shipping obvisouly
                sharedFieldEditor( 'shipping_state', $scope.itemsAdvancedFields.shipping ).options     =   country_states;
            }
        }


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

        return response.isValid ? null : validation;
    }

    /**
     *  Blur all fields to display errors
     *  @param object fields
     *  @return void
    **/

    $scope.validate.blurAll         =   function() {

        var global_validation       =   [];

        _.each( $scope.fields, function( field ) {
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

                var allFields       =   customersAdvancedFields[ tab.namespace ];

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

        // sharedCountries($scope.itemsAdvancedFields.billing);
        // sharedCountries($scope.itemsAdvancedFields.shipping);

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

    $scope.$watch( 'item', function(){
        if( $scope.item.variations.length == 0 ) {
            $scope.item.variations.push({
                tabs    :   customersTabs.getTabs()
            });
        }

        _.each( $scope.item.variations, function( variation, $tab_id ) {
            _.each( variation.tabs, function( tab, $tab_key ) {
                tab.models      =   {};
            });
        });
    });

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

        $scope.finalItem                    = sharedFilterItem(
            $scope.item,
            $scope.fields,
            $scope.itemsAdvancedFields
        );

        $scope.finalItem.author             = <?= User::id()?>;
        $scope.finalItem.date_modification      = sharedMoment.now();

        customersResource.update({
                id  :   $route.current.params.id // make sure route is added as dependency
            },
            $scope.finalItem,
            function(){
                if( $location.search().fallback ) {
                    $location.url( $location.search().fallback );
                } else {
                    $location.url( '/customers?notice=done' );
                }
            },function( returned ){

                $scope.submitDisabled   =   false;

                if( returned.data.status === 'alreadyExists' ) {
                    sharedAlert.warning( '<?php echo _s( 'Le nom ce client est déjà en cours d\'utilisation, veuillez choisir un autre nom.', 'nexopos_advanced' );?>' );
                }

            // When submiting item
            var itemToSubmit            =   sharedFilterItem( $scope.item, $scope.fields, customersAdvancedFields );

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
};

customersEdit.$inject           =   [
    '$scope',
    '$http',
    '$location',
    '$route',
    '$routeParams',
    'customersTabs',
    'customersAdvancedFields',
    'customersGroupsResource',
    'customersResource',
    'customersFields',
    'sharedFilterItem',
    'sharedCountries',
    'sharedStates',
    'sharedMoment',
    'sharedDocumentTitle',
    'sharedValidate',
    'sharedFieldEditor',
    'sharedRawToOptions',
    'sharedAlert'
];

tendooApp.controller( 'customersEdit', customersEdit );
