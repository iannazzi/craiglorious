<template>
    <div>
        <div class="panel-heading">
            Register for an account
        </div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" v-on:submit="registerUser">

                <div id="alerts" v-if="messages.length > 0">
                    <div v-for="message in messages" ::class="['alert alert-' + message.type + 'alert-dismissible']" role="alert">
                        {{ message.message }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Company Name</label>
                    <div class="col-md-6">
                        <input type="name" class="form-control" v-model="user.company">
                    </div>

                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Your Name</label>
                    <div class="col-md-6">
                        <input type="name" class="form-control" v-model="user.name">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">E-Mail Address</label>
                    <div class="col-md-6">
                        <input type="email" class="form-control" v-model="user.email">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" v-model="user.password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Confirm password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" v-model="user.password_confirmation">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary" :disabled="registering">
                            <i class="fa fa-btn fa-sign-in"></i> Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    module.exports = {

        data: function () {
            return {
                user: {
                    company: 'Change me',
                    name: 'Peter',
                    email: 'Peter@changeme.com',
                    password: 'secret',
                    password_confirmation: 'secret'
                },
                messages: [],
                registering: false
            }
        },

        methods: {
            registerUser: function (e) {

                e.preventDefault()
                var self = this
                alert('registering')
                self.registering = true
                    console.log(JSON.stringify(self.user))
                getData( {
                    method: 'post',
                    url: 'register',
                    entity: self.user,
                    onSuccess(response) {
                        //self.stopCheckLogin();

                        //console.log(response)
                        console.log('log in success - set local storage')
                        //console.log(response.token)
                        //set the user first, then the token
                        localStorage.setItem('user', JSON.stringify(response.user));
                        localStorage.setItem('jwt-token', response.token);

                        bus.$emit('userHasLoggedIn');
                        bus.$emit('zzwaiteventover');



                        //self.$router.push('/dashboard');
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



            }
        }
    }

</script>