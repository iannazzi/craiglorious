@extends('layouts.tenant')

<?php

//echo '<pre>';
//echo json_encode (App\Classes\Views\ViewHelpers::tableDef('test'));
//echo '</pre>';
?>


@section('content')
    <div class="panel-body">
        <div id="tests"></div>
    </div>
@stop
@section('include_scripts')

    <script src="{{ asset('js/table_tests.js') }}"></script>

@stop
@section('script')

@stop
