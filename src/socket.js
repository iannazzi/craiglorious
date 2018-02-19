var server = require('http').Server();
var io = require('socket.io')(server);
var Redis = require('ioredis');
var redis = new Redis();

redis.subscribe('test-channel');

redis.on('message', function(channel, message){
    console.log('message received')
    console.log(message);
    console.log('on channel');
    console.log(channel+':'+message.event);
    io.emit(channel+':'+message.event,message.data);
    io.emit('news', { hello: 'world' });



})

server.listen(3000);
