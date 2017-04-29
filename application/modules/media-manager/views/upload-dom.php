<div class="row" ng-controller="mediaManagerCTRL">
    <div class="col-md-12">
        <div class="nav-tabs-custom" style="margin-bottom:0px;">
            <ul class="nav nav-tabs">
              <li ng-click="loadAssets();calculateHeight()" class="active"><a href="#main_page" data-toggle="tab"><?php echo __( 'Medias', 'media-manager' );?></a></li>
              <li ng-click="calculateHeight()"><a href="#upload_tab" data-toggle="tab"><?php echo __( 'Upload', 'media-manager' );?></a></li>
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="main_page">
                  <div class="row" ng-show="countSelected() == 1">
                    <div class="col-md-9">
                    </div>
                    <div class="col-md-3">
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                            <!-- countSelected() -->
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="input-group">
                                    <span class="input-group-addon"><?php echo __( 'Search', 'media-manager' );?></span>
                                    <input type="text" class="form-control" placeholder="">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary" name="button"><i class="fa fa-search"></i></button>
                                        <button ng-click="enableBulkSelect()" ng-if="multiselect == false" class="btn btn-default"><?php echo __( 'Bulk Select', 'media-manager' );?></button>
                                        <button ng-click="cancelBulkSelect()" ng-if="multiselect == true" class="btn btn-default"><?php echo __( 'Cancel', 'media-manager' );?></button>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div style="margin-top:10px;padding:5px;overflow-y:scroll;">
                                      <div
                                        ng-click="selectEntry( entry, index )"
                                        ng-class="{ 'selected' : entry.selected }"
                                        class="media-manager-entry-box"
                                        ng-repeat="(index, entry) in entries">
                                          <img ng-src="{{ entry.thumb }}"/>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="upload_tab">
                  <ng-dropzone style="height:{{ dropZoneHeight }}px" class="dropzone" callbacks="dzCallbacks"/>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
    </div>
</div>
<style media="screen">
    .media-manager-entry-box {
        margin-bottom: 15px;
        float:left;
        width:150px;
        height:150px;
        margin-right:15px;
    }

    .media-manager-entry-box:hover {
        cursor : pointer;
    }

    .media-manager-entry-box:active {
        box-shadow: 0px 0px 5px 3px #a2c9e4;
    }

    .media-manager-entry-box.selected {
        box-shadow: 0 0 0 1px #fff, 0 0 0 5px #0073aa;
    }
</style>
