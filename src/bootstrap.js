//some things may need to be turned off for debugging......
window.verify_timer_flag = false;
window.last_page_accessed_flag = false;
window.user_input_flag = false;

window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

window.firstBy = require('thenby');
window.JsUri = require('jsuri');


//these are for full calendar
window.moment = require('moment');
window.fullcalendar = require('fullcalendar');


import Vue from 'vue';
import VueRouter from 'vue-router';

// import Echo from "laravel-echo";
// window.Echo = new Echo({
//     broadcaster: 'socket.io',
//     host: window.location.hostname + ':3000'
// });
// Echo.channel('test-channel')
//     .listen('UserSignedUp', (e) => {
//         console.log(e);
//     });
//var io = require('socket.io')(80);
// var io = require('socket.io')("http://homestead.test:3000");
import io from 'socket.io-client'
var socket = io('http://homestead.test:3000');
socket.on('UserSignedUp', function(message) {
    console.log(message);
})


socket.on('news', function(message) {
    console.log(message);
})

$(document).ready(

)

// var io = require('socket.io')();
// io.on('connection', function(client){});
// io.listen(3000);

// io.on('connection', function(client){});
// io.listen(3000);
// var io = require('socket.io')()
// var socket = io('http://192.168.10.10:3000');
//window.socket = io();


window.Vue = Vue;
Vue.use(VueRouter);



