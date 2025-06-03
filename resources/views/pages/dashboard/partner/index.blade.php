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
                            <a href="{{ route('dashboard.partners.trash') }}"
                                class="btn btn-danger btn-sm">{{ __('Trash') }}</a>
                        </div>

                    </div>
                    <table id="datatable" class="table table-striped dt-responsive nowrap w-100"></table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    @widget('modal', ['title' => __($title), 'form' => 'pages.dashboard.partner.form', 'data' => [], 'type' => ''])
    @widget('delete', ['dt' => true])
@endsection
@push('js')
    <script>
        var _URL = "{{ route('datatable.partners') }}"
        var _COLUMNS = [{
                title: '#',
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                title: '{{ __('Logo') }}',
                data: 'logo',
                className: "text-center"
            },
            {
                title: '{{ __('Partner Name') }}',
                data: 'partner_name',
                className: "text-capitalize"
            },
            {
                title: '{{ __('City Or Country') }}',
                data: 'city_or_country',
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
            var form = $("#partner-form");
            saveForm(form, form.attr('action'), $('#modalForm'), 'POST', true);
        })


        function attactEdit(modal, response) {
            modal.find("input[name=id]").val(response.data?.id);
            modal.find("input[name=partner_name]").val(response.data?.partner_name);
            modal.find("input[name=city_or_country]").val(response.data?.city_or_country);
        }
    </script>
@endpush
