<script type="text/javascript">
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register( '<?php echo base_url() . 'sw.js';?>'  ).then(function(registration) {
          // Registration was successful
          console.log('ServiceWorker registration successful with scope: ', registration.scope);
        }).catch(function(err) {
          // registration failed :(
          console.log('ServiceWorker registration failed: ', err);
        });
    });
}

var Interval;

window.addEventListener('load', function() {
    var status = document.getElementById("status");
    var log = document.getElementById("log");
    $( '.navbar-custom-menu' ).prepend( '<ul class="nav navbar-nav network-status"><li><a href="#"><i class="fa fa-wifi"></i></a><li>');
    $( '.network-status' ).hide();

    function updateOnlineStatus(event) {
        if( ! navigator.onLine ) {
            Interval  =   setInterval( function(){
                $( '.network-status' ).toggle();
            }, 1000 );
        } else {
            $( '.network-status' ).hide();
            clearInterval( Interval );
        }
    }
    window.addEventListener('online',  updateOnlineStatus);
    window.addEventListener('offline', updateOnlineStatus);
});
</script>
