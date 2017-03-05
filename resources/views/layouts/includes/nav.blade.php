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

                @if (\App\Http\Controllers\Auth\myAuth::navCheck())



                    <li class="nav_text dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                    aria-expanded="false">
                        <span>{{ucfirst(\Auth::user()->username)}}</span>
                        <i class="fa fa-user-circle fa-2x"></i></a>
                        <ul class="dropdown-menu" uib-dropdown-menu role="menu" aria-labelledby="btn-append-to-to-body">

                            <li role="menuitem"><a href = "/auth/logout">Logout</a></li>
                            <li class="divider"></li>
                            <li role="menuitem"><a href="/user">Preferences</a></li>
                        </ul>
                    </li>
                    <li><a href="/dashboard">
                            <i class="fa fa-dashboard fa-2x"></i></a>
                    </li>

                    <li><a href="" target="_blank"><i class="fa fa-plus-circle fa-2x"></i></a></li>

                @else

                <li><a href="/auth/login">Login</a></li>
                <li><a href="/auth/register">Register</a></li>
                @endif

                <!--<li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>-->
            </ul>


        </div><!--/.nav-collapse -->
    </div>
</nav>





