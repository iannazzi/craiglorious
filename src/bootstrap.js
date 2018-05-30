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


//not sure we are usig lodash
window._ = require('lodash');

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');


//these are for full calendar
window.moment = require('moment');
window.fullcalendar = require('fullcalendar');


import Vue from 'vue';
import VueRouter from 'vue-router';
window.Vue = Vue;
Vue.use(VueRouter);

//this code works.... just not using it yet.... still using polling.....



