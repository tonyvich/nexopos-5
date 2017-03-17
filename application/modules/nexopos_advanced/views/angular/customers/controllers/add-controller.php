var customersAdd               =   function(
    $scope,
    $http,
    $location,
    customerTabs,
    customerAdvancedFields,
    customerFields,
    customerResource,
    customersGroupsResource,
    $routeParams,
    sharedDocumentTitle,
    sharedValidate,
    rawToOptions,
    sharedFieldEditor,
    sharedAlert
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter un client', 'nexopos_advanced' );?>' );

    $scope.item                 =   [];
    $scope.validate             =   new sharedValidate();
    $scope.groupLengthLimit     =   10;
    $scope.fields               =   customerFields;
    $scope.tabs                 =   customerTabs.getTabs();
    $scope.advancedFields       =   customerAdvancedFields;

    customersGroupsResource.get(
        function(data){
            $scope.advancedFields['general'][6].options = rawToOptions(data.entries, 'id', 'name');
        }
    );

    /**
     *  Get Class
     *  Access ids object and return all ui classe for selecting variation, variation header, variation vontent
     *  @param  object ids object
     *  @return object
    **/

    $scope.getClass         =   function( ids ) {

        // if ids is not default, just return a non defined value.
        if( typeof ids == 'undefined' ) {
            return {};
        }

        var classes_object          =   {
            variation               :   '.variation-' + ids.variation_id,
            variation_header        :   '.variation-header-' + ids.variation_id,
            variation_body          :   '.variation-body-' +   ids.variation_id,
            // variation_tab           :   '.variation-' + ids.variation_id + '-tab-' + ids.variation_tab_id,
            variation_tab_header    :   '.variation-' + ids.variation_id + '-tab-header-' + ids.variation_tab_id,
            variation_tab_body      :   '.variation-' + ids.variation_id + '-tab-body-' + ids.variation_tab_id,
        }

        if( angular.isDefined( ids.variation_group_id ) ) {
            // classes_object.variation_group              =   '.variation-' + ids.variation_id + '-tab-' +  ids.variation_tab_id + '-group-' + ids.variation_group_id;
            classes_object.variation_group_header       =   '.variation-' + ids.variation_id + '-tab-' + ids.variation_tab_id + '-group-header-' + ids.variation_group_id;
            classes_object.variation_group_body         =   '.variation-' + ids.variation_id + '-tab-' + ids.variation_tab_id + '-group-body-' + ids.variation_group_id;
        }

        return classes_object;
    }


    /**
     *  Show or Hide UI
     *  @param string ui namespace
     *  @return void
    **/

    $scope.show             =   function( namespace ) {
        if( namespace == 'selectType' ) {
            $scope.showItemUI       =   false;
        } else if( namespace == 'showItemUI' ){
            $scope.showItemUI       =   true;
        }
    }

    /**
     *  Submit Items (needs review)
     *  @param
     *  @return
    **/

    $scope.submitItem               =   function(){

        $scope.item.author          =   <?= User::id()?>;
        $scope.item.date_creation   =   tendoo.now();

        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
        }

        // When submiting item
        console.log( item );
    }

    /**
     *  Select Tab
     *  @param object tabs
     *  @param string tab naemspace
     *  @return object
    **/

    $scope.selectTab        =   function( tabs, namespace ) {
        var tabToReturn;
        _.each( tabs, function( tab, key ) {
            if( tab.namespace == namespace ) {
                tabToReturn =   key;
            }
        });
        return tabs[ tabToReturn ];
    }

    /**
     *  tabContent is active, check whether a tab is already active
     *  @param
     *  @return
    **/

    $scope.tabContentIsActive   =   function( tabActive, index ) {
        if( angular.isDefined( tabActive ) ) {
            return tabActive;
        }

        if( index == 0 ) {
            return true;
        }
        return false;
    }

    /**
     *  Toggle Tip
     *  @param object field
     *  @return boolean
    **/

    $scope.toggleFieldTip           =   function( field ) {
        if( angular.isUndefined( field.tip ) ) {
            field.tip   =   false;
        }
        return field.tip  = ! field.tip;
    }

     /**
     *  tabContent is active, check whether a tab is already active
     *  @param
     *  @return
    **/

    $scope.tabContentIsActive   =   function( tabActive, index ) {
        if( angular.isDefined( tabActive ) ) {
            return tabActive;
        }

        if( index == 0 ) {
            return true;
        }
        return false;
    }

    /**
     *  Active Tab
     *  @param
     *  @return
    **/

    $scope.activeTab        =   function( $event, tabIndex ) {
        angular.element( $event.currentTarget )
        .parent( 'li' )
        .siblings()
        .removeClass( 'active' );

        angular.element( $event.currentTarget )
        .parent( 'li' )
        .addClass( 'active' );

        _.each( $scope.tabs, function( value ) {
            value.active    =   false;
        });

        $scope.tabs[ tabIndex ].active     =   true;
    }

};

customersAdd.$inject           =   [
    '$scope',
    '$http',
    '$location',
    'customerTabs',
    'customerAdvancedFields',
    'customerFields',
    'customerResource',
    'customersGroupsResource',
    '$routeParams',
    'sharedDocumentTitle',
    'sharedValidate',
    'rawToOptions',
    'sharedFieldEditor',
    'sharedAlert'
];

tendooApp.controller( 'customersAdd', customersAdd );
