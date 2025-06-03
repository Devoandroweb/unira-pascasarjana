<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ Storage::url(settings()->get('favicon')) ?? '' }}" class="favicon">
    <title>@yield('title')</title>
    <!-- Layout config Js -->
    <script src="{{ URL::asset('dashboard/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ URL::asset('dashboard/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ URL::asset('dashboard/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ URL::asset('dashboard/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- IziToast-->
    <link href="{{ URL::asset('dashboard/libs/iziToast/iziToast.min.css') }}" id="app-style" rel="stylesheet"
        type="text/css" />
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

                            @yield('button')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
<!-- JAVASCRIPT -->
<script src="{{ URL::asset('dashboard/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('dashboard/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('dashboard/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ URL::asset('dashboard/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('dashboard/libs/node-waves/waves.min.js') }}"></script>
<!-- Icon -->
<script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>
<!-- App js -->
<script src="{{ asset('dashboard/js/app.js') }}"></script>
<script src="{{ URL::asset('dashboard/libs/iziToast/iziToast.min.js') }}"></script>
<!-- Custom js -->
<script>
    var translations = {
        "failed": "{{ __('Failed') }}",
        "success": "{{ __('Success') }}"
    }
</script>
<script src="{{ URL::asset('dashboard/js/support/loading.js') }}"></script>
<script src="{{ URL::asset('dashboard/js/support/save.js') }}"></script>
<script src="{{ URL::asset('dashboard/js/support/custom.js') }}"></script>
<script src="{{ URL::asset('dashboard/js/support/moment.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    moment.locale('id');
</script>

</html>
