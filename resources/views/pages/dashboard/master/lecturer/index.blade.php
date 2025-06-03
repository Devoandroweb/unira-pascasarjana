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
                            <a href="{{ route('dashboard.master-data.lecturers.trash') }}" class="btn btn-danger btn-sm">{{ __('Trash') }}</a>
                        </div>

                    </div>
                    <table id="datatable" class="table table-striped dt-responsive nowrap w-100"></table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    @widget('modal', ['title' => __($title), 'form' => 'pages.dashboard.master.lecturer.form', 'data' => [], 'type' => 'modal-lg'])
    @widget('delete',['dt'=> true])
@endsection
@push('js')
    <script>
        var _URL = "{{ route('datatable.lecturers') }}"
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
                title: '{{ __('Gender') }}',
                data: 'gender'
            },

            {
                title: '{{ __('Position') }}',
                data: 'position',
            },
            {
                title: '{{ __('Phone Number') }}',
                data: 'phone',
            },
            {
                title: '{{ __('Status') }}',
                data: 'is_user'
            },
            {
                title: '{{ __('Action') }}',
                data: 'action',
            },
        ];

        var _DATATABLE = setDataTable(_URL, _COLUMNS);

        $("#btn-submit").click(function(e) {
            e.preventDefault();
            var form = $("#lecturer-form");
            saveForm(form, form.attr('action'), $('#modalForm'), 'POST', true);
        })

        function attactEdit(modal, response) {
            var userForm = $("#user-section");
            var journalSection = $("#journal-section");
            modal.find("input[name=id]").val(response.data.id);
            modal.find("input[name=name]").val(response.data.name);
            modal.find("select[name=position]").val(response.data.position);
            modal.find("select[name=gender]").val(response.data.gender);
            modal.find("input[name=phone]").val(response.data.phone);
            modal.find("input[name=facebook]").val(response.data.facebook);
            modal.find("input[name=instagram]").val(response.data.instagram);
            modal.find("input[name=google_scholar]").val(response.data?.google_scholar);
            modal.find("input[name=sinta]").val(response.data?.sinta);
            modal.find("input[name=journal]").val(response.data?.journal);
            userForm.toggleClass("d-none", !response.data.user || Object.keys(response.data.user).length === 0);
            journalSection.toggleClass("d-none", response.data.position != 'lecturer');
            modal.find("select[name=role]").val(response.data?.user?.role);
            modal.find("input[name=email]").val(response.data?.user?.email);
            modal.find("input[name=username]").val(response.data?.user?.username);
            $("input[name=register]").prop("checked", !!response.data?.user);
        }
    </script>
@endpush
