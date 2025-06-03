@extends('layouts.landing',['dt'=> true])
@section('content')
<header>
    <div class="content position-relative">
        <img class="img-cover" src="{{$page->coverImage()}}" alt="">
        <div class="backdrop"></div>
        <div class="content-body">
            <div class="content-text">
                @if($page->category)
                <span class="badge rounded-pill text-bg-secondary py-2 px-3">{{$page->category->categories_name}}</span>
                @endif
                <h1 class="text-white">{{$page->title}}</h1>

            </div>
        </div>
        <div class="scroll text-center text-white position-absolute" style="right: 1rem;top:40%; width:60px; z-index:13;">
            <div class="mouse m-auto"></div>
            <small class="fw-lighter">{{ __("Scroll down to read") }}</small>
        </div>
    </div>
    </header>
    <section>
        <div class="container-fluid p-3 p-md-5">
            <div class="row">
                <div class="col-12 col-md-9 mb-5" style="text-align: justify;">
                    @if($page->vidio)
                    <iframe class="mb-3 rounded-2 vidio" width="100%"
                            src="{{$page->vidio}}"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                    </iframe>
                    @endif
                    @if($page->image)
                    <div class="text-center mb-3">
                        <img src="{{$page->image}}" class="img-fluid w-100 w-md-75 rounded-2" alt="">
                    </div>
                    @endif
                    <!-- DESCRIPTION -->
                    <div class="description text-justify">
                        {!!$page->content!!}
                    </div>
                    <!-- TABEL -->
                    @if($page->table)
                    <div class="card mb-3">
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-hover">
                                {!! $page->table !!}
                            </table>
                        </div>
                    </div>
                    @endif
                    <!-- list link -->
                    @foreach ($page->files as $files)
                    <div class="card card-body mb-3 item-download-document">
                        <div class="row">
                            <div class="col-12 col-md-8 mb-3 mb-md-0">
                                <div class="d-flex align-items-center">
                                    <div class="icon p-2 me-2">
                                        <i class="fa-regular fa-file" style="font-size: 35pt;"></i>
                                    </div>
                                    <div class="description">
                                        <div class="fw-bold">
                                            {{$files->file_name}}
                                        </div>
                                         <span class="small">{{ __("Size") }} &#x2022; {{$files->sizeFile()}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 d-flex align-items-center">
                                <a href="{{url('storage')}}/{{$files->path_file}}" target="__blank" class="btn btn-sm ms-2 btn-download btn-danger">
                                    <div>{{ __("View") }}</div>
                                    <div><i class="fa-solid fa-eye"></i></div>
                                </a>
                                <a href="{{url('storage')}}/{{$files->path_file}}" class="btn btn-sm ms-2 btn-download btn-primary">
                                    <div>{{ __("Download") }}</div>
                                    <div><i class="fa-solid fa-arrow-down"></i></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-12 col-md-3">
                    @include('pages.landing.news.latest')
                </div>
            </div>
        </div>

    </section>
  
@endsection
