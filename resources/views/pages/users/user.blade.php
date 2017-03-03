@extends('layouts.tenant')


<?php

?>
@section('content')

    <div class="panel-body passwords">


        <div class="panel panel-default password">
            <div class="panel-heading">
                <h3 class="panel-title">Update Password</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="password" placeholder="Password" value="{{$pass}}">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="text" class="form-control" id="password_confirmation" placeholder="Confirm Password" value="{{$pass}}">
                </div>
                <button id="updatePassword" type="submit" class="btn btn-default">Update</button>
            </div>
        </div>

        <div class="panel panel-default passcode">
            <div class="panel-heading">
                <h3 class="panel-title">Update Manager Code</h3>
            </div>
            <div class="panel-body">
                <div class="form-group ">
                    <label for="passcode">Unique Code</label>
                    <input type="number" class="form-control" id="passcode" placeholder="Numeric Code" value="{{$code}}">
                </div>
                <div class="form-group ">
                    <label for="passcode_confirmation">Confirm Code</label>
                    <input type="number" class="form-control" id="passcode_confirmation" placeholder="Confirm Code" value="{{$code}}">
                </div>
                <button id="updatePasscode"  class="btn btn-default">Update</button>
            </div>
        </div>



    </div>
    <div class = "row col-md-8  col-md-offset-2">
        <p>Recommended values have been added. Passwords need to be longer than 8 characters and require numbers, uppercase, lowercase, and symbols. Manager Codes must be 5 or more and unique.</p>
    </div>
    <div id="modals"></div>
@stop
@section('include_scripts')

    <script src="{{ asset('js/user.js') }}"></script>

@stop
@section('script')

    var server_response_data = <? echo $json ?>;

@stop
