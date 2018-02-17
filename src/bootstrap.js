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
import Echo from "laravel-echo";
window.Echo = new Echo({
    broadcaster: 'redis',
    key: 'your-pusher-key'
});
Echo.channel('test')
    .listen('testEvent', (e) => {
        console.log(e);
    });

window.Vue = Vue;
Vue.use(VueRouter);



