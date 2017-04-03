<div class="col-md-12">
    <h3 style="margin-top:0px;">{{ textDomain.listTitle }}<a ng-href="{{ textDomain.addNewLink }}" class="btn btn-primary btn-sm pull-right">{{ textDomain.addNew }}</a></h3>
    <div class="box">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-3">
                    <div class="input-group" ng-hide="table.hideSearch">
                      <input ng-model="table.searchModel" placeholder="<?php echo _s( 'Rechercher des données...', 'nexopos_advanced' );?>" type="text" class="form-control" placeholder="">
                      <div class="input-group-btn">
                          <button ng-click="table.search()" type="button" name="button" class="btn btn-primary" alt="<?php echo _s( 'Rechercher', 'nexopos_advanced' );?>"><i class="fa fa-search"></i></button>
                          <button ng-click="table.clear()" type="button" name="button" class="btn btn-default" alt="<?php echo _s( 'Annuler', 'nexopos_advanced' );?>"><i class="fa fa-remove"></i></button>
                      </div>
                    </div>
                </div>
                <div class="col-md-6">

                </div>
                <div class="col-md-3">
                    <div class="btn-group btn-group-justified" ng-hide="table.hideHeaderButtons" role="group" aria-label="...">
                        <div
                        ng-show="
                        ( button.show.singleSelect && table.getChecked().length == 1 ) ||
                        ( button.show.multiSelect && table.getChecked().length > 1 ) ||
                        ( button.show.noSelect && table.getChecked().length == 0 )"
                        ng-repeat="button in table.headerButtons" class="btn-group" role="group">
                            <button type="button" class="btn btn-default" ng-click=" button.toDo() "><i class="{{ button.icon }}"></i> {{ button.text }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-bordered" style="margin-bottom:-1px;">
                    <thead>
                        <tr class="active">
                            <td ng-click="table.toggleAllEntries( table.entries, table.headCheckbox )">
                                <input type="checkbox" class="minimal" ng-model="table.headCheckbox">
                            </td>
                            <!-- Expect col to be an object with following keys : text, namespace, order (for reorder) -->
                            <td ng-repeat="col in table.columns" width="{{ col.width }}" ng-click="table.order( col.namespace )">

                                <strong>{{ col.text }}</strong>

                                <span
                                    ng-show="table.order_type == 'desc' && col.namespace == table.order_by" class="fa fa-long-arrow-up pull-right">
                                </span>

                                <span
                                    ng-show="table.order_type == 'asc' && col.namespace == table.order_by" class="fa fa-long-arrow-down pull-right">
                                </span>

                            </td>

                            <td ng-hide="table.isDisabled( 'entry-actions' )"><strong><?php echo __( 'Actions', 'nexopos_advanced' );?></strong></td>
                        </tr>
                    </thead>
                    <tbody>

                        <tr ng-repeat="entry in table.entries" ng-class="{ 'success' : entry.checked }" ng-click="entry.checked = !entry.checked">
                            <td width="20" ng-click="table.toggleThis( entry )">
                                <input type="checkbox" ng-model="entry.checked" ng-checked="entry.checked"  value="{{ entry.id }}">
                            </td>
                            <td ng-repeat="col in table.columns" style="line-height: 30px;" title="{{ entry[ col.namespace ] }}">
                                {{
                                    table.filter( entry[ col.namespace ], col.is, col)
                                }}
                            </td>
                            <td width="50" ng-hide="table.isDisabled( 'entry-actions' )">
                                <!-- Single button -->
                                <div class="btn-group">
                                  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu right-align">
                                    <li ng-repeat="action in table.entryActions">
                                        <a
                                            ng-if="action.namespace != false"
                                            href="javascript:void(0);"
                                            ng-click="table.submitSingleAction( entry, action )"
                                        >{{ action.name }}</a>
                                    </li>
                                  </ul>
                                </div>
                            </td>
                        </tr>

                        <tr ng-show="table.entries.length == 0">
                            <td class="text-center" colspan="{{
                                table.columns.length + 2 +
                                ( table.isDisabled( 'entry-actions' ) ? 1 : 0 )
                            }}"><?php echo __( 'Aucune entrée à afficher', 'nexopos_advanced' );?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-md-3">
                    <div class="input-group">
                      <select ng-init="table.selectedAction = table.actions[0]" ng-options="action as action.name for action in table.actions track by action.namespace" ng-model="table.selectedAction" class="form-control" aria-label="...">
                      </select>
                      <div class="input-group-btn">
                          <button ng-click="table.submitBulkActions()" class="btn btn-primary">
                              <?php echo _s( 'Executer', 'nexopos_advanced' );?>
                          </button>
                      </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                      <span class="input-group-addon"><?php echo __( 'Element par pages', 'nexopos_advanced' );?></span>
                      <select ng-change="table.order()" type="text" ng-model="table.limit" class="form-control" placeholder="">
                          <option ng-repeat="nbr in [ 10, 20, 40, 60, 100 ]" value="{{ nbr }}">{{ nbr }}</option>
                      </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- ng-class="{disabled: table.currentPage === table.pages }" -->
                    <ul class="pagination pull-right" style="margin:0px;">
                        <li ng-class="{disabled:table.currentPage === 1}">
                            <a ng-click="table.getPage( 1 )"><?php echo __( 'Premier', 'nexopos_advanced' );?></a>
                        </li>
                        <li ng-class="{disabled: table.currentPage === 1}">
                            <a ng-click="table.get( table.currentPage - 1)"><?php echo __( 'Précédent', 'nexopos_advanced' );?></a>
                        </li>

                        <li ng-repeat="( page, v ) in table.__getNumber( table.pages ) track by $index" ng-class="{active:table.currentPage === page}">
                            <a href="javascript:void(0)" ng-click="table.getPage( page )">{{ page + 1 }} </a>
                        </li>

                        <li ng-class="{disabled: table.currentPage === table.pages }">
                            <a click="table.get( table.currentPage + 1)"><?php echo __( 'Suivant', 'nexopos_advanced' );?></a>
                        </li>
                        <li ng-class="{disabled: table.currentPage === table.pages }">
                            <a click="vm.setPage(vm.pager.totalPages)"><?php echo __( 'Dernier', 'nexopos_advanced' );?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
