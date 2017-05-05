<div class="row" ng-controller="permManagerController">
    <div class="col-md-6" style="background-color : white;">
        <div>
            <h4>Permissions By role</h4>
            <button class="btn btn-danger pull-right" type="button" ng-click="bulkDelete()"> Delete selected </button>
        </div>
        <uib-tabset active="tab_active">
            <uib-tab index="role.name" ng-repeat="role in roles" heading="{{role.name}}">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="permission in role.permissions" >
                            <td><input type="checkbox" ng-model ="permission.checked" ng-checked ="permission.checked" value="{{ permission.perm_name }}"></td>
                            <td><span class="label bg-blue">{{ permission.perm_name }}</span></td>
                            <td><button class="btn" type="button" ng-click="delete(permission.perm_name,  role.name)"> Delete </button></td>
                        </tr>
                    </tbody>
                </table>
            </uib-tab>
        </uib-tabset>
    </div>
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <div class="box-title">
                    <h3> Add a permission</h3>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"> Permission </span>
                        <select
                        class="form-control"
                        ng-model="add['permission']"
                        >
                            <option ng-repeat="option in permissions" value="{{ option.id }}">{{ option.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"> Role </span>
                        <select
                            class="form-control"
                            ng-model="add['group']"
                            >
                            <option ng-repeat="option in roles" value="{{ option.id }}">{{ option.name }}</option>
                        </select>
                    </div>
                </div>
                <p>
                    <button class="btn btn-info" type="button" ng-click="addPermission()"> Add </button>
                </p>
            </div>
        </div>
    </div>
</div>
