<div ng-controller="customersEdit">
    <div class="row">
        <div class="col-md-12">
            <h3 style="margin-top:0px;"><?php echo __( 'Ajouter un client', 'nexopos_advanced' );?><a href="<?php echo site_url([ 'dashboard', 'nexopos', 'customers'] );?>" class="btn btn-primary btn-sm pull-right"><?php echo __( 'Liste des clients', 'nexopos_advanced' );?></a></h3>
        </div>
        <div class="col-md-8 advanced-fields-wrapper">
            <div class="form-group default-fields-wrapper">
                <div class="input-group input-group-lg">
                    <span class="ng-hide input-group-btn ">
                        <span class="ng-hide"></span>
                    </span>
                    <input
                        placeholder="<?php echo __( 'Nom du client', 'nexopos_advanced' );?>"
                        ng-blur="validate.blur( fields[0], item )"
                        ng-focus="validate.focus( fields[0], item )"
                        type="text" class="form-control"
                        style="line-height:40px;font-size:25px;" ng-model="item[ fields[0].model ]">
                    <span class="input-group-btn ">
                        <button ng-click="submitItem()" class="btn btn-primary" type="button"><?php echo __( 'Publier', 'nexo' );?></button>
                        <span class="ng-hide"></span>
                    </span>
                </div>
                <p class="help-block {{ fields[0].model }}-helper" style="font-size:12px;">{{ fields[0].desc }}</p>
            </div>
            <customers-details/>
        </div>
        <div class="col-md-4 default-fields-wrapper">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">
                        <span><?php echo __( 'Informations Personnelles', 'nexo' );?></span>
                    </div>
                    <div class="box-tools pull-right">
                        <button ng-click="" type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    {{ item }}
                    <div class="row">
                      <?php $this->module_view( 'nexopos_advanced', 'angular.shared.templates.fields-template' );?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
