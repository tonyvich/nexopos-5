<div class="row" ng-controller="setupDemo">
    <div class="col-md-8 col-md-offset-2">
        <br>
        <h1 class="text-center" style="font-size:50px;">NexoPOS 4.0</h1>
        <br>
        <div class="box">
            <div class="box-title with-border">
                <p class="box-header text-center"><?php echo __( 'Assistant de configuration', 'nexopos_advanced' );?></p>
            </div>
            <div class="box-body">
                
            </div>
            <div class="box-footer">
                <?php
                $module     =   Modules::get( 'nexopos_advanced' );
                ?>
                <small class="pull-left"><?php echo sprintf( __( 'NexoPOS %s', 'nexopos_advanced' ), $module[ 'application' ][ 'version' ] );?></small>
            </div>
        </div>
    </div>
</div>
