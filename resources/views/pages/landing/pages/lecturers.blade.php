@extends('layouts.landing',['dt'=> true])
@section('content')
{{-- @dd($lecturers) --}}
    <header>
        <div class="content position-relative">
            <img class="img-cover" src="{{ URL::asset('landing/image/gedung-depan-unira.png') }}" alt="">
            <div class="backdrop"></div>
            <div class="content-body">
                <div class="content-text">
                    <h1 class="text-white">{{ __('Lecturers and Educators') }}</h1>
                </div>
            </div>
            <div class="scroll text-center text-white position-absolute" style="right: 1rem;top:40%; width:60px; z-index:13;">
                <div class="mouse m-auto"></div>
                <small class="fw-lighter">{{ __('Scroll down to read') }}</small>
            </div>
        </div>
    </header>


    <section>
        <div class="container-fluid p-3 p-md-5">
            <div class="row">
                <div class="col-12 col-md-9 mb-5" style="text-align: justify;">
                    <div class="owl-carousel mb-3 owl-theme owl-carousel-dosen-1">
                        @foreach ($lecturers as $lecturer)
                            <div class="item">
                                <div class="item-profile">
                                    <div class="card dosen w-100 border-0">
                                        <img src="{{ $lecturer->getPhoto() }}" class="card-img-top rounded-3 mb-0"
                                            alt="...">
                                        <div class="card-body px-0">
                                            <div class="d-flex align-items-center position-relative">
                                                <div class="w-100 position-relative" style="z-index: 1;">
                                                    <h6 class="fw-bold text-nowrap mb-0 marquee-container"><span
                                                            class="marquee">{{ $lecturer->name }}</span></h6>
                                                    <p class="small mb-0">{{ __(Str::ucfirst($lecturer->position)) }}</p>
                                                </div>
                                                <div class="ms-auto sosmed position-absolute">
                                                    @if ($lecturer->google_scholar)
                                                        <a href="{{ $lecturer->google_scholar }}" target="_blank"
                                                            class="rounded-circle float-end me-2 d-block p-1 text-center text-decoration-none text-white"
                                                            style="background: #14171A;width: 30px;height: 30px;">
                                                            <i class="fa-brands fa-google-scholar" ></i>
                                                        </a>
                                                    @endif
                                                    @if ($lecturer->sinta)
                                                        <a href="{{ $lecturer->sinta }}"
                                                            class="rounded-circle float-end me-2 d-block p-1 text-center text-decoration-none text-white"
                                                            style="background: #0c5b6c;width: 30px;height: 30px;">
                                                            <img src="{{ URL::asset('dashboard/images/sinta.png') }}"
                                                                alt="" target="_blank">
                                                        </a>
                                                    @endif
                                                    @if ($lecturer->journal)
                                                        <a href="{{ $lecturer->journal }}" target="_blank"
                                                            class="rounded-circle float-end me-2 d-block p-1 text-center text-decoration-none text-white"
                                                            style="background: #14171A;width: 30px;height: 30px;">
                                                            <i class="fa-solid fa-book-journal-whills"></i>
                                                        </a>
                                                    @endif
                                                    @if ($lecturer->instagram)
                                                        <a href="{{ $lecturer->instagram }}" target="_blank"
                                                            class="rounded-circle float-end me-2 d-block p-1 text-center text-decoration-none text-white"
                                                            style="background: #E1306C;width: 30px;height: 30px;">
                                                            <i class="fa-brands fa-instagram"></i>
                                                        </a>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="owl-carousel mb-3 owl-theme owl-carousel-dosen-2">
                        @foreach ($educators as $educator)
                            <div class="item">
                                <div class="item-profile">
                                    <div class="card dosen w-100 border-0">
                                        <img src="{{ $educator->getPhoto() }}" class="card-img-top rounded-3 mb-0"
                                            alt="...">
                                        <div class="card-body px-0">
                                            <div class="d-flex align-items-center position-relative">
                                                <div class="w-100 position-relative" style="z-index: 1;">
                                                    <h6 class="fw-bold text-nowrap mb-0 marquee-container"><span
                                                            class="marquee">{{ $educator->name }}</span></h6>
                                                    <p class="small mb-0">{{ __(Str::ucfirst($educator->position)) }}</p>
                                                </div>
                                                <div class="ms-auto sosmed position-absolute">
                                                    @if ($educator->facebook)
                                                        <a href="{{ $educator->facebook }}" target="_blank"
                                                            class="rounded-circle float-end d-block p-1 text-center text-decoration-none text-white"
                                                            style="background: #0f3c94;width: 30px;height: 30px;">
                                                            <i class="fa-brands fa-facebook-f"></i>
                                                        </a>
                                                    @endif
                                                    @if ($educator->instagram)
                                                        <a href="{{ $educator->instagram }}" target="_blank"
                                                            class="rounded-circle float-end me-2 d-block p-1 text-center text-decoration-none text-white"
                                                            style="background: #E1306C;width: 30px;height: 30px;">
                                                            <i class="fa-brands fa-instagram"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    @include('pages.landing.news.latest')
                </div>
            </div>
        </div>

    </section>
@endsection
