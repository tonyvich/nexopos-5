<div class="row">
    <div class="col-md-9 advanced-fields-wrapper view-wrapper">
        <div class="form-group default-fields-wrapper">
            <div class="input-group input-group-lg">
                <span class="ng-hide input-group-btn ">
                    <span class="ng-hide"></span>
                </span>
                <input
                    placeholder="<?php echo __( 'Nom du produit', 'nexopos_advanced' );?>"
                    type="text" class="form-control" style="line-height:40px;font-size:25px;" ng-model="item[ fields[0].model ]"
                    ng-blur="validate.blur( fields[0], item )"
                    ng-focus="validate.focus( fields[0], item )"
                    >
                <span class="input-group-btn ">
                    <button ng-click="submitItem()" class="btn btn-primary" type="button"><?php echo __( 'Modifier', 'nexopos_advanced' );?></button>
                    <span class="ng-hide"></span>
                </span>
            </div>
            <p class="help-block {{ fields[0].model }}-helper" style="font-size:12px;">{{ fields[0].desc }}</p>
        </div>
        <item-variation></item-variation>
    </div>
    <div class="col-md-3 default-fields-wrapper">
        <div class="row">
            <?php $this->module_view( 'nexopos_advanced', 'angular.shared.templates.fields-template' );?>
        </div>
    </div>
</div>
<style>
    .view-wrapper .nav-tabs-custom {
        margin-bottom: 20px;
        background: #e9e9e9;
        box-shadow: 0 1px 1px rgba(0,0,0,0.1);
        border-radius: 3px;
        border: solid 1px #EEE;
    }
</style>