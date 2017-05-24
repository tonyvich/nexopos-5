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
                                <select class="form-control" id="selectSize">
                                    <option ng-repeat="size in sizes" value="{{ size }}"> {{ size }} </option>
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
.media-manager-entry-box {
    box-shadow: 0 0 0 1px #fff, 0 0 0 5px #EEE;
    margin-right: 15px;
    margin-bottom: 15px;
    float: left;
}
</style>