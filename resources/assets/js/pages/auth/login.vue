<template><div>

    <div class="panel-heading">
        Sign in to your account
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" v-on:submit="attempt">

            <div id="alerts" v-if="messages.length > 0">
                <div v-for="message in messages" :class="['alert alert-' + message.type + 'alert-dismissible']" role="alert">
                    {{ message.message }}
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Company</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" v-model="user.company">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Username</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" v-model="user.username">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Password</label>
                <div class="col-md-6">
                    <input type="password" class="form-control" v-model="user.password">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary" :disabled="loggingIn">
                        <i class="fa fa-btn fa-sign-in"></i>Login
                    </button>
                    <router-link class="btn btn-link" to="{ path: '/auth/forgot' }">Forgot Your Password?</router-link>
                </div>
            </div>
        </form>
    </div>

</div></template>

<script>
    module.exports = {

        data: function () {
            return {
                user: {
                    company: 'embrasse-moi',
                    username: 'admin',
                    password: 'secret'
                },
                messages: [],
                loggingIn: false
            }
        },

        methods: {
            attempt: function (e) {
                e.preventDefault()
                bus.$emit('zzwaitevent');
                let self = this
                self.loggingIn = true
                //client is from rest + mime https://github.com/cujojs/rest
//                client({ path: 'login', entity: this.user }).then(
//                    function (response) {
//                        //not sure why I have to parse this
//                        //also authoriztion header is stripped so fuck off
//                       //let data = JSON.parse(response.entity);
//                        localStorage.setItem('jwt-token', response.entity.token);
//                        self.$emit('userHasLoggedIn', response.entity.user);
//                        bus.$emit('userHasLoggedIn', response.entity.user);
//                        bus.$emit('zzwaiteventover');
//                        //localStorage.setItem('jobs', JSON.stringify(response.entity.jobs) )
//                        //self.$emit('userHasFetchedToken', response.entity.token)
//                        self.$router.push('/dashboard');
//                    },
//                    //second funciton is the error handler
//                    function (response) {
//                        bus.$emit('zzwaiteventover');
//                        console.log(response)
//                        self.messages = []
//                        if (response.status && response.status.code === 401) self.messages.push({type: 'danger', message: 'Sorry, you provided invalid credentials'})
//                        if (response.status && response.status.code === 0) self.messages.push({type: 'danger', message: 'It Looks Like the Server is Down'})
//                        self.loggingIn = false
//                        if (response.status && response.status.code === 5000) self.messages.push({type: 'danger', message: 'Dang, The Server Had an error'})
//                        self.loggingIn = false
//                    }
//
//                )
                getData( {
                    method: 'post',
                    url: 'login',
                    entity: self.user,
                    onSuccess(response) {
                        console.log(response)
                        localStorage.setItem('jwt-token', response.token);
                        self.$emit('userHasLoggedIn', response.user);
                        bus.$emit('userHasLoggedIn', response.user);
                        bus.$emit('zzwaiteventover');
                        //localStorage.setItem('jobs', JSON.stringify(response.entity.jobs) )
                        //self.$emit('userHasFetchedToken', response.entity.token)
                        self.$router.push('/dashboard');
                    },
                    onError(response) {
                        bus.$emit('zzwaiteventover');
                        console.log(response)
                        self.messages = []
                        if (response.status && response.status.code === 401) self.messages.push({type: 'danger', message: 'Sorry, you provided invalid credentials'})
                        if (response.status && response.status.code === 0) self.messages.push({type: 'danger', message: 'It Looks Like the Server is Down'})
                        self.loggingIn = false
                        if (response.status && response.status.code === 5000) self.messages.push({type: 'danger', message: 'Dang, The Server Had an error'})
                        self.loggingIn = false

                    }
                })



            },

        },

        route: {
            activate: function (transition) {
                console.log('what is this for?')
//                this.$dispatch('userHasLoggedOut')
//                transition.next()
            }
        }
    }

</script>