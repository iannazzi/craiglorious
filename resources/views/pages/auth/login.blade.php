@extends('pages.auth.auth')
@section('content2')
    <div class="panel-heading">
        Sign in to your account
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="{{url('auth/login')}}">
            {{ csrf_field() }}

            {{--<div id="alerts" v-if="messages.length > 0">--}}
            {{--<div v-for="message in messages" class="alert alert-{{ message.type }} alert-dismissible" role="alert">--}}
            {{--{{ message.message }}--}}
            {{--</div>--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
            {{--<label class="col-md-4 control-label">Company</label>--}}
            {{--<div class="col-md-6">--}}
            {{--<input type="text" class="form-control">--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class="form-group">
                <label for="company" class="col-md-4 control-label">Company</label>

                <div class="col-md-6">
                    <input id="company" type="text" class="form-control" name="company" value="embrasse-moi">

                    {{--@if ($errors->has('company'))--}}
                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('company') }}</strong>--}}
                                    {{--</span>--}}
                    {{--@endif--}}
                </div>
            </div>

            <div class="form-group">
{{--                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">--}}
                <label for="username" class="col-md-4 control-label">Login</label>

                <div class="col-md-6">
                    <input id="username" type="text" class="form-control" name="username" value="admin">

                    {{--@if ($errors->has('username'))--}}
                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('username') }}</strong>--}}
                                    {{--</span>--}}
                    {{--@endif--}}
                </div>
            </div>


            {{--<div class="form-group">--}}
            {{--<label class="col-md-4 control-label">Username</label>--}}
            {{--<div class="col-md-6">--}}
            {{--<input type="text" class="form-control">--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class="form-group">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" value ='secret'>

                    {{--@if ($errors->has('password'))--}}
                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                    {{--@endif--}}
                </div>
            </div>
            {{--<div class="form-group">--}}
            {{--<label class="col-md-4 control-label">Password</label>--}}
            {{--<div class="col-md-6">--}}
            {{--<input type="password" class="form-control">--}}
            {{--</div>--}}
            {{--</div>--}}

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary" :disabled="loggingIn">
                        <i class="fa fa-btn fa-sign-in"></i>Login
                    </button>
                    <a class="btn btn-link">Forgot Your Password?</a>
                </div>
            </div>
        </form>
    </div>
@stop
@section('script')

    $(function() {
    setInterval(function checkSession() {
    $.get('/check-session', function(data) {
    // if session was expired
    console.log(data);
    if (!data.guest) {
    location.reload();
    }
    });
    }, 10000); // every 10 seconds
    });


@stop