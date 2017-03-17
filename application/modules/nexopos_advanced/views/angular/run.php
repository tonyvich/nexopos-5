<?php global $Options;
if( @$Options[ 'site_language' ] == 'en_US') {
    $locale         =   'fr';
} else if( @$Options[ 'site_language' ] == 'fr_FR') {
    $$locale         =   'en';
} else if( @$Options[ 'site_language' ] == 'es_ES') {
    $locale         =   'es';
} else {
    $locale         =   'en';
}
?>
<script type="text/javascript">
    "use strict";
    moment.locale( '<?phpe echo $locale;?>' );

    tendooApp.run(function ($rootScope, $location) {
        var history = [];

        // Expose Underscore;
        $rootScope._        =   _;

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
