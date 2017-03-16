

window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
window.firstBy = require('thenby');
window.JsUri = require('jsuri');
window.moment = require('moment');
window.fullcalendar = require('fullcalendar');

require('bootstrap-sass');

import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';

window.Vue = Vue;
Vue.use(VueRouter);
window.axios = axios;

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
