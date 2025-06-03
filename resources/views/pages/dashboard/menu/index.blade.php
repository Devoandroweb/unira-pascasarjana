@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title mb-3">{{ $title }}</h3>
                {!! Menu::render() !!}
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection
@push('js')
    {!! Menu::scripts() !!}
@endpush