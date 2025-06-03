@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-3">{{ $title }}</h3>
                    <div class="d-flex flex-column align-items-start mb-3">
                        <div class="d-flex align-items-center mb-3 w-100">
                            <img src="{{ Storage::url(settings()->get('favicon')) }}" alt="" width="40"
                                class="me-4">
                            <div class="d-flex flex-column me-auto">
                                <h4 class="mb-0">{{ settings()->get('website_name') }}</h4>
                                <span class="text-muted"
                                    id="text-version">{{ __('Version') . ' ' . settings()->get('web_version') }}</span>
                            </div>
                            <button class="btn btn-primary ms-3" id="btn-update">{{ __('Update') }}</button>
                        </div>
                    </div>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection
@push('js')
    <script>
        // submit data
        var _LOADING = `<div class="w-100 d-flex align-items-center">
            <div class="m-auto d-flex align-items-center">
                ${buildLoadingBorder(
                    "20px",
                    "20px"
                )} <span class="ms-2">Tunggu sebentar ...</span>
            </div>
        </div>`;
        $("#btn-update").click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var btnOri = btn.html();
            btn.attr("disabled", "disabled");
            btn.html(_LOADING);
            $.ajax({
                type: "GET",
                url: "{{ route('dashboard.update-version') }}",
                dataType: "JSON",
                success: function(response) {
                    btn.removeAttr("disabled");
                    btn.empty();
                    btn.html(btnOri);
                    if (response.status) {
                        var textVersion = "{{ __('Version') }}";
                        $("#text-version").text(`${textVersion} ${response.version}`)
                        iziToast.success({
                            title: "{{ __('Success') }}!",
                            message: response.message,
                            position: "bottomCenter",
                        });
                        window.location.reload();
                    }
                }
            });
        });
    </script>
@endpush
