<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ Storage::url(settings()->get('favicon')) ?? '' }}" class="favicon">
    <title>{{ Str::upper(settings()->get('website_name')) ?? 'PASCASARJANA' }} || UNIVERSITAS ISLAM RADEN RAHMAT MALANG
    </title>
    @include('partials.landing.css')
</head>
<style>
    .lang-flag {
        width: 20px;
        height: 16px;
        object-fit: cover;
    }
</style>
<div class="container-fluid px-2 py-1 px-md-5 py-md-2 bg-secondary">
    <div class="d-flex align-items-center gap-3 mx-0 mx-md-3 ms-auto">
        <div class="ms-auto __dropdown text-primary">
            <div class="__dropdown-head text-white">
                @php
                    $flag = app()->getLocale() == 'id' ? 'indonesia.png' : 'english.png';
                @endphp
                <img class="me-1 lang-flag" src="{{ URL::asset('landing/image/' . $flag) }}" alt="">
                {{ app()->getLocale() == 'id' ? 'IND' : 'ENG' }}
            </div>
            <div class="__dropdown-body bg-white" style="border: 1px solid white;">
                <div class="__dropdown-items">
                    <a href="{{ route('setLocale', ['locale' => 'id']) }}"
                        style="text-decoration: none;  color: inherit; ">
                        <img src="{{ URL::asset('landing') }}/image/indonesia.png" alt="" class="lang-flag">
                        INDONESIA
                    </a>
                </div>
                <div class="__dropdown-items">
                    <a href="{{ route('setLocale', ['locale' => 'en']) }}"
                        style="text-decoration: none;  color: inherit; ">
                        <img src="{{ URL::asset('landing') }}/image/english.png" alt="" class="lang-flag">
                        ENGLISH
                    </a>
                </div>
            </div>
        </div>
        <a href="{{ settings()->get('youtube', '#') }}" class="text-white" target="__blank">
            <i class="fa-brands fa-youtube"></i>
        </a>
        <a href="{{ settings()->get('instagram', '#') }}" class="text-white" target="__blank">
            <i class="fa-brands fa-instagram"></i>
        </a>
        <a href="{{ settings()->get('whatsapp') ? 'https://wa.me/' . whatsappFormat(settings()->get('whatsapp')) : '#' }}"
            class="text-white" target="__blank">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
    </div>
</div>
