<template>
    <nav class="main_navbar navbar navbar-default navbar-fixed-top navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class=" header_title navbar-brand" href="/dashboard">CraiGlorious</a>
            </div>
            <div id="navbar" class=" navbar-collapse collapse">
                <ul class="nav navbar-nav">

                </ul>

                <ul class="nav navbar-nav navbar-right">

                    <li v-show="isLoggedIn" class="nav_text dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">
                            <span>{{username}}</span>
                            <i class="fa fa-user-circle fa-2x"></i></a>
                        <ul class="dropdown-menu" uib-dropdown-menu role="menu" aria-labelledby="btn-append-to-to-body">

                            <li role="menuitem"><a href = "/auth/logout">Logout</a></li>
                            <li class="divider"></li>
                            <li role="menuitem"><a href="/user">Preferences</a></li>
                        </ul>
                    </li>
                    <li><a v-show="isLoggedIn" href="/dashboard">
                        <i class="fa fa-dashboard fa-2x"></i></a>
                    </li>

                    <li><a  v-show="isLoggedIn" href="" target="_blank"><i class="fa fa-plus-circle fa-2x"></i></a></li>


                    <li><a v-show="isLoggedIn" href="/auth/login">Login</a></li>
                    <li><a v-show="isLoggedIn" href="/auth/register">Register</a></li>

                    <!--<li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>-->
                </ul>


            </div><!--/.nav-collapse -->
        </div>
    </nav>
</template>
<script>
    //import { pageSetup }from '../pages/roles/pageSetup'
    export default {
        data() {
            return {

            }
        },
        mounted: function () {
            console.log('roles coming')
        },
        methods: {

        }
    }
</script>
