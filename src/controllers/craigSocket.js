export class craigSocket {

    constructor() {
        console.log('constructed....')
        this.craigsockettimer = null;
        this.verifyTimer = null;

    }

    startCS() {
        //this is a clock that will basically keep a user logged in forever.... not quite what I wanted....

        //instead of a clock, communicate with the server upon user input

        //if the user is making requests to the server, keep refreshing the token

        //set a timer between input... if that timer reaches the expiration then this 'tab' is done
        console.log('starting craig socket');
        this.craigsockettimer = setInterval(function () {
            //verify token do not refresh
            getData({
                method: 'get',
                url: '/verify',
                entity: false,
                onSuccess(response) {
                    // console.log('from craig socket')
                    // console.log(response);

                    //double check that there is a token there, a user on a different tab could have clicked logout while transmitting....

                    if (localStorage.getItem('jwt-token') === null) {
                        //got logged out from a different tab
                        // console.log('token deleted from storage before we got back....');
                        // console.log(response);
                        // bus.$emit('userHasLoggedOut');
                    }
                    else {
                        //do not refresh the token
                    }

                },
                onError(response){
                    console.log('from craig socket: unable to connect to server to verify');
                    console.log(response);
                    bus.$emit('userHasLoggedOut');
                }
            })

        }, 3000); // every 100 seconds
    }

    stopCS() {
        console.log('stopping craig socket');
        clearInterval(this.craigsockettimer);

    }

    verifyTimerStart() {
        console.log('starting verify timer');
        this.verifyTimer = setInterval(function () {
            //verify token do not refresh
            getData({
                method: 'get',
                url: '/verify',
                entity: false,
                onSuccess(response) {
                    // console.log('from verify timer')
                    // console.log(response);

                    //double check that there is a token there, a user on a different tab could have clicked logout while transmitting....

                    if (localStorage.getItem('jwt-token') === null) {
                        //got logged out from a different tab
                        // console.log('token deleted from storage before we got back....');
                        // console.log(response);
                        // bus.$emit('userHasLoggedOut');
                    }
                    else {
                        //do not refresh the token
                    }

                },
                onError(response){
                    console.log('from verify timer: you got logged out');
                    //console.log(response);
                    bus.$emit('userHasLoggedOut');
                }
            })

        }, craiglorious.craigsocket_timer); // every 100 seconds
    }

    verifyTimerStop() {
        console.log('stopping verify timer');
        clearInterval(this.verifyTimer);

    }

}