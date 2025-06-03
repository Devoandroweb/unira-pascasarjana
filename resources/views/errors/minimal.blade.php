<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico') }}">

    <!-- include head css -->
    <!-- Layout config Js -->
    <script src="{{ URL::asset('js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ URL::asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ URL::asset('css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- IziToast-->
    <link href="{{ URL::asset('libs/iziToast/iziToast.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="auth-error d-flex align-items-center min-vh-100">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div>
                        <div class="text-center mb-4">
                            <div class="mt-5">
                                <h1 class="error-title mt-5"><span> @yield('code')</span></h1>
                                <h4 class="mt-2 text-uppercase mt-4"> @yield('message')</h4>
                            </div>

                            {{-- <div class="mt-5 text-center">
                                <a class="btn btn-primary waves-effect waves-light" href="index">Back to Dashboard</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JS -->
    <!-- JAVASCRIPT -->
    <script src="{{ URL::asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ URL::asset('libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ URL::asset('libs/node-waves/waves.min.js') }}"></script>
    <!-- Icon -->
    <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>
    <!-- App js -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ URL::asset('libs/iziToast/iziToast.min.js') }}"></script>
    <!-- Custom js -->
    <script src="{{ URL::asset('js/support/loading.js') }}"></script>
    <script src="{{ URL::asset('js/support/save.js') }}"></script>
    <script src="{{ URL::asset('js/support/custom.js') }}"></script>
    <script src="{{ URL::asset('js/support/moment.min.js') }}"></script>
</body>

</html>
