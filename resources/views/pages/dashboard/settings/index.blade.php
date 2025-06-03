@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">

            <h4 class="card-title mb-4">{{ $title }}</h4>

            <!-- Nav tabs -->
            <ul class="nav nav-pills nav-justified" role="tablist">
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link active" data-bs-toggle="tab" href="#general" role="tab">
                        <span class="d-block d-sm-none"><i class="fas fa-globe"></i></span>
                        <span class="d-none d-sm-block">{{ __('General') }}</span>
                    </a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link" data-bs-toggle="tab" href="#display" role="tab">
                        <span class="d-block d-sm-none"><i class="fas fa-desktop"></i></span>
                        <span class="d-none d-sm-block">{{ __('Display') }}</span>
                    </a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link" data-bs-toggle="tab" href="#greetings" role="tab">
                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                        <span class="d-none d-sm-block">{{ __('Greetings') }}</span>
                    </a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    {{-- <a class="nav-link" data-bs-toggle="tab" href="#profile-1" role="tab">
                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                        <span class="d-none d-sm-block">Profile</span>
                    </a> --}}
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content p-3 text-muted mt-4">
                <div class="tab-pane active" id="general" role="tabpanel">
                    @include('pages.dashboard.settings.panels.general')
                </div>
                <div class="tab-pane" id="display" role="tabpanel">
                    @include('pages.dashboard.settings.panels.display')
                </div>
                <div class="tab-pane" id="greetings" role="tabpanel">
                    @include('pages.dashboard.settings.panels.greetings')
                </div>
                <div class="tab-pane" id="settings-1" role="tabpanel">

                </div>
            </div>
        </div>
    </div>
@endsection
