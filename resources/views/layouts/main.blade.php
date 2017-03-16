
<html lang="en" unselectable>

    @include('layouts.includes.head')

    <body id="bootstrap-overrides">

        @include('layouts.includes.nav')

        <div id="app">
            @yield('content')
        </div>

        @include('layouts.includes.footer')
        <script src="{{ asset('js/main_page.js') }}"></script>

            @yield('include_scripts')
        <script>
            @yield('script')
        </script>
            @yield('end_script')

    </body>

</html>
