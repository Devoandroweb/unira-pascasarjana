@extends('layouts.app')
@section('content')
    <form action="{{ route('dashboard.profile.store') }}" method="post" enctype="multipart/form-data" id="form-user">
        <div class="row mt-4">
            @csrf
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="text-center w-75 m-auto">
                            <div class="__image-upload position-relative m-auto mb-3" style="width: 6rem;height: 6rem;">
                                <div class="rounded-circle m-auto bg-dark overflow-hidden"
                                    style="width: 6rem;height: 6rem;">
                                    <img id="user-image" src="{{ Auth::user()->getPhoto() }}" alt="user-image"
                                        class="w-100">
                                </div>
                                <button id="btn-chouse-image" type="button"
                                    class="btn-rounded position-absolute bottom-0 end-0 bg-danger text-white"
                                    style="width: 2rem;height: 2rem;z-index:999">
                                    <span class="mdi mdi-pencil-outline"></span>
                                </button>
                                <!-- Input file untuk unggah foto -->
                                <input type="file" id="upload-photo" name="photo" accept="image/*" class="d-none">
                            </div>
                        </div>
                        <div id="buttonSave" class="d-block shadow pb-3 ">
                            <button type="submit" class="btn btn-success btn-save w-100 mt-3">
                                <span class="mdi mdi-content-save-edit"></span> {{ __('Save') }}
                            </button>
                            {{-- <a href="{{ route('dashboard') }}" class="btn btn-light w-100">
                                <span class="mdi mdi-arrow-left-thick"></span>{{ __('Cancel') }}
                            </a> --}}
                        </div>
                    </div> <!-- end card-body -->
                </div>
              

            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="field-1" class="form-label">{{ __('Name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ Auth::user()->name }}"
                                        placeholder="{{ __('example') }} : Listanto Tri Utomo,S.Kom.,M.Kom.">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="field-1" class="form-label">{{ __('Username') }}</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        value="{{ Auth::user()->username }}" placeholder="{{ __('example') }} : author">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="field-1" class="form-label">{{ __('Email') }}</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        value="{{ Auth::user()->email }}"
                                        placeholder="{{ __('example') }} : ramakun72@gmail.com">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="field-1" class="form-label">{{ __('Password') }}</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('js')
    <script>
        $(".btn-save").click(function(e) {
            e.preventDefault();
            $(".badge-validate").remove()
            var responseSave = saveFormNotForModal($("#form-user"), "",
                $(this), "POST", true)

        });

        $('#btn-chouse-image').on('click', function() {
            $('#upload-photo').click();
        });

        $('#upload-photo').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#user-image').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
