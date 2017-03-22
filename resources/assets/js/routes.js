import VueRouter from 'vue-router'


let routes = [
    {
        path: '',
        // component: require('./pages/dashboard/entry')
        component: require('./pages/dashboard/dashboard.vue')

    },
    {
        path: '/roles',
        component: require('./pages/roles/pageSetup.vue'),
        props: {  },
        children: [
            {
                path:'',
                component: require('./pages/roles/index.vue'),
                props: { page: 'index' },
            },
            {
                path: 'create',
                component: require('./pages/roles/show.vue'),
                props: { page: 'create' }
            },
            {
                path: ':id',
                component:{template: '<router-view></router-view>'},
                children: [
                    {
                        path: '',
                        component: require('./pages/roles/show.vue'),
                        props: { page: 'show' }
                    },
                    {
                        path: 'edit',
                        component: require('./pages/roles/show.vue'),
                        props: { page: 'edit' }
                    }

                    ],
            },

        ]
    },
    {
        path: '/users',
        component: require('./pages/users/pageSetup.vue'),
        props: {  },
        children: [
            {
                path:'',
                component: require('./pages/users/index.vue'),
                props: { page: 'index' },
            },
            {
                path: 'create',
                component: require('./pages/users/show.vue'),
                props: { page: 'create' }
            },
            {
                path: ':id',
                component:{template: '<router-view></router-view>'},
                children: [
                    {
                        path: '',
                        component: require('./pages/users/show.vue'),
                        props: { page: 'show' }
                    },
                    {
                        path: 'edit',
                        component: require('./pages/users/show.vue'),
                        props: { page: 'edit' }
                    }

                ],
            },

        ]
    },
    {
        path: '/calendar',
        component: require('./pages/calendar/calendarPage.vue')
    },
    {
        path: '/vendors',
        component: require('./pages/vendors/vendors.vue')
    },
    {
        path: '/user',
        component: require('./pages/user/user.vue')
    },
    {
        path: '/locations',
        component: require('./pages/locations/locations.vue')
    },
    {
        path: '/terminals',
        component: require('./pages/terminals/terminals.vue')
    },
    {
        path: '/printers',
        component: require('./pages/printers/printers.vue')
    },
    {
        path: '/browser_tests',
        component: require('./pages/tests/browser_tests.vue')
    },

]

export default new VueRouter({

    routes

})