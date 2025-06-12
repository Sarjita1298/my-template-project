<!DOCTYPE html>
<html lang="en">
<head>
  @include('backend.layout.library')
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include("backend.layout.header")

        @include("backend.layout.sidebar")

        <div class="content-wrapper">
            @yield("content")
        </div>

        @include("backend.layout.footer")

        <aside class="control-sidebar control-sidebar-dark">

        </aside>

        @yield('script')

        <script>
            if (window.location.hash === '#') {
                history.replaceState(null, null, window.location.href.slice(0, -1));
            }
        </script>


    </div>
    
</body>
</html>

