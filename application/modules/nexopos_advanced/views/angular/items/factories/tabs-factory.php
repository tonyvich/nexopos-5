<?php if( true == false ):?>
<script>
<?php endif;?>
tendooApp.factory( 'itemsTabs', [ '$routeParams', function( $routeParams ){
    return function() {
        this.getTabs    =   () => {
            var tabs    =   new Array;
                tabs    =   [{
                    'namespace'     :   'coupon',
                    'title'         :   '<?php echo _s( 'Coupon', 'nexopos_advanced' );?>',
                    'active'        :   false,
                    hide            :   function( item ) {
                        return item.namespace == 'coupon' ? false : true;
                    }
                },{
                    'namespace'     :  'basic',
                    'title'         :  '<?php echo _s( 'Prix', 'nexopos_advanced' );?>',
                    'active'        :   true
                },{
                    'namespace'     :   'barcode',
                    'title'         :   '<?php echo _s( 'Etiquettes', 'nexopos_advanced' );?>',
                    'active'        :   false
                },{
                    'namespace'     :   'stock',
                    'title'         :   '<?php echo _s( 'Stock', 'nexopos_advanced' );?>',
                    active          :   false,
                    hide            :   function( item ){
                        /**
                         * If the tab exist, then the current view is the edition. The stock tab is not displayed then
                        **/

                        if( typeof $routeParams.tab != 'undefined' ) {
                            return true;
                        }

                        /**
                         * hidden if the current item type doesn't need it
                        **/
                        
                        return  _.indexOf([ 'services', 'coupon' ], item.namespace ) == -1 ? false : true;
                    }
                },{
                    'namespace'     :  'shipping',
                    'title'         :  '<?php echo _s( 'Caractéristiques', 'nexopos_advanced' );?>',
                    active          :   false,
                    hide            :   function( item ){
                        return  _.indexOf([ 'clothes' ], item.namespace ) == -1 ? true : false;
                    }
                },{
                    'namespace'     :   'images',
                    'title'         :   '<?php echo _s( 'Images', 'nexopos_advanced' );?>',
                    active          :   false
                },{
                    'namespace'     :   'galleries',
                    'title'         :   '<?php echo _s( 'Gallerie', 'nexopos_advanced' );?>',
                    active          :   false
                }];
            return tabs;
        }
    }
}]);
