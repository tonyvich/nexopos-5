<div class="row" ng-controller="permManagerController">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <div class="box-title">
                    <?php echo __( 'Permissions', 'perm_manager' );?>
                </div>
                <div class="box-tools">
                    <button  style="margin-top: 2px;" class="btn btn-danger pull-right btn-sm" type="button" ng-click="bulkDelete()"> <i class="fa fa-trash"></i> <?php echo __('Delete selected','perm_manager'); ?> </button>
                </div>
            </div>
            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"> <?php echo __( 'Role', 'perm_manager' );?> </span>
                    <select
                    class="form-control"
                    ng-model = "selectedUser"
                    ng-change = "changeSelectedRole()"
                    >
                        <option ng-repeat="role in roles" value="{{ role.name }}">{{ role.name }}</option>
                    </select>
                </div>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th><?php echo __('Permission','perm_manager'); ?></th>
                                <th><?php echo __('Action','perm_manager'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="permission in selectedRole.permissions">
                                <td><input type="checkbox" ng-model ="permission.checked" ng-checked ="permission.checked" value="{{ permission.perm_name }}"></td>
                                <td style="font-size: 16px">{{ permission.perm_desc }}</td>
                                <td><button class="btn btn-sm" type="button" ng-click="delete(permission.perm_name,  selectedRole.id)"> <i class="fa fa-trash"></i> <?php echo __('Delete','perm_manager'); ?> </button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <div class="box-title">
                    <?php echo __( 'Ajouter une permission', 'perm_manager' );?>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"> <?php echo __( 'Permission', 'perm_manager' );?> </span>
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
                        <span class="input-group-addon"> <?php echo __( 'Role', 'perm_manager' );?> </span>
                        <select
                            class="form-control"
                            ng-model="add['group']"
                            >
                            <option ng-repeat="option in roles" value="{{ option.id }}">{{ option.name }}</option>
                        </select>
                    </div>
                </div>
                <p>
                    <button class="btn btn-info" type="button" ng-click="addPermission()"><?php echo __('Add','perm_manager'); ?></button>
                </p>
            </div>
        </div>
    </div>
</div>
