//start up like this: PORT=3000 node src/socket.js

let server = require('http').Server();
let io = require('socket.io')(server);
let Redis = require('ioredis');
let redis = new Redis();
const PORT = process.env.PORT || 3000;

console.log('Listening on Port ' + PORT);

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

server.listen(PORT);
