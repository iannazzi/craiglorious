$(function() {
    setInterval(function checkSession() {

        client({ path: '/validate_token'}).then(
            function (response) {
            },
            function (response, status) {
                console.log('error validating token');
                console.log(response);
//                    if (_.contains([401, 500], status)) {
//                    }
            });



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
