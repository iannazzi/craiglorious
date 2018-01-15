import './bootstrap';
import router from './routes'
import {getData} from './controllers/getData'
import {AwesomeTable} from './elements/tables/AwesomeTable';
import {AwesomeTableWrapper} from './controllers/AwesomeTableWrapper'
import {craigSocket} from './controllers/craigSocket'

import {transformer} from './helpers/transformer'




//99% of page data will be the table......
window.transfomer = new transformer;
window.AwesomeTableWrapper = new AwesomeTableWrapper();
window.AwesomeTable = AwesomeTable;
let cs = new craigSocket();
window.cs = cs;

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



Vue.component('nav-component', require('./pages/nav.vue'))
Vue.component('footer-component', require('./pages/footer.vue'))
Vue.component('zzi-nav', require('./components/nav/nav.vue'))
Vue.component('zzi-wait', require('./components/modals/waitModal.vue'))
Vue.component('zzi-calendar-entry-modal', require('./pages/calendar/CalendarEventModal.vue'))
Vue.component('zzi-nav-keys', require('./components/keyCommands/dashboardKeyCommands.vue'))
Vue.component('zzi-matrix', require('./components/wait/matrix.vue'))
Vue.component('zzi-matrix2', require('./components/wait/matrix2.vue'))



new Vue({
    el: '#app',
    router: router,
    filters: {
        modelName (value) {

            if (!value) return ''
            value = value.toString()
            let name = value.charAt(0).toUpperCase() + value.slice(1)
            return name.substr(0,name.length-1);
        }
    },
    data(){
        return {
            user: null,
            token: null,
            authenticated: false,
            admin: false,
            cached_page_data: {},
            appLoaded: false,
            inactivityTimer: false,

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
            //bus.$emit('authenticated')
        },
        destroyLogin: function (user) {
            if (0) ml('Login with our token failed, do some cleanup');
            this.user = null
            this.token = null
            this.authenticated = false
            this.admin = false
            myUser.authenticated = false;
            myUser.admin = false;
            localStorage.removeItem('jwt-token')
            cs.stopCS();
            if (this.$route.meta.guarded) {
                if (0) ml('app reloaded, login failed on a guarded route, going to login page');
                this.$router.push('/auth/login')
            }
            if (0) ml('not a guarded route so there is no redirect');


        },
        validateAuth(){
            // The app has just been initialized, check if we can get the user data with an already existing token

            if (1) ml('lets validate the auth')
            let self = this;
            var token = localStorage.getItem('jwt-token')
            if (token !== null && token !== 'undefined') {
                console.log('going to validate the token')
                getData({
                    method: 'get',
                    url: '/auth',
                    entity: false,
                    onSuccess(response) {
                        console.log(response);
                        if (1) ml('validated token after refresh')
                        bus.$emit('userHasLoggedIn', response.user);
                        self.appLoaded = true;

                    },
                    onError(response){
                        console.log(response);
                        if (1) ml('we have a bad token')
                        self.destroyLogin()
                        self.appLoaded = true;
                    }
                })


            }
            else {
                console.log('no token');
                if (0) ml('validate token after refresh is null')
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


        bus.$on('userHasLoggedOut', function (craigSocketId) {
            console.log('bus.... user logged out... destroying login');
            self.destroyLogin()
        })
        bus.$on('userHasLoggedIn', function (user) {
            //self.getPageData();
            console.log(self.$route.name);
            self.setLogin(user)
            cs.startCS();
        })

        bus.$on('userInput', function () {
            console.log('user input detected.... ');

            // check the token expiration time

            if( ! self.inactivityTimer)
            {
                self.inactivityTimer=true

                console.log('going to get some data ... ');
                getData({
                    method: 'get',
                    url: '/craigsocket',
                    entity: false,
                    onSuccess(response) {
                        console.log(response);

                        //double check that there is a token there, a user on a different tab could have clicked logout while transmitting....

                        if(localStorage.getItem('jwt-token') === null)
                        {
                            //got logged out from a different tab
                           console.log('token deleted from storage before we got back....');
                            console.log(response);
                           bus.$emit('userHasLoggedOut');
                        }
                        else
                        {
                            //refresh the token
                            console.log('refresh the token');
                            localStorage.setItem('jwt-token', response.token);

                            //update messages

//wait
                            console.log('starting a timer .... ');
                            setTimeout(function(){

                                self.inactivityTimer=false;


                            }, 1000);
                        }

                    },
                    onError(response){
                        console.log('unable to connect to server');
                        console.log(response);
                        //bus.$emit('userHasLoggedOut');
                    }

                })
                //check the token isn't stale


            }



        })


    },
})
;
