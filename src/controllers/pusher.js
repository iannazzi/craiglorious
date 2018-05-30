export class craigPusher {

    startPusher() {
        //Enable pusher logging - don't include this in production

        //this is in the main api.blade.php page
        //<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
        if(craiglorious.env != 'production'){
            Pusher.logToConsole = true;
        }
        craiglorious.pusher = new Pusher(craiglorious.PUSHER_KEY, {
            cluster: craiglorious.pusherCluster,
            encrypted: true
        });

        let channel = craiglorious.pusher.subscribe('global');
        channel.bind('my-event', function (data) {
            alert(data.message);
        });
    }
}
