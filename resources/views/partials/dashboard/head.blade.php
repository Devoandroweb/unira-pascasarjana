<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title> {{ Str::upper(settings()->get('website_name',env('APP_NAME')) ." || ". $title)}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ Storage::url(settings()->get('favicon')) ?? '' }}" class="favicon">

    <!-- include head css -->
    @include('partials.dashboard.css')
</head>
