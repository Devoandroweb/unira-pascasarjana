@extends('layouts.landing', ['dt' => true])
@section('content')
    @push('css')
        <style>
            .owl-nav {
                display: flex;
                justify-content: space-between;
                position: absolute;
                width: 100%;
                top: 50%;
            }

            .owl-nav .owl-prev,
            .owl-nav .owl-next {
                width: 50px;
                height: 50px;
                border: 1px solid #cbac5e;
                border-radius: 100px !important;
                background: transparent !important;
                margin: 0 1rem 0 1rem !important;

            }

            .owl-nav .owl-prev:hover,
            .owl-nav .owl-next:hover {
                background: rgba(255, 255, 255, 0.211) !important;
            }

            .owl-dots {
                position: absolute;
                bottom: 1rem;
                left: 0;
                right: 0;
            }

            button.owl-dot {
                border: none;
                background: none;
            }

            button.owl-dot span {
                background: #fff !important;
            }

            .ytp-show-cards-title,
            .ytp-watermark {
                display: none !important;
            }

            .no-pointer-events {
                pointer-events: none;
            }
        </style>
    @endpush
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/plyr@3.7.8/dist/plyr.css" />
    <section class="w-100 overflow-hidden">
        <div class="owl-carousel-slide owl-theme w-100">
            @if (settings()->get('slider_type') == 'image' || settings()->get('slider_type') == 'both')
                @foreach ($imageSlides as $image)
                    <div class="item">
                        <header>
                            <div class="content">
                                <img rel="preload" class="h-100" src="{{ Storage::url($image->file) }}" as="image">
                                <div class="backdrop"></div>
                                <div class="content-body">
                                    <div class="content-text">
                                        @if (app()->getLocale() == 'id')
                                            <h1 class="text-secondary">PASCASARJANA<br> <span
                                                    class="text-white">UNIRA MALANG</span></h1>
                                        @elseif(app()->getLocale() == 'en')
                                            <h1 class="text-white">UNIRA MALANG <br> <span class="text-secondary">POSTGRADUATE PROGRAM</span></h1>
                                        @endif
                                        <p class="text-white"
                                            style="display: -webkit-box;
                                    -webkit-line-clamp: 3; /* Membatasi hanya 3 baris */
                                    -webkit-box-orient: vertical;
                                    overflow: hidden;
                                    text-overflow: none;
                                    white-space: normal;">
                                            {{ settings()->get('description') }}
                                        </p>
                                    </div>
                                    <div class="content-button">
                                        <div class="row justify-content-center">
                                            <div class="col-12 col-md-6 text-md-end">
                                                <a href="{{ route('home.page.index', 'profil-singkat') }}"
                                                    class="btn btn-primary d-block d-md-inline mb-2">{{ __('About Pascasarjana') }}</a>
                                            </div>
                                            <div class="col-12 col-md-6 text-md-start">
                                                <a href="https://pmb.uniramalang.ac.id/" target="__BLANK"
                                                    class="btn btn-light d-block d-md-inline mb-2">{{ __('Submission Information') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </header>
                    </div>
                @endforeach
            @endif
            {{-- slide for vidio --}}

            @if (settings()->get('slider_type') == 'video' || settings()->get('slider_type') == 'both')
                @foreach ($videoSlides as $video)
                    <div class="item">
                        <header>
                            <div class="content plyr__video-embed" id="player" style="height: 100vh">
                                <iframe class="h-100 no-pointer-events"
                                    src="{{ convertYoutubeUrlToEmbed($video->url) }}?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0&showinfo=0"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture">
                                </iframe>


                                {{-- <div class="backdrop"></div> --}}
                            </div>
                        </header>
                    </div>
                @endforeach
            @endif
            {{-- end slide for vidio --}}
        </div>
    </section>
    <section>
        <div class="container-fluid information-akademic p-5">
            <h4 class="section-title fw-bold text-center mb-3">{{ __('Academic Information') }}</h4>
            <div class="section-body">
                <div class="row justify-content-center">
                    <div class="col-6 col-sm-6 col-md-2">
                        <div class="item-tools">
                            <div class="icon">
                                <a href="https://sima.uniramalang.ac.id/" target="__BLANK">
                                    <img loading="lazy" src="{{ URL::asset('/landing') }}/image/sima.png" alt="">
                                </a>
                            </div>
                            <div class="label">
                                {{ __('SIMA') }}
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-sm-6 col-md-2">
                        <div class="item-tools">
                            <div class="icon">
                                <a href="https://elearning.uniramalang.ac.id/" target="__BLANK">
                                    <img loading="lazy" src="{{ URL::asset('landing') }}/image/e-learning.png"
                                        alt="">
                                </a>
                            </div>
                            <div class="label">
                                {{ __('E-Learning') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-2">
                        <div class="item-tools">
                            <div class="icon">
                                <a href="https://penmaba.uniramalang.ac.id/" target="__BLANK">
                                    <img loading="lazy" src="{{ URL::asset('landing') }}/image/pmb.png" alt="">
                                </a>
                            </div>
                            <div class="label">
                                {{ __('New Student Registration') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-2">
                        <div class="item-tools">
                            <div class="icon">
                                <a href="https://kemahasiswaan.uniramalang.ac.id/" target="__BLANK">
                                    <img loading="lazy" src="{{ URL::asset('landing') }}/image/kemahasiswaan.png"
                                        alt="">
                                </a>
                            </div>
                            <div class="label">
                                {{ __('Student Affairs') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-2">
                        <div class="item-tools">
                            <div class="icon">
                                <a href="https://tracerstudy.uniramalang.ac.id/" target="__BLANK">
                                    <img loading="lazy" src="{{ URL::asset('/landing') }}/image/Alumni.png" alt="">
                                </a>
                            </div>
                            <div class="label">
                                {{ __('Alumni') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container-fluid welcome p-5" style="opacity: 0;">
            <div class="row">
                <div class="col-12 col-md-6 text-center">
                    <img src="{{ Storage::url(settings()->get('greeting_photo')) }}" class="img-fluid w-75" alt=""
                        srcset="">
                </div>
                <div class="col-12 col-md-6">
                    <h4 class="section-title fw-bold mb-3">
                        {{ __('Message from the Head of the Islamic Religious Education Masters Study Program') }}</h4>
                    <div>
                        {!! settings()->get('greeting') !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container-fluid news-newed p-5" style="opacity: 0;">
            <h4 class="section-title fw-bold mb-3">{{ __('Recent News') }}</h4>
            <div class="section-body">
                <div class="owl-carousel owl-theme slider-news-1 mb-3" style="border-radius: 8px;overflow: hidden;">
                    @foreach ($news as $index => $n)
                        <div class="item w-100">
                            <div class="item-news">
                                <div class="thumbnail">
                                    <img src="{{ $n->getImage() }}" alt="">
                                </div>
                                <div class="content bg-gradient-primary">
                                    <div class="category">
                                        {{ $n->category->name ?? __('Uncategorised') }}
                                    </div>
                                    <div class="content-cover">
                                        <div class="date d-flex align-items-center">
                                            <img loading="lazy" class="me-1" style="width: auto;"
                                                src="{{ URL::asset('landing') }}/image/calendar.png" alt="">
                                            {{ toDateIndo($n->created_at, false, false) }}
                                        </div>
                                        <h3 class="text-uppercase fw-bold">
                                            {{ $n->title, app()->getLocale() }}
                                        </h3>
                                        <p class="description">
                                            {!! Str::words(strip_tags($n->content), 20, '...'), app()->getLocale() !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($loop->iteration == 2)
                        @break
                    @endif
                @endforeach
            </div>
            <div class="owl-carousel owl-theme slider-news-2 mb-3" style="border-radius: 8px;overflow: hidden;">
                @foreach ($news as $index => $n)
                    <div class="item w-100">
                        <div class="item-news">
                            <div class="thumbnail">
                                <img src="{{ $n->getImage() }}" alt="">
                            </div>
                            <div class="content bg-gradient-primary">
                                <div class="category">
                                    {{ $n->category->name ?? __('Uncategorised'), app()->getLocale() }}
                                </div>
                                <div class="content-cover">
                                    <div class="date d-flex align-items-center">
                                        <img loading="lazy" class="me-1" style="width: auto;"
                                            src="{{ URL::asset('landing') }}/image/calendar.png" alt="">
                                        {{ toDateIndo($n->created_at, false, false) }}
                                    </div>
                                    <h3 class="text-uppercase fw-bold">
                                        {{ $n->title, app()->getLocale() }}
                                    </h3>
                                    <p class="description">
                                        {!! Str::words(strip_tags($n->content), 20, '...') !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col text-center">
                    <a href="{{ route('home.news.index') }}" class="btn btn-primary">
                        {{ __('All News') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container-fluid statistic py-4 px-4" style="opacity: 0;">
        <div class="section-body p-5 position-relative"
            style="
            /* height: 410px; */
            /* background-image: url(image/bg-statistic.png); */
            background-size: 100% 100%;
            background-repeat: no-repeat;
            border-radius: 18px;
            overflow: hidden;
            ">
            <!-- <img loading="lazy" src="" class="bg-statistic" alt=""> -->
            <div class="content">
                <h4 class="section-title text-white text-center fw-bold mb-3">{{ __('Statistic') }}</h4>
                <div class="row justify-content-center mx-0 mx-md-5">
                    <div class="col-6 col-md-3">
                        <div class="item-statistic">
                            <div class="icon">
                                <img loading="lazy" src="{{ URL::asset('landing') }}/image/statistic-prodi.png"
                                    alt="">
                            </div>
                            <div class="count" data-count="{{ settings()->get('number_of_study_program', 0) }}">0
                            </div>
                            <div class="label">{{ Str::upper(__('Study Program')) }}</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="item-statistic">
                            <div class="icon">
                                <img loading="lazy" src="{{ URL::asset('landing') }}/image/statistic-dosen.png"
                                    alt="">
                            </div>
                            <div class="count" data-count="{{ settings()->get('number_of_lecturers', 0) }}">0</div>
                            <div class="label">{{ Str::upper(__('Lecturer')) }}</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="item-statistic">
                            <div class="icon">
                                <img loading="lazy" src="{{ URL::asset('landing') }}/image/statistic-mahasiswa.png"
                                    alt="">
                            </div>
                            <div class="count" data-count="{{ settings()->get('number_of_students', 0) }}">0</div>
                            <div class="label">{{ Str::upper(__('Students')) }}</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="item-statistic">
                            <div class="icon">
                                <img loading="lazy" src="{{ URL::asset('landing') }}/image/statistic-alumni.png"
                                    alt="">
                            </div>
                            <div class="count" data-count="{{ settings()->get('number_of_alumni', 0) }}">0</div>
                            <div class="label">{{ Str::upper(__('Alumni')) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if ($partners->count() != 0)
    <section>
        <div class="container-fluid mou py-4 px-4 bg-white">
            <h4 class="section-title text-center fw-bold mb-3">{{ __('Domestic & Overseas MOU') }}</h4>
            <div class="section-body">
                <div class="row justify-content-center mou-1 mb-5">
                    @foreach ($partners as $index => $partner)
                        @if ($index <= 4)
                            <div class="col-2 d-flex align-items-center">
                                <img loading="lazy" width="120" src="{{ $partner->getLogo() }}" alt=""
                                    class="logo-fixed-size ms-auto">
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="row justify-content-center mou-2 mb-5">
                    @foreach ($partners as $index => $partner)
                        @if ($index > 5 && $index < 11)
                            <div class="col-2 d-flex align-items-center">
                                <img loading="lazy" width="120" src="{{ $partner->getLogo() }}" alt=""
                                    class="logo-fixed-size ms-auto">
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="owl-carousel owl-theme owl-carousel-mou-1 mb-3"
                    style="border-radius: 8px;overflow: hidden;">
                    @foreach ($partners as $index => $partner)
                        @if ($index % 2 == 0)
                            <!-- Menampilkan item dengan indeks genap -->
                            <div class="item text-center">
                                <img loading="lazy" src="{{ $partner->getLogo() }}" alt=""
                                    class="logo-fixed-size">
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="owl-carousel owl-theme owl-carousel-mou-2 mb-3"
                    style="border-radius: 8px;overflow: hidden;">
                    @foreach ($partners as $index => $partner)
                        @if ($index % 2 != 0)
                            <!-- Menampilkan item dengan indeks ganjil -->
                            <div class="item text-center">
                                <img loading="lazy" src="{{ $partner->getLogo() }}" alt=""
                                    class="logo-fixed-size">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>


    </section>
@endif

@if ($testimonials->count() > 0)
    <section>
        <div class="container-fluid testimoni py-5 px-5 bg-green-soft"
            style="box-shadow: 0px 11px 38px -22px #080808b5 inset;">
            <h4 class="section-title text-center fw-bold mb-3 mt-5">{{ __('Testimonials') }}</h4>
            <div class="section-body">
                <div class="owl-carousel owl-theme owl-carousel-testimoni mb-3">
                    <div class="odd-row">
                        @foreach ($testimonials as $index => $testimonial)
                            @if ($index % 2 == 0)
                                <div class="item">
                                    <div class="testimoni-card">
                                        <div class="author d-flex align-items-center">
                                            <img loading="lazy" class="rounded-circle mb-3 me-3" style="width: 70px;"
                                                src="{{ Storage::url($testimonial->photo) }}" alt="">
                                            <div class="author-name py-4">
                                                <h5 class="fw-bold mt-2">
                                                    {{ $testimonial->name }}
                                                </h5>
                                                <p>{{ $testimonial->position }}</p>
                                            </div>
                                        </div>
                                        <div class="description">
                                            <p>{{ $testimonial->content }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>


                    <div class="even-row">
                        @foreach ($testimonials as $index => $testimonial)
                            @if ($index % 2 != 0)
                                <div class="item">
                                    <div class="testimoni-card">
                                        <div class="author d-flex align-items-center">
                                            <img loading="lazy" class="rounded-circle mb-3 me-3" style="width: 70px;"
                                                src="{{ Storage::url($testimonial->photo) }}" alt="">
                                            <div class="author-name py-4">
                                                <h5 class="fw-bold mt-2">
                                                    {{ $testimonial->name }}
                                                </h5>
                                                <p>{{ $testimonial->position }}</p>
                                            </div>
                                        </div>
                                        <div class="description">
                                            <p>{{ $testimonial->content }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>
@endif
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/plyr@3.7.8/dist/plyr.polyfilled.js"></script>
<script>
    $(document).ready(function() {
        const player = new Plyr('#player', {
            muted: true,
        });

        function isScrolledIntoView(elem) {
            var docViewTop = $(window).scrollTop();
            var docViewBottom = docViewTop + $(window).height();

            var elemTop = $(elem).offset().top;
            var elemBottom = elemTop + $(elem).height();

            return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
        }



        function animateCounter() {
            $('.item-statistic .count').each(function() {
                var $this = $(this);
                if (!$this.hasClass('animatedFadeIn') && isScrolledIntoView($this)) {
                    $this.addClass('animatedFadeIn');
                    $this.prop('Counter', 0).animate({
                        Counter: $this.data('count')
                    }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function(now) {
                            $this.text(Math.ceil(now));
                        }
                    });
                }
            });
        }

        function animateInformasiAkademik() {
            var elem = $('.information-akademic').find(".item-tools");
            loopingWithDelay(elem, function(element) {
                $(element).addClass('animatedFadeIn');
                if (!$(element).hasClass('animatedFadeIn') && isScrolledIntoView($(element))) {
                    $(element).fadeIn(100); // Contoh animasi fade-in
                    // Implementasi animasi atau efek lain yang diinginkan
                }
            })
        }

        function animateNewsNewed() {
            var elem = $('.news-newed');
            elem.addClass('animatedFadeIn');
            if (!elem.hasClass('animatedFadeIn') && isScrolledIntoView(elem)) {
                console.log("show news");
                elem.fadeIn(2000); // Contoh animasi fade-in
                // Implementasi animasi atau efek lain yang diinginkan
            }
        }

        function animateStatistic() {
            var elem = $('.statistic');
            elem.addClass('animatedFadeIn');
            if (!elem.hasClass('animatedFadeIn') && isScrolledIntoView(elem)) {
                elem.fadeIn(2000); // Contoh animasi fade-in
                // Implementasi animasi atau efek lain yang diinginkan
            }
        }

        function animateWelcome() {
            var elem = $('.welcome');
            elem.addClass('animatedFadeIn');
            if (!elem.hasClass('animatedFadeIn') && isScrolledIntoView(elem)) {
                elem.fadeIn(2000); // Contoh animasi fade-in
                // Implementasi animasi atau efek lain yang diinginkan
            }
        }
        // Gabungkan fungsi-fungsi dalam satu event listener scroll
        $(window).on('scroll', function() {
            animateWelcome();
            animateInformasiAkademik();
            animateNewsNewed();
            animateStatistic();
            animateCounter();
        });

        // Panggil fungsi sekali untuk mengecek apakah elemen sudah terlihat saat page load
        animateWelcome();
        animateInformasiAkademik();
        animateNewsNewed();
        animateStatistic();
        animateCounter();
    });
</script>
@endpush
