<div class="__navbar">
    <nav class="navbar navbar-expand-lg px-0 py-1 px-md-5 py-md-2 bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{ 'storage/' . settings()->get('website_logo') ?? URL::asset('landing/image/logo-landing.png') }}"
                    alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-0 gap-md-4 text-white">

                    {{-- Ambil Dari Menu Management --}}
                    @php
                        $menus = getMenu();
                    @endphp
                    @if ($menus)
                        @foreach ($menus as $mn)
                            @if ($mn['child'])
                                <li class="nav-item">
                                    <a class="nav-link text-primary" href="#">
                                        <div class="ms-auto __dropdown text-white">
                                            <div class="__dropdown-head text-uppercase"
                                                id="dropdown-head-{{ $mn['id'] }}">
                                                {{ __($mn['label']) }}
                                            </div>
                                            <div class="__dropdown-body bg-grey-200">
                                                @foreach ($mn['child'] as $child)
                                                    <div onclick="window.location.assign('{{ $child['link'] }}')"
                                                        class="__dropdown-items text-primary ps-3 pe-5">
                                                        {{ __($child['label']) }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase" aria-current="page" href="{{ $mn['link'] }}">
                                        {{ __($mn['label']) }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endif



                    <li class="nav-item __input-search-link">
                        <div class="backdrop"></div>
                        <a class="nav-link" href="#search">
                            <img src="{{ URL::asset('landing') }}/image/search.png" alt="">
                        </a>
                        <div class="position-relative">
                            <div class="__input-search">
                                <form action="{{ route("home.news.index") }}" method="GET" class="input-group">
                                    <span class="input-group-text p-2 bg-white" id="basic-addon1">
                                        <img src="{{ URL::asset('landing') }}/image/search-grey.png" alt="">
                                    </span>
                                    <input type="text" name="q" class="form-control ps-0 border-0" placeholder="{{ __('Search News') }}"
                                        aria-label="Search" aria-describedby="basic-addon1">
                                    <span class="input-group-text p-2 bg-white" id="close-search">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </span>
                                </form>
                            </div>
                        </div>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
</div>
@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil URL halaman saat ini
            var currentUrl = window.location.href; // Gunakan href agar termasuk hash jika ada

            // Ambil semua elemen __dropdown-items dan nav-link
            var submenuItems = document.querySelectorAll('.__dropdown-items');
            var parentMenuItems = document.querySelectorAll('.nav-link');

            // Fungsi untuk mengaktifkan submenu dan induk menu
            function setActiveMenu(items) {
                let hasActiveSubmenu = false;

                items.forEach(function(item) {
                    var href = item.getAttribute('onclick') || '';
                    var extractedUrl = href.match(/window\.location\.assign\('(.+?)'\)/);

                    if (extractedUrl) {
                        var itemUrl = extractedUrl[1];
                        // Cek jika URL item sama dengan URL saat ini
                        if (itemUrl === currentUrl) {
                            item.classList.add('active'); // Aktifkan submenu
                            hasActiveSubmenu = true;
                        }
                        console.log(itemUrl);
                        console.log(currentUrl);
                        
                    }
                });

                // Jika ada submenu yang aktif, aktifkan juga menu induk
                if (hasActiveSubmenu) {
                    submenuItems.forEach(function(item) {
                        var parentDropdown = item.closest('.__dropdown');
                        if (parentDropdown) {
                            // Temukan elemen 'nav-item' yang sesuai
                            var parentLi = parentDropdown.closest('li.nav-item');
                            console.log(parentLi);
                            
                            if (parentLi) {
                                var parentDropdownHead = parentLi.querySelector('.__dropdown-head');
                                console.log(parentDropdownHead);
                                
                                if (parentDropdownHead) {
                                    console.log('Activating Parent Dropdown Head:', parentDropdownHead);
                                    parentDropdownHead.classList.add('active');
                                }
                            }
                        }
                    });
                }
            }

            // Aktifkan submenu
            setActiveMenu(submenuItems);

            // Aktifkan menu utama jika tidak ada submenu
            parentMenuItems.forEach(function(item) {
                var href = item.getAttribute('href');
                if (href && href === currentUrl) {
                    item.classList.add('active');
                }
            });
        });
    </script>
@endpush
