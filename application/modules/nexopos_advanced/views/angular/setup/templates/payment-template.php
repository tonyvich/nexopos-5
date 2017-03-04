<div class="row" ng-controller="setupPayment">
    <div class="col-md-8 col-md-offset-2">
        <br>
        <h1 class="text-center" style="font-size:50px;">NexoPOS 4.0</h1>
        <br>
        <div class="box">
            <div class="box-title with-border">
                <p class="box-header text-center"><?php echo __( 'Configuration des paiements & livraisons', 'nexopos_advanced' );?></p>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-xs-12 col-sm-6 col-lg-6">

                        <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon"><?php echo _s( 'Nom', 'nexopos' );?></span>
                              <select ng-model="options[ 'shop_checkout_shipping_status' ]"  type="text" class="form-control" placeholder="" ng-options="">
                              </select>
                            </div>
                            <p class="help-block"><?php echo _s( 'Activez ou non les livraisons', 'nexopos' );?></p>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon"><?php echo _s( 'Email', 'nexopos' );?></span>
                              <input ng-model="options[ 'shop_email' ]"  type="text" class="form-control" placeholder="">
                            </div>
                            <p class="help-block"><?php echo _s( 'Veuillez spécifier un email.', 'nexopos' );?></p>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon"><?php echo _s( 'Impression automatique', 'nexopos' );?></span>
                              <select ng-model="options[ 'shop_checkout_autoprint' ]"  type="text" class="form-control" placeholder="">
                                  <option value="yes"><?php echo _s( 'Oui', 'nexopos' );?></option>
                                  <option value="no"><?php echo _s( 'Non', 'nexopos' );?></option>
                              </select>
                            </div>
                            <p class="help-block"><?php echo __( 'Permet d\'activer l\'impression automatique des factures.', 'nexopos' );?></p>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon"><?php echo _s( 'Téléphone', 'nexopos' );?></span>
                              <input ng-model="options[ 'shop_phone' ]"  type="text" class="form-control" placeholder="">
                            </div>
                            <p class="help-block"><?php echo _s( 'Permet de définir le numéro de téléphone.', 'nexopos' );?></p>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon"><?php echo _s( 'Pays', 'nexopos' );?></span>
                              <input ng-model="options[ 'shop_country' ]"  type="text" class="form-control" placeholder="">
                            </div>
                            <p class="help-block"><?php echo _s( 'Permet de définir le lieu où se trouve la boutique.', 'nexopos' );?></p>
                        </div>


                    </div>
                    <div class="col-md-6 col-xs-12 col-sm-6 col-lg-6">

                        <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon"><?php echo _s( 'Devise', 'nexopos' );?></span>
                              <input ng-model="options[ 'shop_currency_iso' ]"  type="text" class="form-control" placeholder="">
                            </div>
                            <p class="help-block"><?php echo _s( 'Veuillez fournir le code ISO de votre devise. exemple : EUR', 'nexopos' );?></p>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon"><?php echo _s( 'Position de la devise', 'nexopos' );?></span>
                              <select ng-model="options[ 'shop_currency_position' ]" class="form-control" placeholder="">
                                  <option value="before"><?php echo __( 'Avant', 'nexopos' );?></option>
                                  <option value="after"><?php echo __( 'Après', 'nexopos' );?></option>
                              </select>
                            </div>
                            <p class="help-block"><?php echo _s( 'Définissez où afficher la devise dans une somme affichée.', 'nexopos' );?></p>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon"><?php echo _s( 'Nombre de décimal', 'nexopos' );?></span>
                              <input ng-model="options[ 'shop_decimal_limit' ]"  type="text" class="form-control" placeholder="">
                            </div>
                            <p class="help-block"><?php echo _s( 'Permet de déterminer le nombre de qui après la virgule sur une valeur décimale.', 'nexopos' );?></p>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon"><?php echo _s( 'Séparateur de centaines', 'nexopos' );?></span>
                              <input ng-model="options[ 'shop_decimal_thousand_divider' ]"  type="text" class="form-control" placeholder="">
                            </div>
                            <p class="help-block"><?php echo _s( 'Sympbole qui sépare des centaines dans une valeur numérique.', 'nexopos' );?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <?php
                $module     =   Modules::get( 'nexopos_advanced' );
                ?>
                <small class="pull-left" style="line-height:30px;"><?php echo sprintf( __( 'NexoPOS %s', 'nexopos_advanced' ), $module[ 'application' ][ 'version' ] );?></small>

                <div class="btn-group btn-group-sm pull-right">
                    <button ng-click="goto( '/setup/payments' )" class="btn btn-primary "><?php echo __( 'Suivant', 'nexopos' );?></button>
                </div>
            </div>
        </div>
    </div>
</div>
