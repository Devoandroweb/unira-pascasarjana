@extends('layouts.app', ['dt' => true])
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-3">{{ $title }}</h3>

                    <div class="row mb-3">
                        <div class="col-12 text-end">
                            <a href="{{ route('dashboard.news.create') }}" class="btn btn-primary btn-sm"><i class="mdi mdi-plus me-1"></i>{{ __('Create News') }}</a>
                            <a href="{{ route('dashboard.news.trash') }}" class="btn btn-danger btn-sm">{{ __('Trash') }}</a>
                        </div>

                    </div>
                    <table id="datatable" class="table table-striped dt-responsive nowrap w-100"></table>
                   
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    @widget('delete',['dt'=> true])
@endsection
@push('js')
    <script>
        var _URL = "{{ route('datatable.news') }}"
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
                title: '{{ __('Category') }}',
                data: 'category',
                className: "text-capitalize"
            },
            {
                title: '{{ __('Tags') }}',
                data: 'tags',
                className: "text-capitalize"
            },
            {
                title: '{{ __('Author') }}',
                data: 'author.name',
                className: "text-capitalize"
            },
            {
                title: '{{ __('Created At') }}',
                data: 'created_at',
                className: "text-capitalize"
            },
            {
                title: '{{ __('Action') }}',
                data: 'action',
            },
        ];

        var _DATATABLE = setDataTable(_URL, _COLUMNS);

      
    </script>
@endpush
