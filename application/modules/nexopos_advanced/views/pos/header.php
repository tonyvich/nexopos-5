<!DOCTYPE html>
<html>
  <head>
    <title>Angular QuickStart</title>
    <base href="/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Polyfill(s) for older browsers -->
    <script src="<?php echo module_url( 'nexopos_advanced/ng2' );?>node_modules/core-js/client/shim.min.js"></script>
    <script src="<?php echo module_url( 'nexopos_advanced/ng2' );?>node_modules/core-js/client/shim.min.js"></script>
    <script src="<?php echo module_url( 'nexopos_advanced/ng2' );?>node_modules/zone.js/dist/zone.js"></script>
    <script src="<?php echo module_url( 'nexopos_advanced/ng2' );?>node_modules/systemjs/dist/system.src.js"></script>
    <script src="<?php echo module_url( 'nexopos_advanced/ng2' );?>src/systemjs.config.js"></script>
    <script>
        System.import('main.js').catch( function(err){
            console.error(err);
        });
    </script>
  </head>
