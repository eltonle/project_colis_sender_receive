<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- Google Font: Source Sans Pro
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,300;0,6..12,500;1,6..12,800&display=swap" rel="stylesheet">

    @include('layouts.partiels.css')
    @yield('css')
    <style>
        * {
            font-family: 'Nunito Sans', sans-serif;
        }

        .swing-animation {
            animation: swing 1s ease infinite;
        }

        @keyframes swing {
            0% {
                transform: rotate(0deg);
            }

            50% {
                transform: rotate(15deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }

        .nav-item {
            margin: 8px;
        }

        .coupe {
            display: flex;
        }

        .chart {
            flex: 2;
            width: 100%;
        }

        .charte {
            flex: 1;
        }

        .charte div {
            width: 100%;
        }

        .modif {
            margin-right: 110px;
        }
    </style>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        @include('layouts.partiels.nav')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.partiels.aside')

        @yield('content')

        <!-- Control Sidebar -->
        @include('layouts.partiels.sidebar')
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('layouts.partiels.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    @include('layouts.partiels.scripts')

    @yield('scripts')
    <script>
        @if(Session::has('message'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
        toastr.success("{{ session('message') }}").addClass("swing-animation");
        @endif

        @if(Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.info("{{ session('info') }}");
        @endif

        @if(Session::has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
        @endif
    </script>
</body>

</html>