<?php if( true == false ):?>
<script>
<?php endif;?>
var categoriesEdit          =   function(
    categoriesEditTextDomain,
    $scope,
    $http,
    $route,
    categoriesFields,
    categoriesResource,
    $location,
    sharedValidate,
    sharedRawToOptions,
    sharedDocumentTitle,
    sharedMoment,
    sharedResourceLoader
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Editer une catégorie', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   categoriesEditTextDomain;
    $scope.fields           =   categoriesFields;
    $scope.item             =   {};
    $scope.validate         =   new sharedValidate();
    $scope.resourceLoader   =   new sharedResourceLoader();
    

    // Get Resource when loading
    $scope.submitDisabled   =   true;

    $scope.resourceLoader.push({
        resource    :   categoriesResource,
        params      :   {
            id  :  $route.current.params.id
        },
        success     :   function( entry ){
            $scope.submitDisabled   =   false;
            $scope.item             =   entry;
        },
        error       :   function(){
            $location.path( '/nexopos/error/404' )
        }
    }).push({ // Setting options for ref_parent select
        resource    :   categoriesResource,
        params      :   {
            exclude     :   $route.current.params.id
        },
        success     :   function(data){
            $scope.fields[1].options = sharedRawToOptions( data.entries, 'id', 'name');
        }
    }).run();

    //Submitting Form

    $scope.submit       =   function(){
        $scope.item.author              =   <?= User::id()?>;
        $scope.item.date_modification   =   sharedMoment.now();

        if($scope.item.ref_parent == null){
            $scope.item.ref_parent = 0;
        }

        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
        }
        $scope.submitDisabled       =   true;

        categoriesResource.update({
                id  :   $route.current.params.id // make sure route is added as dependency
            },
            $scope.item,
            function(){
                if( $location.search().fallback ) {
                    $location.url( $location.search().fallback );
                } else {
                    $location.url( '/categories?notice=done' );
                }
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

categoriesEdit.$inject    =   [
    'categoriesEditTextDomain',
    '$scope',
    '$http',
    '$route',
    'categoriesFields',
    'categoriesResource',
    '$location',
    'sharedValidate',
    'sharedRawToOptions',
    'sharedDocumentTitle',
    'sharedMoment',
    'sharedResourceLoader'
];

tendooApp.controller( 'categoriesEdit', categoriesEdit );
