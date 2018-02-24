// //start up like this: APP=staging node src/socket.js APP=production node src/socket.js APP=development node src/socket.js
// php artisan zz:testBroadcast
//might need to kill an old server....
//ps aux | grep node
//kill -9 {PID}
// or who is using the port
// sudo lsof -i :3000

//https crap...might only be good for 365>
//openssl genrsa 1024 > file.pem
//openssl req -new -key file.pem -out csr.pem
//openssl x509 -req -days 365 -in csr.pem -signkey file.pem -out file.crt



let socket_port = 3000;
let redis_port = 6379;

if (process.env.APP == 'staging')
{
    socket_port = 3001;
    redis_port = 6379;
    // let fs = require('fs');
    // let https = require('https');
    //
    // let options = {
    //     key: fs.readFileSync('/var/www/craiglorious.com/data/file.pem'),
    //     cert: fs.readFileSync('/var/www/craiglorious.com/data/file.crt')
    // };
    //
    //
    // let server = https.createServer(options, app);
}
else if (process.env.APP == 'production'){
    socket_port = 3002;
    redis_port = 6380;
}
else
{

}




let server = require('http').Server();
let io = require('socket.io')(server);
let Redis = require('ioredis');

let redis = new Redis(redis_port);

console.log('Listening on Port ' + socket_port);

redis.subscribe('test-channel');

redis.on('message', function(channel, message){
    console.log('message received')
    console.log(message);
    message = JSON.parse(message);
    console.log('on channel');
    console.log(channel +':'+ message.event);
    io.emit(channel +':'+ message.event,message.data);
    io.emit('news', { hello: 'world' });
})

server.listen(socket_port);

