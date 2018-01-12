$(function () {
    setInterval(function checkSession() {
        console.log('do it...');
        getData({
            method: 'get',
            url: '/validate_token',
            entity: false,
            onSuccess(response) {
            },
            onError(response){
                console.log(response);
                self.destroyLogin();
            }
        })

    }, 1000); // every 100 seconds
});