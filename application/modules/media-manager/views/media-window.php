<div class="row">
    <div class="col-xs-2" style="padding-right:0px"> <!-- required for floating -->
    <!-- Nav tabs -->
        <ul class="nav nav-tabs tabs-left media-tabs" style="padding-top: 10px;">
            <li ng-repeat="tab in tabs" ng-class="{ 'active' : tab.active }" ng-click="selectTab( tab )"><a href="javascript:void(0)">{{ tab.title }}</a></li>
        </ul>
    </div>
    <div class="col-xs-10" style="padding-right:30px">
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" ng-if="currentTab.namespace == 'select_file'">
                <div class="row">
                    <div class="col-md-9 no-padding-right">
                        <div style="padding:5px;overflow-y:scroll;" class="image-list-grid"> 
                            <div ng-click="selectEntry( entry )" ng-class="{ 'selected' : entry.selected }" class="media-manager-entry-box" ng-repeat="(index, entry) in mediaEntries"> 
                                <img ng-src="{{ entry.thumb }}"/> 
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <p>
                            <h3><?php echo __('Choose media size','media-manager');?></h3>
                            <div class="form-group">
                                <select class="form-control" ng-model="mediaSize">
                                    <option value="full" selected="selected"><?php echo __('Full size','media-manager');?></option>
                                    <option value="medium"><?php echo __('Medium size','media-manager');?></option>
                                    <option value="original"><?php echo __('Original size','media-manager');?></option>
                                    <option value="thumb"><?php echo __('Thumbnails size','media-manager');?></option>
                                </select>
                            </div>
                        </p>
                    </div>
                </div> 
            </div>
            <div class="tab-pane active" ng-if="currentTab.namespace == 'upload'">
                <ng-dropzone class="dropzone" callbacks="dzCallbacks"/>
            </div>
        </div>
    </div>
</div>
<style>
.media-tabs li a{
     border-radius: 0px;
}
.no-padding-right {
    padding-right:0px;
}
.dropzone {
    margin-top:15px;
}
</style>