<template>
    <nav class="main_navbar navbar navbar-default navbar-fixed-top navbar-inverse">
        <div class="container-fluid craiglorious_header">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <router-link class=" header_title navbar-brand" to="/">craiglorious</router-link>
            </div>
            <div id="navbar" class=" navbar-collapse collapse">
                <div v-if="this.$root.appLoaded">
                    <div v-if="myUser.authenticated">
                        <ul class="nav navbar-nav navbar-right">

                            <li>
                                <router-link to="/dashboard">
                                    <i class="fa fa-dashboard fa-2x"></i></router-link>
                            </li>

                            <li><a href="" target="_blank"><i class="fa fa-plus-circle fa-2x"></i></a></li>
                            <li class="nav_text dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-haspopup="true"
                                   aria-expanded="false">
                                    <span>{{this.$root.user.username}}</span>
                                    <i class="fa fa-user-circle fa-2x"></i></a>
                                <ul class="dropdown-menu" uib-dropdown-menu role="menu"
                                    aria-labelledby="btn-append-to-to-body">
                                    <li role="menuitem">
                                        <!--<router-link to="/auth/logout">Logout</router-link>-->
                                        <a id='logout' @click="logout">Logout</a>


                                    </li>
                                    <li class="divider"></li>
                                    <li role="menuitem">
                                        <router-link to="/user">User Preferences</router-link>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div v-else>
                        <ul class="nav navbar-nav navbar-right">
                            <li role="menuitem">
                                <router-link to="/auth/login">Login</router-link>
                            </li>
                            <li role="menuitem">
                                <router-link to="/auth/register">Register</router-link>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--<li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>-->


            </div><!--/.nav-collapse -->
        </div>
    </nav>
</template>
<script>
    module.exports = {
        data: function () {
            return {
                myUser,
                navTitle: 'Vue.js',
            }
        },
        methods: {
            logout(){
                console.log('got loggggerrrrr')
                bus.$emit('userHasLoggedOut')
            }
        }
    }
</script>
<style>

    .navbar {
        font-size: 16px;
        font-weight: 300;
        margin-bottom: 40px;

    .navbar-brand {
        font-size: 28px;

    i {
        color: #f4645f;
    }
    }

    .navbar-nav {
        padding-top: 0px;
    li a.v-link-active {
        text-decoration: underline;
    }
    }

    .dropdown-menu {
    li {
        font-size: 14px;

    a {
        font-weight: 300;
        line-height: 25px;
        vertical-align: middle;
    }
    }
    }
    }

    .craiglorious_header{
        height:76px;
    }
    .nav_text span{
        font-size: 2.0em;
        font-weight: bold;
    //vertical-align: -0.15em;
        padding-right:12px;
    }

    #bootstrap-overrides nav2 {
        color: red;
    }

    #bootstrap-overrides .main_navbar {
        background-color: mix(#2B3856, #000000);
    }

    #bootstrap-overrides .header_title {
        font-size: 55px;
        font-weight: Bold;
        font-family: 'Arial Black';
        color: red;
        margin: 0px;
    //padding-top:13px;
        padding-left: 0px;
        padding-bottom: 0px;
        padding-right: 0px;
        letter-spacing: -3px;
    }

</style>