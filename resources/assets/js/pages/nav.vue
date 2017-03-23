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
                <a class=" header_title navbar-brand" href="#">CraiGlorious</a>
            </div>
            <div id="navbar" class=" navbar-collapse collapse">
                <ul class="nav navbar-nav">


                    <!--<li v-if="$root.authenticated" class="dropdown">-->
                    <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"-->
                    <!--aria-expanded="false">Dropdown <span class="caret"></span></a>-->
                    <!--<ul class="dropdown-menu" uib-dropdown-menu role="menu" aria-labelledby="btn-append-to-to-body">-->
                    <!--<li role="menuitem"><a href="#">Action</a></li>-->
                    <!--<li role="menuitem"><a href="#">Another action</a></li>-->
                    <!--<li role="menuitem"><a href="#">Something else here</a></li>-->
                    <!--<li class="divider"></li>-->
                    <!--<li role="menuitem"><a href="#">Separated link</a></li>-->
                    <!--</ul>-->
                    <!--</li>-->
                </ul>

                <ul v-if='auth' class="nav navbar-nav navbar-right">
                    <li><a href="#auth/logout">Logout</a></li>
                    <li><a href="#" target="_blank"><i class="fa fa-plus-circle"></i></a></li>

                    <!--<li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>-->
                </ul>
                <ul v-else class="nav navbar-nav navbar-right">
                    <li><router-link to="/auth/login">Login</router-link></li>
                    <!--<li><a href="auth/login">login</a></li>-->
                    <li><a href="auth/register">Register</a></li>
                    <li><a href="#" target="_blank"><i class="fa fa-plus-circle"></i></a></li>

                    <!--<li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>-->
                </ul>

            </div><!--/.nav-collapse -->
        </div>
    </nav>


</template>
<script>
    module.exports = {
        data: function () {
            return {
                navTitle: 'Vue.js',
                auth:false
            }
        }
    }
</script>