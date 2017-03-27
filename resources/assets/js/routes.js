import VueRouter from 'vue-router'


let routes = [
    {
        path: '',
        name: 'home',
        meta: { guarded: false },
        // component: require('./pages/dashboard/entry')
        component: require('./pages/home.vue')

    },
    {
        path: '/auth',
        component: require('./pages/auth/auth.vue'),
        children: [
            {
                path: 'login',
                name: 'login',

                meta: { guarded: false },
                component: require('./pages/auth/login.vue'),
            },
            {
                path: 'register',
                meta: { guarded: false },
                component: require('./pages/auth/register.vue'),
            },
            {
                path: 'profile',
                meta: { guarded: false },
                component: require('./pages/auth/profile.vue'),
            },
            {
                path: 'logout',
                name: 'logout',
                meta: { guarded: false },
                component: require('./pages/auth/logout.vue'),
            }
        ]
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        auth: true,
        meta: { guarded: true },
        // component: require('./pages/dashboard/entry')
        component: require('./pages/dashboard/dashboard.vue')

    },
    {
        path: '/calendar',
        meta: { guarded: true },
        component: require('./pages/calendar/calendarPage.vue')
    },
    {
        path: '/roles',
        component: require('./pages/layout.vue'),
        meta: { guarded: true },
        props: {},
        children: [
            {
                path: '',
                component: require('./pages/roles/index.vue'),
                meta: { guarded: true },
                props: {page: 'index'},
            },
            {
                path: 'create',
                component: require('./pages/roles/show.vue'),
                meta: { guarded: true },
                props: {page: 'create'}
            },
            {
                path: ':id',
                component: {template: '<router-view></router-view>'},
                children: [
                    {
                        path: '',
                        component: require('./pages/roles/show.vue'),
                        meta: { guarded: true },
                        props: {page: 'show'}
                    },
                    {
                        path: 'edit',
                        component: require('./pages/roles/show.vue'),
                        meta: { guarded: true },
                        props: {page: 'edit'}
                    }

                ],
            },

        ]
    },
    {
        path: '/users',
        meta: { guarded: true },
        component: require('./pages/users/pageSetup.vue'),
        props: {},
        children: [
            {
                path: '',
                component: require('./pages/users/index.vue'),
                props: {page: 'index'},
            },
            {
                path: 'create',
                component: require('./pages/users/show.vue'),
                props: {page: 'create'}
            },
            {
                path: ':id',
                component: {template: '<router-view></router-view>'},
                children: [
                    {
                        path: '',
                        component: require('./pages/users/show.vue'),
                        props: {page: 'show'}
                    },
                    {
                        path: 'edit',
                        component: require('./pages/users/show.vue'),
                        props: {page: 'edit'}
                    }

                ],
            },

        ]
    },
    {
        path: '/user',
        meta: { guarded: true },
        component: require('./pages/layout.vue'),
        children:[
            {
            path: '',
            meta: { guarded: true },
            component: require('./pages/user/user.vue')
        }
        ]
    },
    {
        path: '/locations',
        meta: { guarded: true },
        component: require('./pages/layout.vue'),
        props: {},
        children: [
            {
                path: '',
                component: require('./pages/locations/index.vue'),
                props: {page: 'index'},
                meta: { guarded: true },

            },
            {
                path: 'create',
                component: require('./pages/locations/show.vue'),
                props: {page: 'create'},
                meta: { guarded: true },

            },
            {
                path: ':id',
                component: {template: '<router-view></router-view>'},
                meta: { guarded: true },

                children: [
                    {
                        path: '',
                        component: require('./pages/locations/show.vue'),
                        props: {page: 'show'},
                        meta: { guarded: true },

                    },
                    {
                        path: 'edit',
                        component: require('./pages/locations/show.vue'),
                        props: {page: 'edit'},
                        meta: { guarded: true },

                    }

                ],
            },

        ]
    },
    {
        path: '/terminals',
        meta: { guarded: true },
        component: require('./pages/terminals/pageSetup.vue'),
        props: {},
        children: [
            {
                path: '',
                component: require('./pages/terminals/index.vue'),
                props: {page: 'index'},
            },
            {
                path: 'create',
                component: require('./pages/terminals/show.vue'),
                props: {page: 'create'}
            },
            {
                path: ':id',
                component: {template: '<router-view></router-view>'},
                children: [
                    {
                        path: '',
                        component: require('./pages/terminals/show.vue'),
                        props: {page: 'show'}
                    },
                    {
                        path: 'edit',
                        component: require('./pages/terminals/show.vue'),
                        props: {page: 'edit'}
                    }

                ],
            },

        ]
    },
    {
        path: '/printers',
        meta: { guarded: true },
        component: require('./pages/printers/pageSetup.vue'),
        props: {},
        children: [
            {
                path: '',
                component: require('./pages/printers/index.vue'),
                props: {page: 'index'},
            },
            {
                path: 'create',
                component: require('./pages/printers/show.vue'),
                props: {page: 'create'}
            },
            {
                path: ':id',
                component: {template: '<router-view></router-view>'},
                children: [
                    {
                        path: '',
                        component: require('./pages/printers/show.vue'),
                        props: {page: 'show'}
                    },
                    {
                        path: 'edit',
                        component: require('./pages/printers/show.vue'),
                        props: {page: 'edit'}
                    }

                ],
            },

        ]
    },
    {
        path: '/vendors',
        meta: { guarded: true },
        component: require('./pages/vendors/pageSetup.vue'),
        props: {},
        children: [
            {
                path: '',
                component: require('./pages/vendors/index.vue'),
                props: {page: 'index'},
            },
            {
                path: 'create',
                component: require('./pages/vendors/show.vue'),
                props: {page: 'create'}
            },
            {
                path: ':id',
                component: {template: '<router-view></router-view>'},
                children: [
                    {
                        path: '',
                        component: require('./pages/vendors/show.vue'),
                        props: {page: 'show'}
                    },
                    {
                        path: 'edit',
                        component: require('./pages/vendors/show.vue'),
                        props: {page: 'edit'}
                    }

                ],
            },

        ]
    },
    {
        path: '/browser_tests',
        meta: { guarded: false },
        component: require('./pages/tests/browser_tests.vue')
    },

]


let router =  new VueRouter({

    routes

})

router.beforeEach((to, from, next) => {

    let token = localStorage.getItem('jwt-token')
    if (to.meta.guarded) {
        if (!token || token === null) {
            next({path: '/auth/logout'});
        }
    }
    next()
})

export default router