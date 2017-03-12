<script type="text/javascript">
    "use strict";
    tendooApp.run(function ($rootScope, $location) {
        var history = [];

        $rootScope.$on('$routeChangeSuccess', function() {
            // history.push($location.$$path);
            var $menu   =   false;
            angular.element( '.sidebar .sidebar-menu a' ).each(function(){
                if( $menu == false ) {
                    $menu   =   $( this ).attr( 'href' ).search( $location.$$path ) != -1 ? $( this ) : false;
                }
            });

            if( $menu != false ) {
                angular.element( '.sidebar .sidebar-menu li' ).each( function(){
                    $( this ).removeClass( 'active' );
                    $( this ).find( 'a' ).removeAttr( 'style' );
                });

                $( $menu ).css({
                    'color'     :   '#FFF'
                });

                $( $menu ).closest( 'li[class*="namespace"]' ).addClass( 'active' );
            }
        });

        $rootScope.back = function () {
            // var prevUrl = history.length > 1 ? history.splice(-2)[0] : "/";
            // $location.path(prevUrl);
        };

    });
</script>
