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
window.cs = new craigSocket();


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
window.storage = {};

//wrap ajax calls in case i need to swap out rest for axios
window.getData = getData;

let isDebug = true // toggle this to turn on / off for global controll
let ml;
if (isDebug) ml = console.log.bind(window.console);
else ml = function () {
}

if (1) ml('debug logging on');
window.ml = ml;

Vue.component('nav-component', require('./components/nav/nav.vue'))
Vue.component('footer-component', require('./pages/footer.vue'))
Vue.component('zzi-nav', require('./components/nav/nav.vue'))
Vue.component('zzi-wait', require('./components/modals/waitModal.vue'))
//Vue.component('zzi-calendar-entry-modal', require('./pages/calendar/CalendarEventModal.vue'))
Vue.component('zzi-nav-keys', require('./components/keyCommands/dashboardKeyCommands.vue'))
Vue.component('zzi-matrix', require('./components/wait/matrix.vue'))
Vue.component('zzi-matrix2', require('./components/wait/matrix2.vue'))


//access to the root             this.$root.destroyLogin();
let vm = new Vue({
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
            appLoaded: false,
            inactivityTimer: false,
            last_page_accessed: null

        }
    },
    //mixins: [myMixin],
    methods: {
        //these should probably go to auth?
        setLogin: function () {
            // Save login info in our data and set header in case it's not set already
            let user = JSON.parse(localStorage.getItem('user'));
            this.user = user
            this.authenticated = true
            //this.token = localStorage.getItem('jwt-token')
            myUser.authenticated = true;
            if (user.role_id == 1) {
                this.admin = true;
                myUser.admin = true;
            } else {
                this.admin = false;
                myUser.admin = false;
            }
        },
        destroyLogin: function (user) {
            console.log('destroying login - where should I store the page?')

            if (0) ml('Login with our token failed, do some cleanup');
            this.user = null
            this.token = null
            this.authenticated = false
            this.admin = false
            window.cached_page_data = {};

            myUser.authenticated = false;
            myUser.admin = false;
            localStorage.removeItem('user')
            localStorage.removeItem('jwt-token')
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
                        //localStorage.setItem('user', JSON.stringify(response.user));
                        bus.$emit('userHasLoggedIn');

                            self.setLogin()
                            if(craiglorious.last_page_accessed_flag){
                                let last_page_accessed = self.last_page_accessed;
                                if(last_page_accessed){
                                    self.$router.push(last_page_accessed)
                                    // self.$router.push('/dashboard');
                                }
                                else{
                                    self.$router.push('/dashboard');
                                }
                            }

                            if(craiglorious.craigsocket){
                                cs.verifyTimerStart();
                            }





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

    },

    mounted(){
        // socket.on('test-channel:UserSignedUp',function(data){
        //     console.log('event received from socket');
        //     console.log(data);
        // })
        let self = this;
        this.validateAuth();

        //this should probably go to events/bus
        bus.$on('userHasLoggedOut', function (craigSocketId) {
            console.log('bus.... user logged out... destroying login');
            if (self.$route.path != '/auth/login')
            {
                //self.last_page_accessed = self.$route.fullPath;
            }
            cs.verifyTimerStop();
            self.destroyLogin()
            self.$router.push('/auth/login');

        })
        // bus.$on('userHasLoggedIn', function (user) {
        //     //self.getPageData();
        //     //console.log(self.$route.name);
        //     self.setLogin()
        //     // let last_page_accessed = localStorage.getItem('last_page_accessed')
        //     if(craiglorious.last_page_accessed_flag){
        //         let last_page_accessed = self.last_page_accessed;
        //         if(last_page_accessed){
        //             self.$router.push(last_page_accessed)
        //             // self.$router.push('/dashboard');
        //         }
        //         else{
        //             self.$router.push('/dashboard');
        //         }
        //     }
        //
        //     if(craiglorious.craigsocket){
        //         cs.verifyTimerStart();
        //     }
        // })
        bus.$on('pageRefresh', function(){});
        bus.$on('UserLoggedInFromAnotherTab', function(){

        });
        bus.$on('userInput', function () {
            if(craiglorious.autosave){
                console.log('user input detected.... ');
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
                                console.log('craigsocket back but token deleted from storage before we got back....');
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
                                //console.log('starting a timer ..');
                                setTimeout(function(){

                                    self.inactivityTimer=false;


                                }, craiglorious.autosave_timer);
                            }

                        },
                        onError(response){
                            console.log('craigsocket unable to connect to server');
                            console.log(response);
                            //bus.$emit('userHasLoggedOut');
                        }

                    })
                    //check the token isn't stale


                }
            }
        })
    },
})

//this should probalby go to events/window
window.addEventListener('storage', function(e) {
    console.log('storage event listener fired')
    console.log(e);
    console.log(e.key + ' ' + e.newValue);
    if(e.key === 'jwt-token'){
        if(e.newValue === null){
            //log out user
            bus.$emit('userHasLoggedOut');
        }
        else{
            if(e.oldValue === null){
                vm.setLogin()
                if(craiglorious.last_page_accessed_flag){
                    let last_page_accessed = vm.last_page_accessed;
                    if(last_page_accessed){
                        vm.$router.push(last_page_accessed)
                    }
                    else{
                        vm.$router.push('/dashboard');
                    }
                }
                if(craiglorious.craigsocket){
                    cs.verifyTimerStart();
                }

            }
            //otherwise it was just a token refresh

        }
    }
});

//here is the guard.... super easy.... why is laravel a pain>
router.beforeEach((to, from, next) => {

    //strip query off?
    // let uri = new JsUri(window.location.href);
     //console.log ('might need to take control of the uri query');
    // let query = uri.query();
    // uri.queryPairs.forEach(pair => {
    //     console.log(pair)
    //     uri.deleteQueryParam(pair[0]);
    // })
    let token = localStorage.getItem('jwt-token')
    if (to.meta.guarded) {
        if (!token || token === null) {
            next({path: '/auth/logout'});
        }
        else{
            vm.last_page_accessed = to.fullPath;
            //cant use local storage due to different tabs
            //localStorage.setItem('last_page_accessed', to.fullPath)

        }
    }
    next()
})
router.afterEach((to, from, next)=>{
    if (to.meta.guarded) {
        //console.log(to)
        //console.log('store the path')
       // vm.last_page_accessed = vm.to.fullPath;
    }
    //next()
})

