<div class="row">
<div class="col-xs-2"> <!-- required for floating -->
<!-- Nav tabs -->
    <ul class="nav nav-tabs tabs-left">
        <li class="active"><a href="#selectDiv" ng-click="loadAssets()" data-toggle="tab"><?php echo __('Select a file','media-manager');?></a></li>
        <li><a href="#uploadDiv" data-toggle="tab"><?php echo __('Upload','media-manager');?></a></li>
    </ul>
</div>

<div class="col-xs-10">
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="selectDiv">
            <div class="row">
                <div class="col-md-9">
                    <div style="margin-top:10px;padding:5px;overflow-y:scroll; max-height:400px;"> 
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
        <div class="tab-pane" id="uploadDiv">
            <ng-dropzone style="height:400px" class="dropzone" callbacks="dzCallbacks"/>
        </div>
    </div>
</div>
</div>