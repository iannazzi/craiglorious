// //start up like this: APP=staging node src/socket.js APP=production node src/socket.js

let server = require('http').Server();
let io = require('socket.io')(server);
let Redis = require('ioredis');

let socket_port = 3000;
let redis_port = 6879;

if (process.env.APP == 'staging')
{
    socket_port = 3001;
    redis_port = 6879;
}
else if (process.env.APP == 'production'){
    socket_port = 3002;
    redis_port = 6880;
}

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

