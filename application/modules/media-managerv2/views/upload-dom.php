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
                  <div class="row">
                      <div class="col-md-9">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><?php echo __( 'Search', 'media-manager' );?></span>
                                    <input type="text" class="form-control" placeholder="" ng-model="searchInput">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary" name="button" ng-click="search()"><i class="fa fa-search"></i></button>
                                        <button ng-click="enableBulkSelect()" ng-if="multiselect == false" class="btn btn-default"><?php echo __( 'Bulk Select', 'media-manager' );?></button>
                                        <button ng-click="cancelBulkSelect()" ng-if="multiselect == true" class="btn btn-default"><?php echo __( 'Cancel', 'media-manager' );?></button>
                                        <button type="button" class="btn btn-danger" ng-click="delete()" ng-show="countSelected() > 0"><i class="fa fa-trash"></i></button>
                                    </div>
                                  </div>
                                  <br>
                              </div>
                              <div class="md-col-12">
                                  <div class="container-fluid" style="padding-top:5px;overflow-y:scroll;height:300px;">
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
                      <div class="col-md-3">
                          <div ng-show="countSelected() == 1">
                              <h2 class="page-header">
                                <i class="fa fa-globe"></i> <?php echo __( 'Details', 'media-manager' );?>
                              </h2>
                                <p>
                                    <strong><?php echo __( 'Name' , 'media-manager' );?> : </strong>
                                    {{ entries[ selectedIndex ].name }}
                                </p>
                          </div>
                          <div ng-show="countSelected() > 1">
                              <h2 class="page-header">
                                <i class="fa fa-globe"></i> <?php echo __( 'Details', 'media-manager' );?>
                              </h2>
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