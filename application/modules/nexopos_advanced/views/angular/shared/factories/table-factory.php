tendooApp.factory( 'table', function(){
    return new function(){
        this.columns    =   [];

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

    }
})
