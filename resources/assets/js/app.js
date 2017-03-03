import './bootstrap';
import router from './routes'
import {tableTests} from './elements/tables/tests/tableTests'

window.Event =  new class{
    constructor(){
        this.vue = new Vue();

    }
    fire(event, data = null){
        this.vue.$emit(event,data);

    }
    listen(event,callback){
        this.vue.$on(event,callback);
    }
}


Vue.component('zzi-table', {
    props:['name','body'],
    mounted(){
        let div = document.getElementById('data_table');
        div.appendChild(tableTests());
    },
    data(){
        return{
            isVisible:true,
        }

    },
    methods:{
        toggleTable(){
            this.isVisible = !this.isVisible;

        }
    },
    template: `
<div>
    <table class = "table" v-show="isVisible" >
        <thead>
            <tr>
                <th>Hu</th>
                <th>Lu</th>
</tr>
</thead>
    <tbody>
    <tr>
        <td>yes</td>
        <td>no</td>

</tr>
</tbody>
    </table>
    <button type="button"  @click="toggleTable">xxxx</button>
    </div>
`

    }
)

Vue.component('zzi-modal',
    {
        mounted() {
            console.log('modal mounted');
        },
        template:`
<div class="modal is-active" >
  <div class="modal-background"></div>
  <div class="modal-content">
    <p>pussy</p>
  </div>
  <button class="modal-close" @click="$emit('close')"></button>
</div>
`
    })

Vue.component('zzi-tabs', {
    mounted(){
        console.log(this.$children);
    },
    created(){
      this.tabs = this.$children;
    },
    data() {
        return { tabs:[]}
    },

    methods:{
        selectTab(selectedTab){
            this.tabs.forEach(tab => {
                tab.isActive = (tab.name == selectedTab.name);
            })
        }

    },
    template:` 
<div>
    <div class="tabs">
        <ul>
            <li v-for="tab in tabs" :class="{ 'is-active':tab.isActive}">
                <a :href = "tab.href" @click="selectTab(tab)">{{ tab.name }}</a>
            </li>
    </ul>
</div>
<div class="tabs-details">
<slot></slot>
</div>
</div>
`
})

Vue.component('zzi-tab',{
    props: {
        name: {required:true},
        selected: {default:false}
    },
    data() {
        return {
            isActive:false

        }
    },
    created(){
        Event.listen('applied', () => alert('handling it by tabs'));
    },
    computed:{
        href(){
            return '#' + this.name.toLocaleLowerCase().replace(/ /g, '-')
        }
    },
    mounted(){
        this.isActive = this.selected;
    },
    template:`
    <div v-show="isActive"><slot></slot></div>
`
})

Vue.component('coupon',{
    template:'<div><input placeholder="Enter Your COupon Code" @blur = "onCouponApplied"></div>',
    methods:{
        onCouponApplied(){
            console.log('emmitting event applied');
            Event.fire('applied');
        }
    }
})

const app = new Vue({
    el: '#app',
    router: router,
    methods:{
        another(){
            alert('another it was applied');
        }},
    created(){
        Event.listen('applied', () => alert('handling ir'));
    },
});
