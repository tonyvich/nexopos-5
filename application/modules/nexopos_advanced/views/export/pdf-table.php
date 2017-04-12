<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo base_url() . '/public/bootstrap.min.css';?>">
        <title></title>
    </head>
    <body>
        <h3 class="text-center"><?php echo $name;?></h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <?php foreach( $headers as $header ):?>
                        <td><?php echo $header[ 'text' ];?></td>
                    <?php endforeach;?>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $data as $entry ):?>
                    <tr>
                        <?php foreach( $headers as $header ):?>
                        <td><?php echo $entry[ $header[ 'namespace' ] ];?></td>
                        <?php endforeach;?>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <style media="screen">
            <?php $this->load->module_view( 'nexopos_advanced', 'style.bootstrap' );?>
        </style>
    </body>
</html>
