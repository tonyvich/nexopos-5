<div class="row" ng-controller="userLogLogController">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="row">
                    <!-- Search input -->
                    <div class="col-md-6">
                        <div class="input-group">
                        <input ng-model="searchModel" placeholder="<?php echo _s( 'Rechercher', 'user_log' );?>" type="text" class="form-control">
                        <div class="input-group-btn">
                            <button ng-click="search()" type="button" name="button" class="btn btn-primary" alt="<?php echo _s( 'Rechercher', 'nexopos_advanced' );?>"><i class="fa fa-search"></i></button>
                            <button ng-click="get()" type="button" name="button" class="btn btn-default" alt="<?php echo _s( 'Annuler', 'nexopos_advanced' );?>"><i class="fa fa-remove"></i></button>
                        </div>
                        </div>
                    </div>
                    <!-- End Search input -->
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon"> <?php echo __( 'Utilisateur', 'perm_manager' );?> </span>
                            <select
                            class="form-control"
                            ng-model = "selectedUser"
                            ng-change = "get()";
                            >
                                <option ng-repeat="user in users" value="{{ user.id }}">{{ user.name }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body no-padding">
                <!-- Log Table display -->
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="margin-bottom:-1px;">
                            <thead>
                                <tr class="active">
                                    <td ng-repeat="col in columns" width="{{ col.width }}" ng-click="order( col.namespace )">

                                        <strong>{{ col.text }}</strong>

                                        <span
                                            ng-show="order_type == 'desc' && col.namespace == order_by" class="fa fa-long-arrow-up pull-right">
                                        </span>

                                        <span
                                            ng-show="order_type == 'asc' && col.namespace == table.order_by" class="fa fa-long-arrow-down pull-right">
                                        </span>

                                    </td>
                                </tr>
                            </thead>
                            <tbody>

                                <tr ng-repeat="entry in entries">
                                    <td ng-repeat="col in columns" style="line-height: 30px;" title="{{ entry[ col.namespace ] }}">
                                        {{
                                            entry[ col.namespace ]
                                        }}
                                    </td>
                                </tr>

                                <!-- In case of no entries -->
                                <tr ng-show="entries.length == 0">
                                    <td class="text-center"><?php echo __( 'Aucune entrée à afficher', 'user_log' );?></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Log Table display -->
            </div>

            <div class="box-footer">
                <div class="row">
                    <!-- Select number of rows displayed -->
                    <div class="col-md-3">
                        <div class="input-group">
                        <span class="input-group-addon"><?php echo __( 'Nombre de lignes', 'nexopos_advanced' );?></span>
                        <select ng-change="order()" type="text" ng-model="limit" class="form-control" placeholder="">
                            <option ng-repeat="nbr in pageNumRows" value="{{ nbr }}">{{ nbr }}</option>
                        </select>
                        </div>
                    </div>
                    <!-- End Select number of rows displayed -->

                    <!-- Pagination -->
                    <div class="col-md-9">
                        <ul class="pagination pull-right" style="margin:0px;">
                            <li ng-class="{disabled: currentPage === 1}">
                                <a ng-click="getPage( 1 )" href="javascript:void(0)"><?php echo __( 'Premier', 'nexopos_advanced' );?></a>
                            </li>
                            <li ng-class="{disabled: currentPage === 1}">
                                <a href="javascript:void(0)" ng-click="get( currentPage - 1)"><?php echo __( 'Précédent', 'nexopos_advanced' );?></a>
                            </li>

                            <li ng-repeat="( page, v ) in __getNumber( pages ) track by $index" ng-class="{active: currentPage === page }">
                                <a href="javascript:void(0)" ng-click="getPage( v )">{{ page + 1 }} </a>
                            </li>

                            <li ng-class="{disabled: currentPage === pages }">
                                <a ng-click="getPage( currentPage + 1)" href="javascript:void(0)"><?php echo __( 'Suivant', 'nexopos_advanced' );?></a>
                            </li>
                            <li ng-class="{disabled: currentPage === pages }">
                                <a ng-click="getPage( pages )" href="javascript:void(0)"><?php echo __( 'Dernier', 'nexopos_advanced' );?></a>
                            </li>
                        </ul>
                    </div>
                    <!-- End pagination -->
                </div>
            </div>
        </div>
    </div>
</div>