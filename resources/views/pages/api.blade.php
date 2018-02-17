<!DOCTYPE html>
<html lang="en">

<head>
    <title>Craiglorious - Business Software by Craig Iannazzi</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="text/css" media="print"  href="{{ asset('css/fullcalendar.print.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>

</head>

<body id="bootstrap-overrides">
<div id="app">
    <router-view></router-view>
</div>
{{--<script src="{{ asset('js/jquery.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/lodash.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/fullcalendar.min.js') }}"></script>--}}
<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>

</body>

</html>
