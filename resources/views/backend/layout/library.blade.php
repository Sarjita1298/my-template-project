<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Demo| @yield('title')</title>



<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="{{ asset('backend/css/select2.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('backend/css/adminlte.min.css') }}">

<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('backend/css/all.min.css') }}">

<!-- Summernote -->
<link rel="stylesheet" href="{{ asset('backend/css/summernote-bs4.min.css') }}">

<style type="text/css">
    /* Center the alert on the screen */
    .alert-container {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        width: 80%;
        max-width: 600px;
    }

    /* Initially hide the alert */
    .alert {
        display: none;
    }
</style>