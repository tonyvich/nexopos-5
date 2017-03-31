var posScreenCTRL           =   function( $scope, $timeout ) {
    $scope.cartItems        =   [];
    $scope.documentHeight   =   angular.element( document ).height();
    $scope.pageHeight       =   angular.element( '.content-wrapper' ).height() - 30;
    $scope.get              =   function( type, namespace ) {
        if( type == 'height' ) {
            if( namespace == 'nexopos-cart-body' ) {
                return angular.element( '.nexopos-cart' ).height() - (
                    angular.element( '.nexopos-cart-footer' ).outerHeight() +
                    angular.element( '.nexopos-cart-header' ).outerHeight()
                );
            } else if( namespace == 'nexopos-cart-table-content' ) {
                return angular.element( '.nexopos-cart-body' ).height() - (
                    angular.element( '.nexopos-cart-table-details' ).outerHeight() +
                    angular.element( '.nexopos-cart-table-header' ).outerHeight()
                );
            }
        }
    }

    $timeout( function(){
        for( i = 0; i < 200; i++ ) {
            $scope.cartItems.push(i);
        }
    }, 1000 );

    $scope.$watch( 'documentHeight', function(){
        console.log( $scope.pageHeight );
    })
}

posScreenCTRL.$inject   =   [ '$scope', '$timeout' ];
tendooApp.controller( 'posScreenCTRL', posScreenCTRL );
