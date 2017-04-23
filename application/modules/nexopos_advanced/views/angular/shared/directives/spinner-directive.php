angular.element( document ).ready( function(){
    tendooApp.directive( 'spinner', function(){
        alert( 'ok' );
        return {
            restrict    :   'E',
            scope       :   {
                width       :   '='
            },
            template    :   '<div class="sp sp-circle hidden"></div>'
        }
    })
})