import VueRouter from 'vue-router'


let routes = [
    {
        path:'',
        // component: require('./pages/dashboard/entry')
        component: require('./views/Dashboard/Dashboard.vue')

    },
    {
        path:'/roles',
        component: require('./views/Roles.vue')
    },
    // {
    //     path:'/vendors',
    //     component: require('./views/Vendors.vue')
    // },
    // {
    //     path:'/users',
    //     component: require('./views/Users.vue')
    // },
    // {
    //     path:'/locations',
    //     component: require('./views/Locations.vue')
    // },
    // {
    //     path:'/terminals',
    //     component: require('./views/Terminals.vue')
    // },
    // {
    //     path:'/printers',
    //     component: require('./views/Printers.vue')
    // },

]

export default new VueRouter({

    routes

})