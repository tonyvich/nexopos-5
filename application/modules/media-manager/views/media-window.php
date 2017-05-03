<div style="margin-top:10px;padding:5px;overflow-y:scroll;"> 
    <div ng-click="selectEntry( entry )" ng-class="{ 'selected' : entry.selected }" class="media-manager-entry-box" ng-repeat="(index, entry) in mediaEntries"> 
        <img ng-src="{{ entry.thumb }}"/> 
    </div> 
</div>