import VueRouter from 'vue-router'

let commonRoute = function (route) {
    return {
        path: '/' + route,
        meta: {guarded: true},
        component: require('./pages/layout.vue'),
        props: {},
        children: [
            {
                path: '',
                component: require('./pages/' + route + '/index.vue'),
                props: {page: 'index', route},
                meta: {guarded: true},

            },
            {
                path: 'create',
                component: require('./pages/' + route + '/show.vue'),
                props: {page: 'create', route},
                meta: {guarded: true},

            },
            {
                path: ':id',
                component: {template: '<router-view></router-view>'},
                meta: {guarded: true},

                children: [
                    {
                        path: '',
                        component: require('./pages/' + route + '/show.vue'),
                        props: {page: 'show', route},
                        meta: {guarded: true},

                    },
                    {
                        path: 'edit',
                        component: require('./pages/' + route + '/show.vue'),
                        props: {page: 'edit', route},
                        meta: {guarded: true},

                    }

                ],
            },

        ]
    }

}
let routes = [
    {
        path: '',
        redirect: 'auth/login',
        name: 'home',
        meta: {guarded: false},
        // component: require('./pages/dashboard/entry')
        component: require('./pages/home.vue')
        // component: require('./pages/auth/login.vue')

    },
    {
        path: '/auth',
        component: require('./pages/auth/auth.vue'),
        children: [
            {
                path: 'login',
                name: 'login',

                meta: {guarded: false},
                component: require('./pages/auth/login.vue'),
            },
            {
                path: 'register',
                name: 'register',

                meta: {guarded: false},
                component: require('./pages/auth/register.vue'),
            },
            {
                path: 'profile',
                name: 'profile',

                meta: {guarded: false},
                component: require('./pages/auth/profile.vue'),
            },
            {
                path: 'logout',
                name: 'logout',
                meta: {guarded: false},
                component: require('./pages/auth/logout.vue'),
            }
        ]
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        auth: true,
        meta: {guarded: true},
        // component: require('./pages/dashboard/entry')
        component: require('./pages/dashboard/dashboard.vue')

    },
    {
        path: '/user',
        meta: {guarded: true},
        component: require('./pages/layout.vue'),
        children: [
            {
                path: '',
                meta: {guarded: true},
                component: require('./pages/user/user.vue')
            }
        ]
    },
    {
        path: '/calendar',
        name: 'calendar',

        meta: {guarded: true},
        component: require('./pages/calendar/calendarPage.vue')
    },

    // commonRoute('calendar'),
    commonRoute('roles'),
    commonRoute('users'),
    commonRoute('locations'),
    commonRoute('terminals'),
    commonRoute('printers'),
    commonRoute('vendors'),
    commonRoute('employees'),
    commonRoute('accounts'),
    commonRoute('customers'),


    {
        path: '/browser_tests',
        meta: {guarded: false},
        component: require('./pages/tests/browser_tests.vue')
    },
    {
        path: '/test',
        meta: {guarded: true},
        component: require('./pages/tests/test.vue')
    },
    {
        path: '/test2',
        meta: {guarded: true},
        component: require('./pages/tests/test2.vue')
    },

]


let router = new VueRouter({

    routes

})

export default router