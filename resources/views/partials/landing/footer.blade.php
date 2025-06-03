<footer>
    <div class="container-fluid bg-primary py-5 px-5 bg-green-soft"
        style="box-shadow: 0px 11px 38px -22px #080808b5 inset;">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 mb-5">
                    <img src="{{ Storage::url(settings()->get('website_logo')) ?? URL::asset('landing/image/logo-landing.png') }}"
                        alt="Logo" class="img-fluid">
                </div>
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-6 col-md-4 mb-5">
                            <h5 class="text-white fw-bold text-uppercase text-secondary">{{ __('LINK') }}</h5>
                            <ul class="list-group border-none lh-1">
                                <li class="list-group-item pb-0 border-0 text-white bg-transparent ps-0"><a
                                        class="text-white text-decoration-none"
                                        href="{{ route('home.page.index', 'lecturers-and-educators') }}">{{ __('Lecturers and Educators') }}</a>
                                </li>
                                <li class="list-group-item pb-0 border-0 text-white bg-transparent ps-0"><a
                                        class="text-white text-decoration-none"
                                        href="{{ route('home.page.index', 'kerjasama') }}">{{ __('Partners') }}</a>
                                </li>
                                <li class="list-group-item pb-0 border-0 text-white bg-transparent ps-0"><a
                                        class="text-white text-decoration-none"
                                        href="{{ route('home.news.index') }}">{{ __('News') }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-4 mb-5">
                            <h5 class="text-white fw-bold text-uppercase text-secondary">
                                {{ Str::upper(__('Directory')) }}</h5>
                            <ul class="list-group border-none lh-1">
                                <li class="list-group-item pb-0 border-0 text-white bg-transparent ps-0"><a
                                        class="text-white text-decoration-none"
                                        href="{{ route('home.page.index', 'seleksi-masuk') }}">{{ __('Entry selection') }}</a>
                                </li>
                                <li class="list-group-item pb-0 border-0 text-white bg-transparent ps-0"><a
                                        class="text-white text-decoration-none"
                                        href="{{ route('home.page.index', 'beasiswa') }}">{{ __('Scholarship') }}</a>
                                </li>
                                <li class="list-group-item pb-0 border-0 text-white bg-transparent ps-0"><a
                                        class="text-white text-decoration-none"
                                        href="{{ route('home.page.index', 'kalender-akademik') }}">{{ __('Academic Calendar') }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-4 mb-5">
                            <h5 class="text-white fw-bold text-uppercase text-secondary">{{ __("Study Program") }}</h5>
                            <ul class="list-group border-none lh-1">
                                <li class="list-group-item pb-0 border-0 text-white bg-transparent ps-0"><a
                                        class="text-white text-decoration-none" href="{{ route("home.page.index", "magister-pendidikan-agama-islam") }}">{{ __("Master of PAI") }}</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-4 mb-5">
                            <h5 class="text-white fw-bold text-uppercase text-secondary">{{ __('Location') }}</h5>
                            <div class="map-responsive">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.0190729226993!2d112.58455512891187!3d-8.099536684719242!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e789e6516231c09%3A0x10b1d40352cf08bb!2sUniversitas%20Islam%20Raden%20Rahmat!5e0!3m2!1sid!2sid!4v1728709104694!5m2!1sid!2sid"
                                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row info">
                <div class="col-12 col-md-6 mb-3 order-1">
                    <div class="d-flex gap-4">
                        <a href="{{ settings()->get('youtube', '#') }}" target="_blank">
                            <img width="34" src="{{ URL::asset('landing') }}/image/youtube.svg" alt="">
                        </a>
                        <a href="{{ settings()->get('instagram', '#') }}" target="_blank">
                            <img width="34" src="{{ URL::asset('landing') }}/image/instagram.svg" alt="">
                        </a>
                        <a href="{{ settings()->get('whatsapp') ? 'https://wa.me/' . whatsappFormat(settings()->get('whatsapp')) : '#' }}"
                            target="_blank">
                            <img width="34" src="{{ URL::asset('landing') }}/image/whatsapp.svg" alt="">
                        </a>
                    </div>
                </div>

                <div class="col-12 col-md-6 text-white order-2">
                    <a href="https://www.google.com/maps?q={{ urlencode(settings()->get('address')) }}"
                        class="text-white text-decoration-none" target="_blank">
                        <strong><i class="fa-solid fa-location-dot"></i></strong>
                        {{ settings()->get('address') ?? '' }}
                    </a>
                    <div class="row">
                        <div class="col-12 col-md-6 text-white order-3">
                            <div style="display: flex;">
                                <div>
                                    <a href="mailto:{{ settings()->get('email') ?? '' }}"
                                        style="color: white; text-decoration: none;" target="_blank">
                                        <i class="fas fa-envelope"></i> {{ settings()->get('email') ?? '' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 text-white order-3">
                            <div style="display: flex;">
                                <div>
                                    <a href="tel:{{ settings()->get('phone') ?? '' }}"
                                        style="color: white; text-decoration: none;" target="_blank">
                                        <i class="fas fa-phone"></i> {{ settings()->get('phone') ?? '' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</footer>

@include('partials.landing.js')
