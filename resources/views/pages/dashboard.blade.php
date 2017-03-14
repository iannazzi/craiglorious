@extends('layouts.tenant')


<?php
////a little help to get me started....
//
//echo '<pre>';
////echo $def;
//echo json_encode($views);
//echo '</pre>';
//
?>
@section('styles')

@stop

@section('content')
<router-view></router-view>
@stop
@section('include_scripts')




    <script>
        var server_data = <? echo $server_data ?>;
        var views = server_data.views;

    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    {{--<script src="{{ asset('vendor/vendor.js') }}"></script>--}}

    {{--<script src="{{ asset('js/server_connection.js') }}"></script>--}}


@stop
@section('end_script')

@stop
