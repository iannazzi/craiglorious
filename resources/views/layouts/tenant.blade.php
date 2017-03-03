
<html lang="en" unselectable>

@include('layouts.includes.head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<body id="bootstrap-overrides">
@include('layouts.includes.nav')
<div id="app">
    @yield('content')
</div>
@include('layouts.includes.footer')
@yield('include_scripts')
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    @yield('script')
</script>
@yield('end_script')
</body>

</html>
