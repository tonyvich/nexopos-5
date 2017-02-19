<div class="col-md-12">
    <h3 style="margin-top:0px;">{{ crud.listTitle }}<a ng-href="{{ crud.addNewLink }}" class="btn btn-primary btn-sm pull-right">{{ crud.addNew }}</a></h3>
    <div class="box">
        <div class="box-header">
            <span class="box-title">{{ crud.listTitle }}</span>
        </div>
        <table class="table table-bordered" style="margin-bottom:-1px;">
            <thead>
                <tr>
                    <!-- Expect col to be an object with following keys : text, namespace, order (for reorder) -->
                    <td ng-repeat="col in table.columns" ng-click="table.order( col.namespace )">
                        {{ col.text }}

                        <span
                            ng-show="table.order_type == 'desc' && col.namespace == table.order_by" class="fa fa-long-arrow-up pull-right">
                        </span>

                        <span
                            ng-show="table.order_type == 'asc' && col.namespace == table.order_by" class="fa fa-long-arrow-down pull-right">
                        </span>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="entry in table.entries">
                    <td ng-repeat="col in table.columns">{{ entry[ col.namespace ] }}</td>
                </tr>

                <tr ng-show="table.entries.length == 0">
                    <td class="text-center" colspan="{{ table.columns.length }}"><?php echo __( 'Aucune entrée à afficher', 'nexopos_advanced' );?></td>
                </tr>
            </tbody>
        </table>

        <div class="box-footer">
            <div class="row">
                <div class="col-md-3">
                    <div class="input-group">
                      <span class="input-group-addon"><?php echo __( 'Element par pages', 'nexopos_advanced' );?></span>
                      <select ng-change="table.order()" type="text" ng-model="table.limit" class="form-control" placeholder="">
                          <option ng-repeat="nbr in [ 10, 20, 40, 60, 100 ]" value="{{ nbr }}">{{ nbr }}</option>
                      </select>
                    </div>
                </div>
                <div class="col-md-3">

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
