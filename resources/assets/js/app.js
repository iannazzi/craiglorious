import './bootstrap';
import router from './routes'
//require('./server_connection.js');
//not fucking working... trying to get clib.clone....
// require('./lib/global_library');
// window.cilib = new global_library();


import {AwesomeTable} from './elements/tables/AwesomeTable';

window.AwesomeTable = AwesomeTable;
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
window.myUser = {
    authenticated: false,
    admin: false
}

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
            dashboard_page_data: null,
            appLoaded: false,

        }
    },

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
            if (1) ml('Login with our token failed, do some cleanup and redirect if we\'re on an authenticated route');
            this.user = null
            this.token = null
            this.authenticated = false
            this.admin = false
            myUser.authenticated = false;
            myUser.admin = false;
            localStorage.removeItem('jwt-token')
            if (1) ml('this.$route.guarded');
            if (1) ml(this.$route);

            if (this.$route.meta.guarded) {
                if (1) ml('app reloaded, login failed on a guarded route, going to login page');
                this.$router.push('/auth/login')
            }


        },
        validateAuth(){
            // The app has just been initialized, check if we can get the user data with an already existing token

            if (1) ml('lets validate the auth')
            let self = this;
            var token = localStorage.getItem('jwt-token')
            if (token !== null && token !== 'undefined') {
                client({path: '/login/validate'}).then(
                    function (response) {
                        if (1) ml('validated token after refresh')

                        self.setLogin(response.entity.user)
                        self.appLoaded = true;
                    },
                    function (response) {
                        if (1) ml('we have a bad token')

                        self.destroyLogin()
                    }
                )
            }
            else {
                if (1) ml('token is null')

            }
        },
        getPageData(){
            //how about grabbing site wide data?
            let self = this;
            client({path: '/dashboard/page_data'}).then(
                function (response) {
                    self.dashboard_page_data = response.entity.dashboard_page_data;
                },
                function (response) {

                }
            )
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
            self.getPageData();
            self.setLogin(user)
        })

        $(function () {
            setInterval(function checkSession() {

                client({path: '/validate_token'}).then(
                    function (response) {
                        console.log('token validated')
                    },
                    function (response, status) {
                        console.log('error validating token');
                        console.log(response);
                        self.destroyLogin();
                    })
            }, 10000); // every 10 seconds
        });


    },
})
;
