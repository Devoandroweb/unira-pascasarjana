@extends('layouts.landing',['dt'=> true])
@section('content')
<header>
    <div class="content position-relative">
        <img class="img-cover" src="{{URL::asset("landing")}}/image/gedung-depan-unira.png" alt="">
        <div class="backdrop"></div>
        <div class="content-body">
            <div class="content-text">
                {{-- <span class="badge rounded-pill text-bg-secondary py-2 px-3">{{ Informasi }}</span> --}}
                <h1 class="text-white">{{ __("News") }}</h1>
            </div>
        </div>
        <div class="scroll text-center text-white position-absolute" style="right: 1rem;top:40%; width:60px; z-index:13;">
            <div class="mouse m-auto"></div>
            <small class="fw-lighter">{{ __("Scroll down to read") }}</small>
        </div>
    </div>
    </header>
    <section>
        <div class="container-fluid news-newed p-5">
            <div class="row">
                <div class="col-12 col-md mb-5" style="text-align: justify;">
                    <h2 class="fw-bold">{{ __("Latest") }}</h2>
                    <div class="row">
                        @foreach ($news as $item)
                        <div class="col-12 col-md-4 mb-4">
                            <div class="item-news" style="height: 400px" onclick="window.location.assign(`{{ route('home.news.detail',$item->slug) }}`)">
                                <div class="thumbnail h-100">
                                    <img class="w-auto h-100" src="{{$item->getImage()}}" alt="">
                                </div>
                                <div class="content bg-gradient-primary">
                                    <div class="category">
                                        {{ $item->category->name ?? __('Uncategorised') }}
                                    </div>
                                    <div class="content-cover">
                                        <div class="date d-flex align-items-center">
                                            <img class="me-1" style="width: auto;" src="{{URL::asset('public/image/calendar.png')}}" alt="">
                                           {{$item->created_at->format("d/m/Y, H:i")}}
                                        </div>
                                        <h3 class="text-uppercase fw-bold">
                                           {{ $item->title }}
                                        </h3>
                                        <p class="description">
                                            {!! Str::words(strip_tags($item->content), 20, '...') !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
