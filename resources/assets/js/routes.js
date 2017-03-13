import VueRouter from 'vue-router'


let routes = [
    {
        path:'',
        // component: require('./pages/dashboard/entry')
        component: require('./views/dashboard/Dashboard.vue')

    },
    {
        path:'/roles',
        component: require('./views/Roles.vue')
    },
    {
        path:'/calendar',
        component: require('./views/' +
            'Calendar.vue')
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