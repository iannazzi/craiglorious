$(function() {
    setInterval(function checkSession() {
        $.get('/check-session', function(data) {
            // if session was expired
            // console.log(data);
            if (data.guest) {
                // redirect to login page
                // location.assign('/auth/login');
                // or, may be better, just reload page
                location.reload();
            }
        });
    }, 10000); // every 10 seconds
});
