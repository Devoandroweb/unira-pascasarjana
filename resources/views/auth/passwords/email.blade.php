@extends('layouts.auth')
@section('content')
    <div class="auth-maintenance d-flex align-items-center min-vh-100">
        {{-- <div class="bg-overlay bg-light"></div> --}}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="auth-full-page-content d-flex">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100 py-0 py-xl-3">
                                <div class="card my-auto overflow-hidden">
                                    <div class="row g-0">
                                        <div class="col-lg-12">
                                            <div class="p-lg-5 p-4">
                                                <div>
                                                    <div class="text-center mt-1">
                                                        <h4 class="font-size-18">{{ __('Reset Password') }}</h4>
                                                    </div>
                                                    <form method="POST" action="{{ route('forgot-password.send') }}">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="email"
                                                                class="form-label">{{ __('Email') }}</label>
                                                            <input id="email" type="email" class="form-control"
                                                                name="email" required autocomplete="email" autofocus>
                                                        </div>

                                                        <div class="mb-2">
                                                            <button type="submit" class="btn btn-primary">
                                                                {{ __('Send Password Reset Link') }}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                        </div>
                    </div>
                </div>
                <span  class="text-center">  &copy; <b>Copyright </b>
                    <script>
                        document.write(new Date().getFullYear())
                    </script> Universitas Islam Raden Rahmat. Developer By <b>Era
                        Infinity</b>
                </span>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
    @widget('auth')
@endsection
