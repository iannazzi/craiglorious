import './bootstrap';
import router from './routes'
require('./server_connection.js');
//not fucking working... trying to get clib.clone....
// require('./lib/global_library');
// window.cilib = new global_library();

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






//Vue.component('zzi-table', require('./components/table.vue'))

Vue.component('zzi-nav', require('./components/nav/nav.vue'))
Vue.component('zzi-wait', require('./components/modals/waitModal.vue'))
Vue.component('zzi-calendar-entry-modal', require('./pages/calendar/CalendarEventModal.vue'))
Vue.component('zzi-nav-keys', require('./components/keyCommands/dashboardKeyCommands.vue'))

// Vue.component('zzi-calendar-entry-modal2', require('./components/modals/vueBootstrapModal.vue'))

 new Vue({
    el: '#app',
    router: router,
     data:{},

    methods: {
        another(){
            alert('another it was applied');
        },
        logout(){
            axios.post('/auth/logout', {

            })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
    },

    created(){
    },
});
