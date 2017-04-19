<?php if( true == false ):?>
<script>
<?php endif;?>
var categories          =   function(
    
    $scope,
    $http,
    $location,

    categoriesFields,
    categoriesResource,
    categoriesAddTextDomain,
   
    sharedValidate,
    sharedRawToOptions,
    sharedDocumentTitle,
    sharedMoment,
    sharedResourceLoader
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter une catégorie', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   categoriesAddTextDomain;
    $scope.fields           =   categoriesFields;
    $scope.item             =   {};
    $scope.validate         =   new sharedValidate();
    $scope.resourceLoader   =   new sharedResourceLoader();

    // Setting options for ref_parent select

    $scope.resourceLoader.push({
        resource    :   categoriesResource,
        success     :   function(data){
            $scope.fields[1].options = sharedRawToOptions(data.entries, 'id', 'name');
        }
    }).run();

    //Submitting Form

    $scope.submit       =   function(){
        $scope.item.author          =   <?= User::id()?>;
        $scope.item.date_creation   =   sharedMoment.now();

        if($scope.item.ref_parent == null){
            $scope.item.ref_parent = 0;
        }

        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
        }
        $scope.submitDisabled       =   true;

        categoriesResource.save(
            $scope.item,
            function(){
                if( $location.search().fallback ) {
                    $location.url( $location.search().fallback );
                } else {
                    $location.url( '/categories?notice=done' );
                }                
            },function( returned ){

                $scope.submitDisabled   =   false;

                if( returned.data.status === 'alreadyExists' ) {
                    sharedAlert.warning( '<?php echo _s( 'Le nom de cette catégorie est déjà en cours d\'utilisation, veuillez choisir un autre nom.', 'nexopos_advanced' );?>' );
                }

                if( returned.data.status === 'forbidden' || returned.status == 500 ) {
                    sharedAlert.warning( '<?php echo _s( 'Une erreur s\'est produite durant l\'opération.', 'nexopos_advanced' );?>' );
                }
            }
        )
    }
}

categories.$inject    =   [
    '$scope',
    '$http',
    '$location',
    'categoriesFields',
    'categoriesResource',
    'categoriesAddTextDomain',
    'sharedValidate',
    'sharedRawToOptions',
    'sharedDocumentTitle',
    'sharedMoment',
    'sharedResourceLoader'
];

tendooApp.controller( 'categories', categories );
