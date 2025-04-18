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

    </div>
    
</body>
</html>