import './bootstrap';
import router from './routes'




//Vue.component('zzi-table', require('./components/table.vue'))

Vue.component('zzi-nav', require('./components/nav/nav.vue'))
Vue.component('zzi-calendar-entry-modal', require('./components/calendar/CalendarEventModal.vue'))
// Vue.component('zzi-calendar-entry-modal2', require('./components/modals/vueBootstrapModal.vue'))



//i need an event bus... for some reason this will not work on the main vue instance
// so i use a second vue instance just for the event bus
//another method window.event is shown
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
let rootvvvv = new Vue({
    el: '#app',
    router: router,
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
        Event.listen('applied', () => alert('handling ir'));
    },
});
window.rootvvv = rootvvvv;
