<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>IMS</title>
    <link href="{{ asset('assets/img/logo.jpg') }}" rel="icon" class="rounded-circle">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <style>
        /* Dark charcoal, grayscale treatment of the background image (matches admin panel) */
        body {
            background-color: #23272b;
            min-height: 100vh;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: url('/assets/img/bg.png') center / cover no-repeat;
            filter: grayscale(1) brightness(0.35) contrast(1.05);
            z-index: -1;
        }

        .container {
            margin-top: 7rem;
        }

        /* Auth forms -> admin dark/charcoal theme (replaces bootstrap blue) */
        .btn-primary {
            background-color: #36454f;
            border-color: #36454f;
        }

        .btn-primary:hover,
        .btn-primary:active,
        .btn-primary:first-child:active {
            background-color: #2b3740;
            border-color: #2b3740;
        }

        .btn-primary:focus,
        .btn-primary:focus-visible {
            background-color: #2b3740;
            border-color: #2b3740;
            box-shadow: 0 0 0 0.2rem rgba(54, 69, 79, 0.4);
        }

        .form-control:focus {
            border-color: #36454f;
            box-shadow: 0 0 0 0.2rem rgba(54, 69, 79, 0.25);
        }

        a.text-decoration-none,
        .btn-link {
            color: #36454f;
        }

        a.text-decoration-none:hover,
        .btn-link:hover {
            color: #212529;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-center vh-100">
            <div class="card col-sm-4 col-md-4">
                <div class="card-title">
                    <div class="text-center mt-4">
                        <img src="{{ asset('assets/img/logo.jpg') }}" class="rounded-circle w-25" alt="logo">
                    </div>
                </div>
                <div class="card-body">
                    @yield('authContent')
                </div>
            </div>
        </div>
    </div>
</body>

</html>