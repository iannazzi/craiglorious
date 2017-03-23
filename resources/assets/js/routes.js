import VueRouter from 'vue-router'


let routes = [
    {
        path: '',
        // component: require('./pages/dashboard/entry')
        component: require('./pages/dashboard/dashboard.vue')

    },
    {
        path: '/calendar',
        component: require('./pages/calendar/calendarPage.vue')
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
        path: '/user',
        component: require('./pages/user/user.vue')
    },
    {
        path: '/locations',
        component: require('./pages/locations/pageSetup.vue'),
        props: {  },
        children: [
            {
                path:'',
                component: require('./pages/locations/index.vue'),
                props: { page: 'index' },
            },
            {
                path: 'create',
                component: require('./pages/locations/show.vue'),
                props: { page: 'create' }
            },
            {
                path: ':id',
                component:{template: '<router-view></router-view>'},
                children: [
                    {
                        path: '',
                        component: require('./pages/locations/show.vue'),
                        props: { page: 'show' }
                    },
                    {
                        path: 'edit',
                        component: require('./pages/locations/show.vue'),
                        props: { page: 'edit' }
                    }

                ],
            },

        ]
    },
    {
        path: '/terminals',
        component: require('./pages/terminals/pageSetup.vue'),
        props: {  },
        children: [
            {
                path:'',
                component: require('./pages/terminals/index.vue'),
                props: { page: 'index' },
            },
            {
                path: 'create',
                component: require('./pages/terminals/show.vue'),
                props: { page: 'create' }
            },
            {
                path: ':id',
                component:{template: '<router-view></router-view>'},
                children: [
                    {
                        path: '',
                        component: require('./pages/terminals/show.vue'),
                        props: { page: 'show' }
                    },
                    {
                        path: 'edit',
                        component: require('./pages/terminals/show.vue'),
                        props: { page: 'edit' }
                    }

                ],
            },

        ]
    },
    {
        path: '/printers',
        component: require('./pages/printers/pageSetup.vue'),
        props: {  },
        children: [
            {
                path:'',
                component: require('./pages/printers/index.vue'),
                props: { page: 'index' },
            },
            {
                path: 'create',
                component: require('./pages/printers/show.vue'),
                props: { page: 'create' }
            },
            {
                path: ':id',
                component:{template: '<router-view></router-view>'},
                children: [
                    {
                        path: '',
                        component: require('./pages/printers/show.vue'),
                        props: { page: 'show' }
                    },
                    {
                        path: 'edit',
                        component: require('./pages/printers/show.vue'),
                        props: { page: 'edit' }
                    }

                ],
            },

        ]
    },
    {
        path: '/vendors',
        component: require('./pages/vendors/pageSetup.vue'),
        props: {  },
        children: [
            {
                path:'',
                component: require('./pages/vendors/index.vue'),
                props: { page: 'index' },
            },
            {
                path: 'create',
                component: require('./pages/vendors/show.vue'),
                props: { page: 'create' }
            },
            {
                path: ':id',
                component:{template: '<router-view></router-view>'},
                children: [
                    {
                        path: '',
                        component: require('./pages/vendors/show.vue'),
                        props: { page: 'show' }
                    },
                    {
                        path: 'edit',
                        component: require('./pages/vendors/show.vue'),
                        props: { page: 'edit' }
                    }

                ],
            },

        ]
    },





    {
        path: '/browser_tests',
        component: require('./pages/tests/browser_tests.vue')
    },

]

export default new VueRouter({

    routes

})