<div class="row" ng-controller="userLogStatsController">
    
    <!-- first row: User actions and user global stats -->

    <div class="col-md-12">

        <!-- Users actions -->
        <div class="col-md-8">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title">
                        <?php echo __('Actions', 'perm_manager' );?>
                    </div>
                    <div class="box-tools">
                        
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon"> <?php echo __( 'Utilisateur', 'perm_manager' );?> </span>
                                <select
                                class="form-control"
                                ng-model = "selectedUser"
                                ng-change= "changeSelectedUser()";
                                >
                                    <option ng-repeat="user in users" value="{{ user.name }}">{{ user.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top : 10px; margin-bottom: 10px;">
                            <label class="checkbox-inline">
                                <input type="radio" ng-change="changeSelectedScope()" ng-model="actionTableScope" value="current_month" checked> <?php echo __("Mois en cours","user_log");?> 
                            </label> 
                            <label class="checkbox-inline">
                                <input type="radio" ng-change="changeSelectedScope()" ng-model="actionTableScope" value="current_year"> <?php echo __("Année en cours","user_log");?>    
                            </label>
                            <label class="checkbox-inline">
                                <input type="radio" ng-change="changeSelectedScope()" ng-model="actionTableScope" value="all_actions"> <?php echo __("Tout afficher","user_log");?>    
                            </label> 
                        </div>
                        <diV class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo __('Action','user_log'); ?></th>
                                        <th><?php echo __('Date','user_log'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="action in displayAction" >
                                        <td><h5>{{ action.action }}</h5></td>
                                        <td><h5>{{ action.date_action }}</h5></td>
                                    </tr>
                                </tbody>
                            </table>
                        </diV> 
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Global stats -->
        <div class="col-md-4">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title">
                        <?php echo __( 'Statistiques globales', 'perm_manager' );?>
                    </div>
                    <div class="box-tools">
                    
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-addon"> <?php echo __( 'Utilisateur', 'perm_manager' );?> </span>
                            <select
                            class="form-control"
                            ng-model = "selectedUser"
                            ng-change= "changeSelectedUser()";
                            >
                                <option ng-repeat="user in users" value="{{ user.name }}">{{ user.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <strong><?php echo __("Total d'heures","user_log"); ?></strong> : {{ currentUserStats.total_session_hours }} <br><br>
                        <strong><?php echo __("Nombre total de sessions","user_log"); ?></strong> : {{ currentUserStats.total_session_numbers }} <br><br>
                        <strong><?php echo __("Première connexion","user_log"); ?></strong> : {{ currentUserStats.first_connect }} <br><br>
                        <strong><?php echo __("Dernière connexion","user_log"); ?></strong> : {{ currentUserStats.last_connect }} <br><br>
                        <strong><?php echo __("Dernière déconnexion","user_log"); ?></strong> : {{ currentUserStats.last_disconnect }} <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End first row -->

    <!-- Second row User hours in a charts -->
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title">
                        <?php echo __( ' Durée de connexion des utilisateurs par année', 'perm_manager' );?>
                    </div>
                    <div class="box-tools">
                    
                    </div>
                </div>
                <div class="box-body">
                    <canvas 
                        id="bar" 
                        class="chart chart-bar"
                        chart-data="hoursPerUsers" 
                        chart-labels="monthsLabels" 
                        chart-series="usersName"
                        chart-options="barOptions"
                        width = "90%"
                    >
                    </canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- End second row-->

</div>