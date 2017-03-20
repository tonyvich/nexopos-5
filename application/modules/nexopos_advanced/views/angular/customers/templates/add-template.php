<div ng-controller="customersAdd">
    <div class="row">
        <div class="col-md-12">
            <h3 style="margin-top:0px;"><?php echo __( 'Ajouter un client', 'nexopos_advanced' );?><a href="<?php echo site_url([ 'dashboard', 'nexopos', 'customers'] );?>" class="btn btn-primary btn-sm pull-right"><?php echo __( 'Liste des clients', 'nexopos_advanced' );?></a></h3>
        </div>
        <div class="col-md-12 advanced-fields-wrapper">
            <div class="form-group default-fields-wrapper">
                <div class="input-group input-group-lg">
                    <span class="ng-hide input-group-btn ">
                        <span class="ng-hide"></span>
                    </span>
                    <input
                        placeholder="<?php echo __( 'Nom du client', 'nexopos_advanced' );?>"
                        ng-blur="validate.blur( advancedFields['general'][0], item.general)"
                        ng-focus="validate.focus( advancedFields['general'][0], item.general)"
                        type="text" class="form-control"
                        style="line-height:40px;font-size:25px;" ng-model="item.general['name']">
                    <span class="input-group-btn ">
                        <button ng-click="submitItem()" class="btn btn-primary" type="button"><?php echo __( 'Publier', 'nexo' );?></button>
                        <span class="ng-hide"></span>
                    </span>
                </div>
                <p class="help-block {{ advancedFields['general'][0].model }}-helper" style="height:30px;font-size:12px;">{{ advancedFields['general'][0].desc }}</p>
            </div>            
            <div class="nav-tabs-custom variation">
                <ul class="nav nav-tabs variation-header">
                    <li
                        ng-repeat="tab in tabs"
                        class="{{ tabContentIsActive( tab.active ) ? 'active' : '' }} variation-tab-header">
                        <a 
                        href="javascript:void(0)" 
                        ng-click="activeTab( $event, tab.index)">
                            {{ tab.title }} 
                            <!-- <span class="badge badge-warning" ng-show="countAllErrors( tab ) > 0">{{ countAllErrors( tab ) }}</span> -->
                        </a>
                    </li>
                </ul>

                <div class="tab-content variation-body">

                <div
                    ng-repeat="tab in tabs"
                    ng-init="tabs[0].active   =   tabContentIsActive( tabs[0].active, tab.index)"
                    class="variation-tab-body"
                    style="display:block;">

                    <div ng-show="tab.active" class="tab-pane row">

                    <div
                        ng-repeat="field in advancedFields[ tab.namespace ]"
                        class="{{ field.class !== undefined ? field.class : 'col-lg-6 col-sm-6 col-xs-12' }}"
                        ng-show="field.show( tab, advancedFields[ tab.namespace ] )"
                        >

                        <div class="form-group" ng-if="field.type == 'text'">
                            <div class="input-group">
                              <span class="input-group-addon">{{ field.label }}</span>
                              <input
                                type="text"
                                class="form-control"
                                ng-model="item[tab.namespace][field.model]"
                                placeholder="{{ field.placeholder }}"
                                ng-blur="validate.blur( field, item[tab.namespace])"
                                ng-focus="validate.focus( field, item[tab.namespace])"
                                >
                                <span ng-show="field.addon" class="input-group-addon">{{ field.addon }}</span>
                            </div>
                            <p class="help-block {{ field.model }}-helper" style="height:30px;font-size:12px;">{{ field.desc }}</p>
                        </div>

                        <div class="form-group" ng-if="field.type == 'select'">
                            <div class="input-group">
                                <span class="input-group-addon">{{ field.label }}</span>
                                <select
                                    class="form-control"
                                    ng-model="item[ tab.namespace ][ field.model ]"
                                    ng-blur="validate.blur( field, item[tab.namespace])"
                                    ng-focus="validate.focus( field, item[tab.namespace])"
                                >
                                    <option ng-repeat="option in field.options" value="{{ option.value }}">{{ option.label }}</option>
                                </select>
                                <span class="input-group-btn" ng-if="field.buttons.length > 0">
                                    <button class="btn btn-{{ button.class }}" ng-repeat="button in field.buttons" ng-click="button.click()"><i class="{{ button.icon }}"></i> {{ button.label }}</button>
                                </span>
                            </div>
                            <p class="help-block {{ field.model }}-helper" style="height:30px;font-size:12px;">{{ field.desc }}</p>
                        </div>

                        <!--  -->
                        <div class="form-group" ng-if="field.type == 'datepick'">
                            <div class="input-group" on-change="updateDate( item[ tab.namespace ][ field.model ], field.model )" datetimepicker data-ng-model="item[ tab.namespace ][ field.model ]" options="field.options">
                                <span class="input-group-addon">{{ field.label }}</span>
                                <input
                                    class="form-control"
                                    placeholder="{{ field.placeholder }}"
                                    ng-blur="validate.blur( field, item[tab.namespace])"
                                    ng-focus="validate.focus( field, item[tab.namespace])"
                                     />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <p class="help-block {{ field.model }}-helper" style="height:30px;font-size:12px;">{{ field.desc }}</p>
                        </div>

                        <div class="form-group" ng-if="field.type == 'image_select'">
                            <div class="input-group">
                              <span class="input-group-addon">{{ field.label }}</span>
                              <input
                                ng-model="item[ tab.namespace ][ field.model ]"
                                ng-blur="validate.blur( field, item[tab.namespace])"
                                ng-focus="validate.focus( field, item[tab.namespace])"
                                type="text"
                                class="form-control"
                                placeholder="">
                            </div>
                            <p class="help-block {{ field.model }}-helper" style="height:30px;font-size:12px;">{{ field.desc }}</p>
                        </div>

                    </div>
                </div>

              </div>
            </div>
    <!-- /.tab-content -->
    </div>
        </div>
    </div>
</div>
