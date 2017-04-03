import './bootstrap';
import router from './routes'
import {getData} from './controllers/getData'
import {AwesomeTable} from './elements/tables/AwesomeTable';
import {AwesomeTableWrapper} from './controllers/AwesomeTableWrapper'

import {transformer} from './helpers/transformer'





// define a mixin object
let myMixin = {
    created: function () {
        this.hello()
    },
    methods: {
        hello: function () {
            console.log('hello from mixin!')
        }
    }
}
// define a component that uses this mixin
// var Component = Vue.extend({
//     mixins: [myMixin]
// })




//99% of page data will be the table......
window.transfomer = new transformer;
window.AwesomeTableWrapper = new AwesomeTableWrapper();
window.AwesomeTable = AwesomeTable;

//some globals please.....
window.bus = new Vue();
window.Event = new class {
    constructor() {
        this.vue = new Vue();

    }

    fire(event, data = null) {
        this.vue.$emit(event, data);

    }

    listen(event, callback) {
        this.vue.$on(event, callback);
    }
}
window.myUser = {
    authenticated: false,
    admin: false
}
window.cached_page_data = {};

//wrap ajax calls in case i need to swap out rest for axios
window.getData = getData;

//watch for route changes


let isDebug = true // toggle this to turn on / off for global controll
let ml;
if (isDebug) ml = console.log.bind(window.console);
else ml = function () {
}

if (1) ml('debug logging on');


window.ml = ml;
// bus.$on('userHasLoggedOut', function () {
//     this.destroyLogin()
// })
//
// bus.$on('userHasLoggedIn', function (user) {
//     this.setLogin(user)
// })


//Vue.component('zzi-table', require('./components/table.vue'))

Vue.component('nav-component', require('./pages/nav.vue'))
Vue.component('footer-component', require('./pages/footer.vue'))
Vue.component('zzi-nav', require('./components/nav/nav.vue'))
Vue.component('zzi-wait', require('./components/modals/waitModal.vue'))
Vue.component('zzi-calendar-entry-modal', require('./pages/calendar/CalendarEventModal.vue'))
Vue.component('zzi-nav-keys', require('./components/keyCommands/dashboardKeyCommands.vue'))
Vue.component('zzi-matrix', require('./components/wait/matrix.vue'))


// Vue.component('zzi-calendar-entry-modal2', require('./components/modals/vueBootstrapModal.vue'))

// router.beforeEach(function (transition) {
//     if (transition.to.guarded && ! MyUser.authenticated) {
//         transition.redirect('/login');
//     } else {
//         transition.next();
//     }
// });
new Vue({
    el: '#app',
    router: router,
    data(){
        return {
            user: null,
            token: null,
            authenticated: false,
            admin: false,
            cached_page_data: {},
            appLoaded: false,

        }
    },
    //mixins: [myMixin],
    methods: {

        setLogin: function (user) {
            // Save login info in our data and set header in case it's not set already
            this.user = user
            this.authenticated = true
            this.token = localStorage.getItem('jwt-token')
            myUser.authenticated = true;
            if (user.role_id == 1) {
                this.admin = true;
                myUser.admin = true;
            } else {
                this.admin = false;
                myUser.admin = false;
            }
            // broadcast an event telling our children the data is ready and views can be rendered
            bus.$emit('authenticated')
        },
        destroyLogin: function (user) {
            if (1) ml('Login with our token failed, do some cleanup');
            this.user = null
            this.token = null
            this.authenticated = false
            this.admin = false
            myUser.authenticated = false;
            myUser.admin = false;
            localStorage.removeItem('jwt-token')

            if (this.$route.meta.guarded) {
                if (1) ml('app reloaded, login failed on a guarded route, going to login page');
                this.$router.push('/auth/login')
            }
            if (1) ml('not a guarded route so there is no redirect');


        },
        validateAuth(){
            // The app has just been initialized, check if we can get the user data with an already existing token

            if (1) ml('lets validate the auth')
            let self = this;
            var token = localStorage.getItem('jwt-token')
            if (token !== null && token !== 'undefined') {


                getData({
                    method: 'get',
                    url: '/login/validate',
                    entity: false,
                    onSuccess(response) {
                        if (1) ml('validated token after refresh')

                        self.setLogin(response.user)
                        self.appLoaded = true;
                    },
                    onError(response){
                        if (1) ml('we have a bad token')
                        self.destroyLogin()
                        self.appLoaded = true;
                    }
                })


            }
            else {
                if (1) ml('validate token after refresh is null')
                self.appLoaded = true;

            }
        },
        getPageData(){
            //site wide data // kinda a bad idea, pretty complicated additional logic.....
            let self = this;
            getData({
                method: 'get',
                url: '/dashboard/cached_page_data',
                entity: false,
                onSuccess(response) {
                    if (1) ml('updated cached page data')
                    self.cached_page_data = response.cached_page_data;
                },

            })
        }
    },

    mounted(){
        let self = this;
        this.validateAuth();

        bus.$on('userHasLoggedOut', function () {
            console.log('destroying login');
            self.destroyLogin()
        })
        bus.$on('userHasLoggedIn', function (user) {
            //self.getPageData();
            self.setLogin(user)
        })

        $(function () {
            setInterval(function checkSession() {
                getData({
                    method: 'get',
                    url: '/validate_token',
                    entity: false,
                    onSuccess(response) {
                        if (1) ml('token validated')
                    },
                    onError(response){
                        if (1) ml('error validating token')
                        console.log(response);
                        self.destroyLogin();
                    }
                })

            }, 100000); // every 100 seconds
        });


    },
})
;
