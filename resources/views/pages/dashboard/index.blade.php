@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-md flex-shrink-0">
                            <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                <i class="mdi mdi-newspaper"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 overflow-hidden ms-4">
                            <p class="text-muted text-truncate font-size-15 mb-2"> {{ __('Total News') }}</p>
                            <h3 class="fs-4 flex-grow-1 mb-3"><span
                                    class="text-muted font-size-16">{{ $news->count() . ' ' . __('News') }}</span>
                            </h3>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @can('admin')
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                    <i class="mdi mdi-account"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden ms-4">
                                <p class="text-muted text-truncate font-size-15 mb-2"> {{ __('Total User') }}</p>
                                <h3 class="fs-4 flex-grow-1 mb-3"><span
                                        class="text-muted font-size-16">{{ $user->count() . ' ' . __('User') }}</span>
                                </h3>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-md flex-shrink-0">
                            <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                <i class="mdi mdi-account"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 overflow-hidden ms-4">
                            <p class="text-muted text-truncate font-size-15 mb-2"> {{ __('Total Visitor') }}</p>
                            <h3 class="fs-4 flex-grow-1 mb-3"><span
                                    class="text-muted font-size-16">{{ $visitor->count() . ' ' . __('Visitor') }}</span>
                            </h3>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END ROW -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0 align-items-center d-flex pb-0">
                    <h4 class="card-title mb-0 flex-grow-1">{{ __('Visitor Statistics') }}</h4>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div id="line_column_chart" class="apex-charts" dir="ltr">
                            {!! $chart->container() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- END ROW -->
@endsection
@push('js')
{!! $chart->script() !!}
@endpush

