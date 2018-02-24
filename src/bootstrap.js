//create an object on the window to store app data
window.craiglorious = {};

craiglorious.host = window.location.hostname;
console.log('Welcome to Craiglorious bootstrapper.... ');

if(craiglorious.host == 'craiglorious.com' || craiglorious.host == 'www.craiglorious.com') {
    craiglorious.env = 'production';
    craiglorious.socketPort = 3002;
    craiglorious.socketUrl = "https://craiglorious.com:3002"
    craiglorious.PUSHER_KEY='c8661dd3efcddb87bf1a';

}
else  if (craiglorious.host == 'staging.craiglorious.com')
{
    craiglorious.env = 'staging';
    craiglorious.socketPort = 3001;
    craiglorious.socketUrl = "https://staging.craiglorious.com:3001"
    craiglorious.PUSHER_KEY='b85b048fe51e53e7c20c';

}
else if (craiglorious.host == 'homestead.test'){
    craiglorious.env = 'development';
    craiglorious.socketPort = 3000;
    craiglorious.socketUrl = "http://homestead.test:3000"
    craiglorious.PUSHER_KEY='b4c3b3f485a9ab4684a8';
}
else{
    console.error(craiglorious.host + ' Host does not match any expected ... check bootstrap.js file')
}
console.log('Listening to socket on port ' + craiglorious.socketPort);
console.log('Environment.... ' + craiglorious.env);
console.log('############################################################');


//some things may need to be turned off for debugging......

window.verify_timer_flag = false;
window.last_page_accessed_flag = false;
window.user_input_flag = false;

window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

//these are for modifying the url and sorting the table
window.firstBy = require('thenby');
window.JsUri = require('jsuri');
//these are for full calendar
window.moment = require('moment');
window.fullcalendar = require('fullcalendar');


import Vue from 'vue';
import VueRouter from 'vue-router';

// import io from 'socket.io-client'
// console.log(location.protocol + '://' + craiglorious.host + ':' + craiglorious.socketPort);
// // var socket = io(location.protocol + '://' + craiglorious.host + ':' + craiglorious.socketPort);
//
// var socket = io(craiglorious.socketUrl);
//
// socket.on('test-channel:UserSignedUp', function(message) {
//     console.log(message);
// })
// socket.on('test-channel:Lover', function(message) {
//     console.log(message);
// })
//
// socket.on('news', function(message) {
//     console.log(message);
// })

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher(craiglorious.PUSHER_KEY, {
    cluster: 'us2',
    encrypted: true
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
    alert(data.message);
});




window.Vue = Vue;
Vue.use(VueRouter);



