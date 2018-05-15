//create an object on the window to store app data
window.craiglorious = {};

craiglorious.host = window.location.hostname;
console.log('Welcome to Craiglorious bootstrapper.... ');

if(craiglorious.host == 'craiglorious.com' || craiglorious.host == 'www.craiglorious.com') {
    craiglorious.env = 'production';
    craiglorious.pusherCluster = 'us2';
    craiglorious.PUSHER_KEY='c8661dd3efcddb87bf1a';
}
else  if (craiglorious.host == 'staging.craiglorious.com')
{
    craiglorious.env = 'staging';
    craiglorious.PUSHER_KEY='b85b048fe51e53e7c20c';
    craiglorious.pusherCluster = 'us2';
}
else if (craiglorious.host == 'homestead.test'){
    craiglorious.env = 'development';
    craiglorious.PUSHER_KEY='b4c3b3f485a9ab4684a8';
    craiglorious.pusherCluster = 'us2';
}
else{
    console.error(craiglorious.host + ' Host does not match any expected ... check bootstrap.js file')
}
console.log('Environment.... ' + craiglorious.env);
console.log('############################################################');


//this is the polling socket... checking for other login....
craiglorious.craigsocket = true;
craiglorious.craigsocket_timer = 60000;

craiglorious.last_page_accessed_flag = false;

craiglorious.autosave = true;
craiglorious.autosave_timer = 30000;
// craiglorious.AwesomeTable = require('@iannazzi/awesome-table');
// console.log(craiglorious.AwesomeTable);


window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

//these are for modifying the url and sorting the table
//window.firstBy = require('thenby');
window.JsUri = require('jsuri');
//these are for full calendar
window.moment = require('moment');
window.fullcalendar = require('fullcalendar');


import Vue from 'vue';
import VueRouter from 'vue-router';

// Enable pusher logging - don't include this in production

Pusher.logToConsole = true;

craiglorious.pusher = new Pusher(craiglorious.PUSHER_KEY, {
    cluster: craiglorious.pusherCluster,
    encrypted: true
});



let channel = craiglorious.pusher.subscribe('global');
channel.bind('my-event', function(data) {
    alert(data.message);
});

window.Vue = Vue;
Vue.use(VueRouter);
