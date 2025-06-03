@extends('layouts.auth')
@section('content')
<style>
    .bg-auth {
        background-image: url('{{ URL::asset('landing/image/logo unira.png') }}') !important;
        background-size: contain !important;
        background-position: center center !important;
        background-repeat: no-repeat !important;
        width: 100%; 
        height: 100%;
    }
</style>

    <div class="auth-maintenance d-flex align-items-center min-vh-100">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="auth-full-page-content d-flex">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100 py-0 py-xl-3">
                                {{-- <div class="text-center mb-4">
                                    <a href="/" class="">
                                        <img src="{{ asset('images/logo-dark.png') }}" alt="" height="22"
                                            class="auth-logo logo-dark mx-auto">
                                        <img src="{{ asset('images/logo-light.png') }}" alt="" height="22"
                                            class="auth-logo logo-light mx-auto">
                                    </a>
                                </div> --}}

                                <div class="card my-auto overflow-hidden">
                                    <div class="row g-0">
                                        <div class="col-lg-4">
                                            <div class="bg-overlay bg-white"></div>
                                            <div class="h-100 bg-auth align-items-end">
                                            </div>
                                        </div>

                                        <div class="col-lg-8">
                                            <div class="p-lg-5 p-4">
                                                <div>
                                                    <div class="text-center mt-1">
                                                        <h4 class="font-size-18">{{ __('Login Please') }}</h4>

                                                    </div>

                                                    <form action="{{ route('auth') }}" method="POST" class="auth-input">
                                                        @csrf
                                                        <div class="mb-2">
                                                            <label for="username"
                                                                class="form-label">{{ __('Username or email') }}</label>
                                                            <input type="text" class="form-control" id="username"
                                                                name="username"
                                                                placeholder="{{ __('Enter username or email') }}"
                                                                autocomplete="off">
                                                                @error('username')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="password-input">{{ __('Password') }}</label>
                                                            <input type="password" class="form-control" name="password"
                                                                placeholder="{{ __('Enter password') }}">
                                                                <a href="{{ route('forgot-password') }}" class="float-end mt-1">{{ __("Forgot  Password?") }}</a>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                name="remember" id="auth-remember-check">
                                                            <label class="form-check-label"
                                                                for="auth-remember-check">{{ __('Remember me') }}</label>
                                                        </div>
                                                        <div class="mt-3">
                                                            <button class="btn btn-primary w-100"
                                                                type="submit">{{ __('Sign in') }}</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->

                                <span class="mt-5 text-center">©
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script> Universitas Islam Raden Rahmat. Developer By <b>Era
                                        Infinity</b>
                                </span>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
    @widget('auth')
@endsection
