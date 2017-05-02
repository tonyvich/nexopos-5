<div class="row" ng-controller="items">
    <div class="col-md-10 col-lg-10 col-md-12 col-xs-12 col-md-offset-1 col-lg-offset-1">
        <div class="row">
            <h3 class="text-center"><?php echo _s( 'Quels type de produit souhaitez-vous créer ?', 'nexopos_advanced' );?></h3>
            <br>
            <div class="col-md-4 col-xs-6 col-lg-3" ng-repeat="item in itemsTypes">
                <div class="box">
                    <div ng-click="selectType( 'items/add/' + item.namespace )" class="box-content text-center" style="height:210px;">
                        <br>
                        <img ng-src="{{ getIcon( item.icon ) }}.png" alt="{{ item.text }}">
                        <h4 class="text-center">{{ item.text }}</h4>
                        <p class="text-center" style="padding:10px;">{{ item.desc }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
