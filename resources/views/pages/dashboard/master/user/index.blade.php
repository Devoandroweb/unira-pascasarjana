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
                            <a href="{{ route('dashboard.master-data.users.trash') }}" class="btn btn-danger btn-sm">{{ __('Trash') }}</a>
                        </div>

                    </div>
                    <table id="datatable" class="table table-striped dt-responsive nowrap w-100"></table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    @widget('modal', ['title' => __($title), 'form' => 'pages.dashboard.master.user.form', 'data' => [], 'type' => 'modal-lg'])
    @widget('delete',['dt'=> true])
@endsection
@push('js')
    <script>
        var _URL = "{{ route('datatable.users') }}"
        var _COLUMNS = [{
                title: '#',
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                title: '{{ __('Photo') }}',
                data: 'photo'
            },
            {
                title: '{{ __('Name') }}',
                data: 'name',
                className: "text-capitalize"
            },
            {
                title: '{{ __('Email') }}',
                data: 'email'
            },

            {
                title: '{{ __('Role') }}',
                data: 'role',
            },
            {
                title: '{{ __('Action') }}',
                data: 'action',
            },
        ];

        var _DATATABLE = setDataTable(_URL, _COLUMNS);

        $("#btn-submit").click(function(e) {
            e.preventDefault();
            var form = $("#user-form");
            saveForm(form, form.attr('action'), $('#modalForm'), 'POST', true);
        })

        
        function attactEdit(modal, response) {
            modal.find("input[name=id]").val(response.data.id);
            modal.find("input[name=name]").val(response.data?.name);          
            modal.find("select[name=role]").val(response.data?.role);
            modal.find("input[name=email]").val(response.data?.email);
            modal.find("input[name=username]").val(response.data?.username);
           
        }
    </script>
@endpush
