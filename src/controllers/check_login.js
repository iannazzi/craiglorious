/**
 * Created by embrasse-moi on 2/4/17.
 */

$(function() {
    setInterval(function checkSession() {
        $.get('/check-session', function(data) {
            // if session was expired
            if (data.guest) {
                // redirect to login page
                // location.assign('/auth/login');

                // or, may be better, just reload page
                location.reload();
            }
        });
    }, 60000); // every minute
});