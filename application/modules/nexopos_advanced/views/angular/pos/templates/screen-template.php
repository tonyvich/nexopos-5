<div class="row nexopos-ui" ng-controller="posScreenCTRL">
    <div class="col-md-6 col-lg-6 col-sm-6 nexopos-cart">
        <div class="box" ng-style="{ height : pageHeight, marginBottom : 0 }">
            <div class="box-header nexopos-cart-header">
                <div class="input-group">
                  <span class="input-group-addon"></span>
                  <input type="text" class="form-control" placeholder="">

                </div>
            </div>
            <div class="box-body nexopos-cart-body" ng-style="{ height : get( 'height', 'nexopos-cart-body' ), padding : 0 }">
                <table class="table table-bordered nexopos-cart-table-header" ng-style="{ border : 'solid 0px transparent'}">
                    <thead>
                        <tr class="active">
                            <td ng-style="{ width : tableWidth[ 'itemName' ] }" class="text-center"><?php echo __( 'Produit', 'nexopos_advanced' );?></td>
                            <td ng-style="{ width : tableWidth[ 'itemPrice' ] }" class="text-center"><?php echo __( 'Prix', 'nexopos_advanced' );?></td>
                            <td ng-style="{ width : tableWidth[ 'itemDiscount' ] }" class="text-center"><?php echo __( 'Remise', 'nexopos_advanced' );?></td>
                            <td ng-style="{ width : tableWidth[ 'itemQte' ] }" class="text-center"><?php echo __( 'Quantité', 'nexopos_advanced' );?></td>
                            <td ng-style="{ width : tableWidth[ 'itemTotal' ] }" class="text-left"><?php echo __( 'Total', 'nexopos_advanced' );?></td>
                        </tr>
                    </thead>
                </table>
                <div
                    class="nexopos-cart-table-content"
                    ng-style="{ height : get( 'height', 'nexopos-cart-table-content' ) }"
                    ng-scrollbars ng-scrollbars-config="scrollTableContentConfig"
                    >
                    <table class="table" ng-style="{ border : 'solid 0px transparent', marginBottom : 0 }">
                        <tbody>
                            <tr ng-repeat="cartItem in cartItems">
                                <td ng-style="{ width : tableWidth[ 'itemName' ] }">
                                    <a class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>
                                    <?php echo __( 'Something', 'nexopos_advanced' );?>
                                </td>
                                <td
                                    class="text-center"
                                    ng-style="{ width : tableWidth[ 'itemPrice' ], lineHeight : '30px' }">
                                    10.000
                                </td>

                                <td
                                    class="text-center"
                                    ng-style="{ width : tableWidth[ 'itemDiscount' ], lineHeight : '30px' }">
                                    10.000
                                </td>

                                <td
                                    class="text-center"
                                    ng-style="{ width : tableWidth[ 'itemQte' ], lineHeight : '30px' }">
                                    <div class="input-group input-group-sm">
                                      <input type="text" class="form-control">
                                    </div>
                                </td>

                                <td
                                    class="text-left"
                                    ng-style="{ width : tableWidth[ 'itemTotal' ], lineHeight : '30px' }">
                                    10.000
                                </td>
                            </tr>
                            <tr ng-show="cartItems.length == 0 || isUndefined( cartItems )">
                                <td colspan="5" class="text-center"><?php echo __( 'Aucun élément dans le panier. Veuillez ajouter des produits.', 'nexopos_advanced' );?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <table class="table table-bordered nexopos-cart-table-details" ng-style="{ background : '#F5F5F5' }">
                    <tr>
                        <td width="130" class="text-right"><strong><?php echo __( 'TVA', 'nexopos_advanced' );?></strong></td>
                        <td></td>
                        <td width="130" class="text-right"><strong><?php echo __( 'Sous Total', 'nexopos_advanced' );?></strong></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="130" class="text-right"><strong><?php echo __( 'Remise', 'nexopos_advanced' );?></strong></td>
                        <td></td>
                        <td width="130" class="text-right"><strong><?php echo __( 'Total', 'nexopos_advanced' );?></strong></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="box-footer nexopos-cart-footer">
                <div class="btn-group btn-group-lg btn-group-justified" role="group">
                    <div class="btn-group btn-group-lg" role="group">
                        <button type="button" class="btn btn-default">Left</button>
                    </div>
                    <div class="btn-group btn-group-lg" role="group">
                        <button type="button" class="btn btn-default">Left</button>
                    </div>
                    <div class="btn-group btn-group-lg" role="group">
                        <button type="button" class="btn btn-default">Left</button>
                    </div>
                    <div class="btn-group btn-group-lg" role="group">
                        <button type="button" class="btn btn-default">Left</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-sm-6 nexopos-grid">
        <div class="box" ng-style="{ height : pageHeight, marginBottom : 0 }">

        </div>
    </div>
    <!-- <div class="col-md-6 col-lg-6 col-sm-6 nexopos-checkout">
        <div class="box" ng-style="{ height : pageHeight, marginBottom : 0 }">

        </div>
    </div> -->
</div>
<style media="screen">
.nexopos-cart-footer .btn-group>.btn:first-child:not(.dropdown-toggle), .btn-group>.btn:last-child {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.nexopos-cart-footer {
    height:60px;
}

.nexopos-cart-footer .btn-group>.btn:first-child {
    border:solid 1px transparent;
}

.nexopos-cart-footer .btn {
    border: solid 1px #FEFEFE;
    border-top: solid 1px transparent;
}

.nexopos-cart-footer .btn-default {
    background: #FEFEFE;
}

.nexopos-cart-footer .btn-default:hover {
    background: #FAFAFA;
}

.nexopos-cart-footer .btn-group-lg>.btn, .btn-lg {
    padding: 10px 16px;
    font-size: 18px;
    line-height: 35px;
}

.nexopos-cart-table-content {
    border-bottom: 1px solid #e8e7e7;
}

.nexopos-cart-body {
    border-top: 1px solid #e8e7e7;
}

.nexopos-cart-footer, nexopos-cart-details {
    padding: 0px;
    border-top: solid 1px #e8e7e7;
}

.nexopos-cart-table-header thead tr.active {
    border-top: solid 1px #eaeaea;
}

.nexopos-ui .box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 1px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1.5px 1.5px rgba(0,0,0,0.1);
    overflow: hidden;
}

.btn {
    border-radius: 3px;
    -webkit-box-shadow: none;
    box-shadow: 0px 1px 0px 0px #c1c0c0;
}
</style>
