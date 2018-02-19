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


import io from 'socket.io-client'
var socket = io('http://homestead.test:3000');


socket.on('test-channel:UserSignedUp', function(message) {
    console.log(message);
})
socket.on('test-channel:Lover', function(message) {
    console.log(message);
})

socket.on('news', function(message) {
    console.log(message);
})




window.Vue = Vue;
Vue.use(VueRouter);



