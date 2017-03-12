<div class="row" ng-controller="setupWelcome">
    <div class="col-md-8 col-md-offset-2">
        <br>
        <h1 class="text-center" style="font-size:50px;">NexoPOS 4.0</h1>
        <br>
        <div class="box">
            <div class="box-title with-border">
                <p class="box-header text-center"><?php echo __( 'Type de boutique', 'nexopos_advanced' );?></p>
            </div>
            <div class="box-body">
                <p class="text-center"><?php echo __( 'Bienvenue dans le guide de configuration de NexoPOS. Nous allons vous aider à configurer rapidement NexoPOS en quelques étapes. Pour commencer, veuillez choisir à quel type appartient votre boutique actuelle.', 'nexopos_advanced' );?></p>
                <div class="input-group">
                  <span class="input-group-addon"><?php echo __( 'Type de la boutique', 'nexopos_advanced' );?></span>
                  <select ng-model="options[ 'shop_type' ]" type="text" class="form-control" placeholder="">
                      <option value=""><?php echo __( 'Veuillez choisir une réponse', 'nexopos_advanced' );?></option>
                      <option ng-repeat="type in siteType" value="{{ type.namespace }}">{{ type.label }}</option>
                  </select>
                </div>
                <div class="row">
                    <div class="text-center col-md-4 col-md-offset-4">
                        <div class="btn-group-justified">
                            <div class="btn-group" role="group">
                                <button ng-click="goto( '/setup/details' )" type="button" style="margin-top:10px;" class="btn btn-primary"><?php echo __( 'Continuer', 'nexopos_advanced' );?></button>
                            </div>
                        </div>
                    </div>
                </div>
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
