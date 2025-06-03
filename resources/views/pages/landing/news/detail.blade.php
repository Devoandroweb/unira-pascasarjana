@extends('layouts.landing',['dt'=> true])
@section('content')
    <header>
        <div class="content position-relative">
            <img class="img-cover" src="{{ $news->getImage() }}" alt="">
            <div class="backdrop"></div>
            <div class="content-body">
                <div class="content-text">
                    <span class="badge rounded-pill text-bg-secondary py-2 px-3">{{ translate($newscategory->name ?? 'Uncategorised', app()->getLocale()) }}</span>
                    <h1 class="text-white">{{ translate($news->title, app()->getLocale()) }}</h1>
                    <div class="row gap-0 mb-3 d-none d-md-flex justify-content-center">
                        <div class="col-6 mb-2 col-md-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" class="btn w-100 btn-sm w-100 text-white" style="background: #0f3c94;" target="_blank">
                                <i class="fa-brands fa-facebook-f me-2"></i> {{ __("Share") }}
                            </a>
                        </div>
                        <div class="col-6 mb-2 col-md-3">
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{ urlencode($news->title) }}" class="btn w-100 btn-sm w-100 text-white" style="background: #14171A;" target="_blank">
                                <i class="fa-brands fa-x-twitter me-2"></i> {{ __("Post") }}
                            </a>
                        </div>
                        {{-- <div class="col-6 mb-2 col-md-3">
                            <a href="https://instagram.com/" class="btn w-100 btn-sm w-100 text-white" style="background: #E1306C;" target="_blank">
                                <i class="fa-brands fa-instagram me-2"></i> {{ __("Share") }}
                            </a>
                        </div> --}}
                        <div class="col-6 mb-2 col-md-3">
                            <a href="https://wa.me/?text={{ urlencode(Request::url()) }}" class="btn w-100 btn-sm w-100 text-white" style="background: #25D366;" target="_blank">
                                <i class="fa-brands fa-whatsapp me-2"></i> {{ __("Share") }}
                            </a>
                        </div>
                    </div>
                    <span class="text-white me-2">{!! str_replace(","," &#x2022;",toDateIndo($news->created_at, true, false)) !!}</span><i class="fa-solid fa-eye text-white me-2 fa-sm"></i><span class="text-white">{{ $news->viewer .' '. __("Viewers")  }}</span>
                </div>
                <div class="content-button ">
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
        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-12 col-md-9 mb-5" style="text-align: justify;">
                    <div class="mt-5">
                        {!! translate($news->content,app()->getLocale()) !!}
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    @include('pages.landing.news.latest')
                </div>
            </div>
        </div>

    </section>

    <div class="share-mobile">
        <div class="content">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" class="text-white" style="background: #0f3c94;"> {{ __("Share") }} <span class="icon"><i
                        class="fa-brands fa-facebook-f"></i></span></a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{ urlencode($news->title) }}" class="text-white" style="background: #14171A;"> {{ __("Post") }} <span class="icon"><i
                        class="fa-brands fa-x-twitter"></i></span></a>
            {{-- <a href="#" class="text-white" style="background: #E1306C;"> {{ __("Share") }} <span class="icon"><i
                        class="fa-brands fa-instagram"></i></span></a> --}}
            <a href="https://wa.me/?text={{ urlencode(Request::url()) }}" class="text-white" style="background: #25D366;"> {{ __("Share") }} <span class="icon"><i
                        class="fa-brands fa-whatsapp"></i></span></a>
        </div>
    </div>
@endsection
