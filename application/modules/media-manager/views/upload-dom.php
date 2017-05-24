<div class="row parent" ng-controller="mediaManagerCTRL">
    <div class="col-md-12">
        <div class="nav-tabs-custom" style="margin-bottom:0px;">
            <ul class="nav nav-tabs">
              <li ng-click="loadAssets();calculateHeight()" class="active"><a href="#main_page" data-toggle="tab"><?php echo __( 'Medias', 'media-manager' );?></a></li>
              <li ng-click="calculateHeight()"><a href="#upload_tab" data-toggle="tab"><?php echo __( 'Upload', 'media-manager' );?></a></li>
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="main_page">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="row">
                              <div class="col-md-12 mediaDivTool">
                                  <div class="input-group">
                                    <span class="input-group-addon"><?php echo __( 'Search', 'media-manager' );?></span>
                                    <input type="text" class="form-control" placeholder="" ng-model="searchInput">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary" name="button" ng-click="search()"><i class="fa fa-search"></i></button>
                                        <button ng-click="enableBulkSelect()" ng-if="multiselect == false" class="btn btn-default"><?php echo __( 'Bulk Select', 'media-manager' );?></button>
                                        <button ng-click="cancelBulkSelect()" ng-if="multiselect == true" class="btn btn-default"><?php echo __( 'Cancel', 'media-manager' );?></button>
                                        <button type="button" class="btn btn-danger" ng-click="delete()" ng-show="countSelected() > 0"><i class="fa fa-trash"></i></button>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-md-12" style="margin-top:10px">
                                  <div class="mediaDivMedia" style="padding-top:5px;overflow-y:scroll;padding-left:5px;">
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
                    <ng-dropzone class="dropzone" callbacks="dzCallbacks"/>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
    </div>
</div>

<style>
    .parent {
        display: flex;
    }
    .child {
        align-items: stretch;
    }
    .media-manager-entry-box {
        box-shadow: 0 0 0 1px #fff, 0 0 0 5px #DDD;
    }
</style>