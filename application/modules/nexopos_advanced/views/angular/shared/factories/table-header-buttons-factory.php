tendooApp.factory( 'sharedTableHeaderButtons', function(){
    return function() {
        return [{
            text        :   '<?php echo _s( 'CSV', 'nexopos_advanced' );?>',
            show        :   {
                singleSelect    :   true, // if the table has a single select , the button will appear
                multiSelect     :   true, // if the table has more that one select, the button will appear
                noSelect        :   true // if the table has 0 entry selected, the button will appear
            },
            icon        :   'fa fa-file-o'
        },{
            text        :   '<?php echo _s( 'PDF', 'nexopos_advanced' );?>',
            show        :   {
                singleSelect    :   true, // if the table has a single select , the button will appear
                multiSelect     :   true, // if the table has more that one select, the button will appear
                noSelect        :   true // if the table has 0 entry selected, the button will appear
            },
            icon        :   'fa fa-file-text'
        }]
    }
});
