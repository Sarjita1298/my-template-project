<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your Website')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&subset=devanagari,latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/fonts/IcoMoon/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/fonts/linearicon/style.css') }}">

    <!-- Mobile Menu -->
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.mmenu.all.css') }}">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.css') }}">

    <!-- Select Box -->
    <link rel="stylesheet" href="{{ asset('frontend/css/fancySelect.css') }}">

    <!-- Revolution Slider -->
    <link rel="stylesheet" href="{{ asset('frontend/revolution/css/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/revolution/css/layers.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/revolution/css/navigation.css') }}">

    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <!-- Color Scheme -->
    <link rel="stylesheet" href="{{ asset('frontend/switcher/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/switcher/colors/index.html') }}" id="colors">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.png') }}">

    @stack('styles')
</head>
<body>

    @yield('content')

    <!-- JS Scripts -->
    <script src="{{ asset('frontend/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/bootstrap.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins/jquery.waypoints.min.js') }}"></script>

    <!-- Mobile Menu -->
    <script src="{{ asset('frontend/js/plugins/jquery.mmenu.all.min.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins/mobilemenu.js') }}"></script>

    <!-- Revolution Slider Scripts -->
    <script src="{{ asset('frontend/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins/slider-home-1.js') }}"></script>

    <!-- Owl Carousel -->
    <script src="{{ asset('frontend/js/plugins/owl.carousel.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins/owl.js') }}"></script>

    <!-- PreLoader -->
    <script src="{{ asset('frontend/js/plugins/royal_preloader.js') }}"></script>

    <!-- Parallax -->
    <script src="{{ asset('frontend/js/plugins/jquery.parallax-1.1.3.js') }}"></script>

    <!-- Fancy Select -->
    <script src="{{ asset('frontend/js/plugins/fancySelect.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins/lang-select.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins/cb-select.js') }}"></script>

    <!-- Counter Up -->
    <script src="{{ asset('frontend/js/plugins/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins/counterup.js') }}"></script>

    <!-- Global JS -->
    <script src="{{ asset('frontend/js/plugins/template.js') }}"></script>

    <!-- Demo Switcher -->
    <script src="{{ asset('frontend/switcher/demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>


    @stack('scripts')
</body>
</html>
