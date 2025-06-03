@extends('layouts.app', ['dt' => true])
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-3">{{ $title }}</h3>

                    <div class="row mb-3">
                        <div class="col-12 text-end">
                            <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalForm">{{ __('Add') }}</a>
                            <a href="{{ route('dashboard.sliders.trash') }}"
                                class="btn btn-danger btn-sm">{{ __('Trash') }}</a>
                        </div>

                    </div>
                    <table id="datatable" class="table table-striped dt-responsive nowrap w-100"></table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    @widget('modal', ['title' => __($title), 'form' => 'pages.dashboard.slider.form', 'data' => [], 'type' => ''])
    @widget('delete', ['dt' => true])
@endsection
@push('js')
    <script>
        var _URL = "{{ route('datatable.sliders') }}"
        var _COLUMNS = [{
                title: '#',
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                title: '{{ __('Title') }}',
                data: 'title',
                className: "text-capitalize"
            },
            {
                title: '{{ __('Type') }}',
                data: 'type',
                className: "text-capitalize"
            },
            {
                title: '{{ __('Action') }}',
                data: 'action',
            },
        ];

        var _DATATABLE = setDataTable(_URL, _COLUMNS);

        $("#btn-submit").click(function(e) {
            e.preventDefault();
            var form = $("#slider-form");
            saveForm(form, form.attr('action'), $('#modalForm'), 'POST', true).then(response =>  {
                $("#input-file").addClass("d-none");
                $("#input-url").addClass("d-none");
            });
        });



        function attactEdit(modal, response) {
            modal.find("input[name=id]").val(response.data?.slider.id);
            modal.find("input[name=title]").val(response.data?.slider.title);
            let sliderType = response.data?.slider.type;

            // Set the selected type in the dropdown
            modal.find("select[name=type]").val(sliderType);

            // Reset visibility and content
            modal.find('#video').addClass('d-none');
            modal.find('#image').addClass('d-none');
            modal.find('#image-preview').attr('src', '');
            modal.find('#video-preview').attr('src', '');
            if (sliderType === 'video') {
                modal.find("input[name=url]").val(response.data?.slider.url);
                modal.find('#video').removeClass('d-none');
                modal.find('#input-url').removeClass('d-none');
                modal.find('#video-preview').attr('src', response.data.slider.url);
            } else if (sliderType === 'image') {
                modal.find('#image').removeClass('d-none');
                modal.find('#input-file').removeClass('d-none');
                modal.find('#image-preview').attr('src', response.data.file_url);
            }
        }
    </script>
@endpush
