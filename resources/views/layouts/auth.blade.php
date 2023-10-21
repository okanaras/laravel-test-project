<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- Title -->
    <title>@yield('title', 'Authentication')</title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href="{{ asset('assets/admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/plugins/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/plugins/pace/pace.css') }}" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="{{ asset('assets/admin/css/main.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/custom.css') }}" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/admin/images/neptune.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/admin/images/neptune.png') }}" />

</head>

<body>

    @yield('content')

    <!-- Javascripts -->
    <script src="{{ asset('assets/admin/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/main.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/custom.js') }}"></script>
    @yield('js')
</body>

</html>
