@extends('layouts.tenant')


<?php

?>
@section('content')
    <div class="panel-body">
        <div id="data_table_view"></div>
    </div>
@stop
@section('include_scripts')

    <script src="{{ asset('js/users.js') }}"></script>

@stop
@section('script')

    var server_response_data = <? echo $json ?>;

@stop
