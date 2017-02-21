tendooApp.factory( 'table', [ 'sharedAlert', function( sharedAlert ){
    return new function(){
        this.columns            =   [];

        // For select action for bulk operation
        this.selectedAction     =   void(0);

        /**
         *  Order Columns
         *  @param object column
         *  @return void
        **/

        this.order      =   function( column ) {

            // Set table order
            if( angular.isUndefined( this.order_type ) ) {
                this.order_type   =   'desc';
            } else if( this.order_type == 'desc' ) {
                this.order_type   =   'asc';
            } else  if( this.order_type == 'asc' ) {
                this.order_type   =   'desc';
            }

            if( angular.isDefined( column ) ) {
                this.order_by           =   column;
            }

            if( typeof this.get == 'function' ) {
                // Trigger callback
                this.get({
                    order_type      :   this.order_type,
                    order_by        :   this.order_by,
                    limit           :   this.limit,
                    current_page    :   this.currentPage
                });
            }
        }

        /**
         *  Get Page
         *  @param int page id
         *  @return void
        **/

        this.getPage                =   function( id ) {
            this.currentPage        =   id;
            $this                   =   this;
            this.order(void(0),function( data ) {
                $this.entries       =   data.entries;
                $this.pages         =   Math.ceil( data.num_rows / $scope.table.limit );
            });
        }

        /**
         *  Get Number
         *  @param int
         *  @return array
        **/

        this.__getNumber        =   function( number ) {
            if( angular.isDefined( number ) ) {
                return new Array( number );
            }
        }

        /**
         *  Toggle All Entry.
         *  @param object entries
         *  @return void
        **/

        this.toggleAllEntries         =   function( entries, headCheckbox ) {
            _.each( entries, function( entry ) {
                entry.checked  =   headCheckbox;
            });
        }

        /**
         *  Submit bulk Actions
         *  @param void
         *  @return void
        **/

        this.submitBulkActions          =   function() {
            if( this.selectedAction != false ) {

                var selectedEntries     =   [];

                _.each( this.entries, function( entry ) {
                    if( entry.checked == true ) {
                        selectedEntries.push( entry.id );
                    }
                })

                if( selectedEntries.length == 0 ) {
                    sharedAlert.warning( '<?php echo _s( 'Vous devez au moins sélectionner un élément', 'nexopos_advanced' );?>' );
                }

                if( this.selectedAction == 'delete' ) {
                    // Here perform actions
                    if( angular.isUndefined( this.delete ) ) {
                        console.log( '"delete" method is not defined' );
                        return;
                    }
                    
                    this.delete({
                        'ids[]'  :   selectedEntries
                    });
                }

            }
        }
    }
}])
