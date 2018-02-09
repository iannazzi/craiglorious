<template><div class="login_top">

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
                    <input type="text" class="form-control" ref="username" v-model="user.username">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Password</label>
                <div class="col-md-6">
                    <input type="password" class="form-control" ref="password" v-model="user.password">
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
    let jwtDecode = require('jwt-decode');
    module.exports = {

        data: function () {
            return {
                user: {
                    company: 'demo',
                    username: 'admin',
                    password: 'secret'
                },
                messages: [],
                loggingIn: false,
                loginTimer: null
            }
        },

        methods: {
            attempt: function (e) {
                e.preventDefault()
                bus.$emit('zzwaitevent');
                let self = this
                self.loggingIn = true
                getData( {
                    method: 'post',
                    url: 'login',
                    entity: self.user,
                    onSuccess(response) {
                        //self.stopCheckLogin();

                        //console.log(response)
                        console.log('log in success - set local storage')
                        //console.log(response.token)
                        //set the user first, then the token
                        localStorage.setItem('user', JSON.stringify(response.user));
                        localStorage.setItem('jwt-token', response.token);
                        let decoded = jwtDecode(response.token);
                        console.log(decoded.data.company)
                        localStorage.setItem('company', decoded.data.company);

                        //bus.$emit('userHasLoggedIn');
                        self.$root.setLogin();
                        if(verify_timer_flag){
                            cs.verifyTimerStart();
                        }
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

        mounted: function () {
            //check if there is a company, if so populate
            console.log(localStorage.getItem('company'));
            if(localStorage.getItem('company') !== null){
                this.user.company = localStorage.getItem('company').toLowerCase();
                if(this.user.company === 'demo'){
                    this.$refs.username.focus()
                }
                else if(this.user.company === 'embrasse-moi'){
                    this.user.username = 'craig.iannazzi';
                    this.user.password = '';
                    this.$refs.password.focus()
                }
                else {
                    this.user.username = '';
                    this.user.password = '';
                    this.$refs.username.focus()
                }

            }


                },

    }

</script>