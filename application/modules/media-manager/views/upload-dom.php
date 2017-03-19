<div class="row" ng-controller="mediaManagerCTRL">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#main_page" data-toggle="tab"><?php echo __( 'Medias', 'media-manager' );?></a></li>
              <li><a href="#tab_2" data-toggle="tab"><?php echo __( 'Upload', 'media-manager' );?></a></li>
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="main_page">
                  <div class="row">
                      <div class="col-md-9">
                          <div class="row">
                              <div ng-click="selectEntry( entry )" class="col-md-2" ng-repeat="entry in entries">
                                  <div class="media-manager-entry-box" ng-class="{ 'selected' : entry.selected }">
                                      {{ entry }}
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-3">

                      </div>
                  </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">

              </div>
            </div>
            <!-- /.tab-content -->
          </div>
    </div>
</div>
<style media="screen">
    .media-manager-entry-box {
        border: solid 1px #999;
        height: 100px;
        margin-bottom: 15px;
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
