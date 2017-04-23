<div ng-controller="itemsView">
    <div class="row">
        <div class="col-md-12">
            <h3 style="margin-top:0px;"><?php echo __( 'Détails du produit', 'nexopos_advanced' );?><a href="<?php echo site_url([ 'dashboard', 'nexopos', 'items' ] );?>" class="btn btn-primary btn-sm pull-right"><?php echo __( 'Revenir à la liste des produits', 'nexopos_advanced' );?></a></h3>
        </div>
        <div class="col-md-12">
            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li ng-repeat="tab in tabs" ng-class="{ 'active': tab.active }" ng-click="enableTab( tab )"><a href="javascript:void(0)">{{ tab.title }}</a></li>
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
                <div ng-repeat="tab in tabs" class="tab-pane tab-{{ tab.namespace }}" ng-class="{ 'active': tab.active }">
                    
                </div>
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
    </div>
</div>
