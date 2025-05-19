<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your Website')</title>

    {{-- Include CSS & libraries --}}
    @include('frontend.layout.library')

    {{-- Stack for page-specific CSS --}}
    @stack('styles')
</head>
<body>
    {{-- Header --}}
    @include('frontend.layout.header')

    {{-- Main Content --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('frontend.layout.footer')

  

    {{-- Page-specific scripts --}}
    @yield('scripts')

</body>
</html>
