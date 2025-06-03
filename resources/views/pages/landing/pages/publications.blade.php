@php
    $category = request()->query('category');    
@endphp
@extends('layouts.landing', ['dt' => true])
@section('content')
    <style>
        .pagination {
            --bs-pagination-disabled-bg: #ffffff
        }

        .active>.page-link,
        .page-link.active {
            background-color: var(--primary);
            border-color: var(--primary);
        }
    </style>
    <header>
        <div class="content position-relative">
            <img class="img-cover" src="{{ URL::asset('landing/image/gedung-depan-unira.png') }}" alt="">
            <div class="backdrop"></div>
            <div class="content-body">
                <div class="content-text">
                    @if($category!="ejournal")
                    <h1 class="text-white">{{$title." ". __(Str::ucfirst($category)) }}</h1>
                    @else
                    <h1 class="text-white">{{ __(Str::ucfirst($category)) }}</h1>
                    @endif
                </div>
            </div>
            <div class="scroll text-center text-white position-absolute"
                style="right: 1rem;top:40%; width:60px; z-index:13;">
                <div class="mouse m-auto"></div>
                <small class="fw-lighter">{{ __('Scroll down to read') }}</small>
            </div>
        </div>
    </header>
    <section>
        <div class="container-fluid p-3 p-md-5">
            <div class="row">
                <div class="col-12 col-md-12 mb-5" style="text-align: justify;">
                    @if($category!="ejournal")
                    <div class="card mb-3">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered table-hover"></table>
                        </div>
                    </div>
                    @else
                    @include('pages.landing.pages.ejournal')
                    @endif
                </div>
            </div>
        </div>

    </section>
    @push('js')
        <script>
            var _URL = "{{ route('datatable.home.publications') }}"
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
                    title: '{{ __('Author') }}',
                    data: 'author',
                    className: "text-capitalize"
                },
                {
                    title: '{{ __('Category') }}',
                    data: 'category',
                    className: "text-capitalize"
                },
                {
                    title: '{{ __('Published At') }}',
                    data: 'published',
                    className: "text-capitalize"
                },
                {
                    title: '{{ __('Action') }}',
                    data: 'action'
                }
            ];

            var _DATATABLE = setDataTable(_URL, _COLUMNS);
        </script>
    @endpush
@endsection
