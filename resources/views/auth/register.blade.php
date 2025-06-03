@extends('layouts.auth')
@section('content')
    <div class="auth-maintenance d-flex align-items-center min-vh-100">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="auth-full-page-content d-flex min-vh-100">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100 py-xl-3">
                                {{-- <div class="text-center mb-4">
                                    <a href="index" class="">
                                        <img src="{{ URL::asset('images/logo-dark.png') }}" alt="" height="22"
                                            class="auth-logo logo-dark mx-auto">
                                        <img src="{{ URL::asset('images/logo-light.png') }}" alt="" height="22"
                                            class="auth-logo logo-light mx-auto">
                                    </a>
                                </div> --}}

                                <div class="card my-auto overflow-hidden">
                                    <div class="row g-0">
                                        {{-- <div class="col-lg-12">
                                            <div class="bg-overlay bg-primary"></div>
                                            <div class="h-100 bg-auth align-items-end">
                                            </div>
                                        </div> --}}

                                        <div class="col-lg-12">
                                            <div class="p-lg-5 p-4">
                                                <div>
                                                    <div class="text-center mt-1">
                                                        <h4 class="font-size-18">{{ __('Register') }}</h4>
                                                    </div>

                                                    <form action="index" class="auth-input">
                                                        <div class="row form-group">
                                                            <div class="col-6">
                                                                <div class="mb-2">
                                                                    <label for="useremail"
                                                                        class="form-label">{{ __('Email') }}</label>
                                                                    <input type="email" class="form-control"
                                                                        id="email" name="email"
                                                                        placeholder="{{ __('Enter Email') }}"
                                                                        autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="mb-2">
                                                                    <label for="username"
                                                                        class="form-label">{{ __('Username') }}</label>
                                                                    <input type="text" class="form-control"
                                                                        id="username" name="username"
                                                                        placeholder="{{ __('Enter Username') }}"
                                                                        autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="mb-2">
                                                                    <label for="fullname"
                                                                        class="form-label">{{ __('Fullname') }}</label>
                                                                    <input type="text" class="form-control"
                                                                        id="fullname" name="fullname"
                                                                        placeholder="{{ __('Enter Fullname') }} "
                                                                        autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="password-input">{{ __('Password') }}</label>
                                                                    <input type="password" id="password" name="password"
                                                                        class="form-control"
                                                                        placeholder="{{ __('Enter Password') }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="password-input">{{ __('Password') }}</label>
                                                                    <input type="password" id="password"
                                                                        name="password_confirmmation" class="form-control"
                                                                        placeholder="{{ __('Repeat Password') }}">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="mt-3">
                                                            <button class="btn btn-primary"
                                                                type="submit">{{ __('Register') }}</button>
                                                        </div>
                                                        <div class="mt-4 text-center">
                                                            <p class="mb-0">{{ __('Already have an account ?') }} <a
                                                                    href="{{ route('login') }}"
                                                                    class="fw-medium text-primary">{{ __('Sign In') }}</a>
                                                            </p>
                                                        </div>
                                                    </form>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="mt-3 text-center">©
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
@endsection
