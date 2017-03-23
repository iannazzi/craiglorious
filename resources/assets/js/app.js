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

// Vue.component('zzi-calendar-entry-modal2', require('./components/modals/vueBootstrapModal.vue'))

 new Vue({
    el: '#app',
    router: router,
     data(){
         return {
             user: null,
             token: null,
             authenticated: false,

         }
     },

    methods: {
        setLogin: function (user) {
            // Save login info in our data and set header in case it's not set already
            this.user = user
            this.authenticated = true
            this.token = localStorage.getItem('jwt-token')
        },

        destroyLogin: function (user) {
            this.user = null
            this.token = null
            this.authenticated = false
            localStorage.removeItem('jwt-token')
            //if (this.$route.auth) this.$route.router.go('/auth/login')
        }
    },

    mounted(){
        this.$on('userHasLoggedOut', function () {
            this.destroyLogin()
        })

        this.$on('userHasLoggedIn', function (user) {
            console.log('setting login');
            this.setLogin(user)
        })

        // The app has just been initialized, check if we can get the user data with an already existing token
        var token = localStorage.getItem('jwt-token')
        if (token !== null && token !== 'undefined') {
            var that = this
            // client({ path: '/users/me' }).then(
            //     function (response) {
            //         // User has successfully logged in using the token from storage
            //         that.setLogin(response.entity.user)
            //         // broadcast an event telling our children that the data is ready and views can be rendered
            //         that.$broadcast('data-loaded')
            //     },
            //     function (response) {
            //         // Login with our token failed, do some cleanup and redirect if we're on an authenticated route
            //         that.destroyLogin()
            //     }
            // )
        }
    },
});
