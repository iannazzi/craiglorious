

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


window.config = require('./config')


// Configure our HTTP client
var rest = require('rest')
var pathPrefix = require('rest/interceptor/pathPrefix')
var mime = require('rest/interceptor/mime')
var defaultRequest = require('rest/interceptor/defaultRequest')
var errorCode = require('rest/interceptor/errorCode')
var interceptor = require('rest/interceptor')
var jwtAuth = require('./config/interceptors/jwtAuth')

window.client = rest.wrap(pathPrefix, { prefix: config.api.base_url })
    .wrap(mime)
    .wrap(defaultRequest, config.api.defaultRequest)
    .wrap(errorCode, { code: 400 })
    .wrap(jwtAuth);



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
