@extends('errors::layout')
@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
@section('button')
<div class="mt-5 text-center">
    <a class="btn btn-primary waves-effect waves-light" href="/">{{ __("Back To Home") }}</a>
</div>
@endsection