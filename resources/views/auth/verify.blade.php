@extends('layouts.auth')
@section('content')
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
                                        <div class="col-lg-12">
                                            <div class="p-lg-5 p-4">
                                                <div>
                                                    <div class="text-center mt-1">
                                                        <h4 class="font-size-18">{{ __('Verify Your Email') }}</h4>

                                                    </div>
                                                    {{ __('Before proceeding, please check your email for a verification link.') }}
                                                    {{ __('If you did not receive the email click button bellow to resend link request') }}
                                                   
                                                </div>

                                                <div class="mt-4 text-center">
                                                    <form class="d-inline" method="POST"
                                                        action="{{ route('verification.resend') }}">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-primary btn-sm ">{{ __('Resend') }}</button>.
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
