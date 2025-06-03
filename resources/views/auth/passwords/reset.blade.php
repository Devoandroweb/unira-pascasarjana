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
                                                    <form method="POST" action="{{ route('password.update') }}"
                                                        id="form-reset-password">
                                                        @csrf

                                                        <input type="hidden" name="token" value="{{ $token }}">
                                                        <input type="hidden" name="email" value="{{ request('email') }}">
                                                        <div class="row mb-3">
                                                            <label for="password"
                                                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="password" type="password" class="form-control "
                                                                    name="password">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="password-confirm"
                                                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="password_confirmation" type="password"
                                                                    class="form-control" name="password_confirmation">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-0">
                                                            <div class="col-md-6 offset-md-4">
                                                                <button type="submit" class="btn btn-primary btn-submit" id="btn-submit">
                                                                    {{ __('Change Password') }}
                                                                </button>
                                                            </div>
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
                <span class="text-center">©
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
@endsection
@push('js')
    <script>
        $('#btn-submit').click(function(e) {
            e.preventDefault();
            var form = $("#form-reset-password");
            var _URL = form.attr('action');
            saveFormNotForModal(form, _URL, $(this), "POST").then(response => {
                window.location.href = response.data.redirect;
            });
        })
    </script>
@endpush
