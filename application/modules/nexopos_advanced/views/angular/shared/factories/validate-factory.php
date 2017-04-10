tendooApp.factory( 'sharedValidate', function(){
    return function(){
        var expression  =   {
            required: /^\s*$/,
            url: /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/,
            email: /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/,
            number: /^\d+$/,
            alpha_char  :    /^[a-zA-Z]+$/,
            alpha_num   :   /^[a-zA-Z0-9]+$/,
            ip          :   /^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?).){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/,
            digit       :   /^[0-9]+$/,
            decimal       :   /^[+-]?\d+(\.\d+)?$/
        };

        var $this       =   this;

        /**
         *  Individual Validation
         *  @param object field
         *  @param object item
         *  @return object error
        **/

        this.__run          =   function( field, item ) {
            var errors      =   {};

            if( angular.isDefined( field.validation ) ) {

                _.each( field.validation, function( value, rule ) {

                    // If a field has a specific formating, let's apply this before validating
                    if( typeof field.beforeValidation != 'undefined' ) {
                        item[ field.model ]     =   field.beforeValidation( item[ field.model ] );
                    }

                    if( rule == 'required' && value == true ) {
                        if( ! angular.isDefined( item[ field.model ] ) || item[ field.model ] == null ) {
                            errors[ field.model ]           =   {};
                            errors[ field.model ].msg       =   '<?php echo _s( 'Ce champ est requis.', 'nexopos_advanced' );?>';
                            errors[ field.model ].label     =   field.label;
                        } else if( item[ field.model ].match( expression.required ) ) {
                            errors[ field.model ]           =   {};
                            errors[ field.model ].msg       =   '<?php echo _s( 'Ce champ est requis.', 'nexopos_advanced' );?>';
                            errors[ field.model ].label     =   field.label;
                        }
                    }

                    if(
                        rule == 'email' &&
                        value == true &&
                        typeof item[ field.model ] != 'undefined' &&
                        angular.equals({}, errors )
                    ) {
                        if( item[ field.model ] != null ) {
                            if( ! item[ field.model ].match( expression.email ) ) {
                                errors[ field.model ]           =   {};
                                errors[ field.model ].msg       =   '<?php echo _s( 'La valeur %% n\'est pas une adresse email valide.', 'nexopos_advanced' );?>';
                                errors[ field.model ].label     =   field.label;
                            }
                        }
                    }

                    if(
                        rule == 'min_value' &&
                        typeof item[ field.model ] != 'undefined' &&
                        angular.equals({}, errors )
                    ) {
                        if( item[ field.model ] != null ) {
                            if( item[ field.model ].length < value ) {
                                errors[ field.model ]           =   {};
                                errors[ field.model ].msg       =   '<?php echo _s( 'La longueur de ce champ ne doit pas être inférieure à {0}.', 'nexopos_advanced' );?>' . format( value );
                                errors[ field.model ].label     =   field.label;
                            }
                        }
                    }

                    if(
                        rule == 'max_value' &&
                        typeof item[ field.model ] != 'undefined' &&
                        angular.equals({}, errors )
                    ) {
                        if( item[ field.model ] != null ) {
                            if( item[ field.model ].length > value ) {
                                errors[ field.model ]           =   {};
                                errors[ field.model ].msg       =   '<?php echo _s( 'La longueur de ce champ ne doit pas excéder {0}', 'nexopos_advanced' );?>' . format( value );
                                errors[ field.model ].label     =   field.label;
                            }
                        }
                    }

                    if(
                        rule == 'numeric' &&
                        value == true &&
                        typeof item[ field.model ] != 'undefined' &&
                        angular.equals({}, errors )
                    ) {
                        if( item[ field.model ] != null ) {
                            if( ! item[ field.model ].match( expression.number ) ) {
                                errors[ field.model ]           =   {};
                                errors[ field.model ].msg       =   '<?php echo _s( 'Ce champ devrait avoir une valeur numérique.', 'nexopos_advanced' );?>';
                                errors[ field.model ].label     =   field.label;
                            }
                        }
                    }

                    if(
                        rule == 'decimal' &&
                        value == true &&
                        typeof item[ field.model ] != 'undefined' &&
                        angular.equals({}, errors )
                    ) {
                        if( item[ field.model ] != null ) {
                            if( ! item[ field.model ].match( expression.decimal ) ) {
                                errors[ field.model ]           =   {};
                                errors[ field.model ].msg       =   '<?php echo _s( 'Ce champ devrait avoir une valeur numérique/décimale.', 'nexopos_advanced' );?>';
                                errors[ field.model ].label     =   field.label;
                            }
                        }
                    }

                    /**
                     * Callback Rules
                     * Define a callback on a field, which can make an http request.
                    **/

                    if( rule == "callback" ) {
                        value( item, field, errors );
                    }

                });
            }

            item[ field.model ]     =   angular.isUndefined( item[ field.model ]  ) ? '' : item[ field.model ];

            return errors;
        }

        this.run        =   function( fields, item ) {
            var errors          =   {};

            _.each( fields, function( field ){
                // extends current field errors
                let singleRunResult     =   $this.__run( field, item ) ;

                errors          =   _.extend( errors, singleRunResult );
            });

            // replace template on error if exists
            errors              =   this.__replaceTemplate( errors );

            return this.__response( errors );
        };

        /**
         *  Turn into response
         *  @param object error
         *  @return object
        **/

        this.__response     =   function( errors ) {
            return {
                isValid     :   angular.equals({}, errors ) ? true : false,
                errors      :   errors
            }
        }

        this.focus      =   function( field, item, $event ) {
            var fieldClass      =   '.' + field.model + '-helper';
            if( angular.isDefined( $event ) ) {
                angular.element( $event.target ).closest( '.form-group' ).removeClass( 'has-error' );
                angular.element( $event.target ).closest( '.form-group' ).find( 'p.help-block' ).text( field.desc );
            } else {
                angular.element( fieldClass ).closest( '.form-group' ).removeClass( 'has-error' );
                angular.element( fieldClass ).text( field.desc );
            }
        }

        /**
         *  unique validation
         *  @param object fields
         *  @param object item
         *  @return void
        **/

        this.blur       =   function( field, item, $event ) {
            var validation      =   this.__run( field, item );
            var response        =   this.__response( validation );
            var errors          =   this.__replaceTemplate( response.errors );
            var fieldClass      =   '.' + field.model + '-helper';

            if( ! response.isValid ) {
                if( angular.isDefined( $event ) ) {
                    angular.element( $event.target ).closest( '.form-group' ).removeClass( 'has-success' );
                    angular.element( $event.target ).closest( '.form-group' ).find( 'p.help-block' ).text( errors[ field.model ].msg );
                    angular.element( $event.target ).closest( '.form-group' ).addClass( 'has-error' );
                } else {
                    angular.element( fieldClass ).closest( '.form-group' ).removeClass( 'has-success' );
                    angular.element( fieldClass ).text( errors[ field.model ].msg );
                    angular.element( fieldClass ).closest( '.form-group' ).addClass( 'has-error' );
                }
            }
        }

        /**
         *  Blur all fields to display errors
         *  @param object fields
         *  @return void
        **/

        this.blurAll            =   function( fields, item ) {
            _.each( fields, function( field ) {
                $this.blur( field, item );
            });
        }

        /**
         *  Replace template
         *  @param  object validation object
         *  @return object
        **/

        this.__replaceTemplate    =   function( errors ) {
            _.each( errors, function( value, key ) {
                errors[ key ].msg   =   value.msg.replace( '%%', value.label );
            });
            return errors;
        }
    }
})
