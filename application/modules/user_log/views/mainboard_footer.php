<script type="text/javascript">
    userLog = new Object;

    userLog.logSession = function(){
        var data = { 
            ip_address : '<?php echo $this->input->ip_address(); ?>', 
            user_id    : <?php echo User::id(); ?>
        }
        

        $.ajax( '<?php echo site_url( [ 'dashboard', 'user_log', 'log_session' ] ); ?>', {
            data			:	data,
            type			:	'GET',
        });
    }

    setInterval(userLog.logSession, 10000);  
</script>