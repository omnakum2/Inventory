<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>IMS</title>
    <link href="{{ asset('assets/img/logo.jpg') }}" rel="icon" class="rounded-circle">
    <style>
        body {
            background-image: url('/assets/img/bg.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }

        .container {
            margin-top: 7rem;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
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