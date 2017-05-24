<div class="row" ng-controller="userLogStatsController">
    
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
                <div>
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
                <div>
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
    
    <div class="col-md-8">
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