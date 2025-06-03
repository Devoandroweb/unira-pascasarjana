<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ Storage::url(settings()->get('favicon')) ?? URL::asset('landing/image/logo-landing.png') }}"
                    alt="logo-sm-dark" height="28">
            </span>
            <span class="logo-lg">
                <img src="{{ Storage::url(settings()->get('website_logo')) ?? URL::asset('landing/image/logo-landing.png') }}"
                    alt="logo-dark" height="30">
            </span>
        </a>

        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ Storage::url(settings()->get('favicon')) ?? URL::asset('landing/image/logo-landing.png') }}"
                    alt="logo-sm-light" height="28">
            </span>
            <span class="logo-lg">
                <img src="{{ Storage::url(settings()->get('website_logo')) ?? URL::asset('landing/image/logo-landing.png') }}"
                    alt="logo-light" height="30">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn"
        id="vertical-menu-btn">
        <i class="ri-menu-2-line align-middle"></i>
    </button>

    <div data-simplebar class="vertical-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">{{ __(Auth::user()->role) }}</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="mdi mdi-home"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>


                @can('admin')
                    <li>
                        <a href="{{ route('dashboard.menu-management.index') }}" class="waves-effect">
                            <i class="mdi mdi-grid"></i>
                            <span>{{ __('Menu Management') }}</span>
                        </a>
                    </li>
                    <li class="menu-title">{{ __('Pages') }}</li>

                    <li>
                        <a href="{{ route('dashboard.pages.index') }}" class="waves-effect">
                            <i class="mdi mdi-monitor"></i>
                            <span>{{ __('Pages') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.page-category.index') }}" class="waves-effect">
                            <i class="mdi mdi-monitor"></i>
                            <span>{{ __('Categories') }}</span>
                        </a>
                    </li>
                @endcan

                {{-- <li class="menu-title">{{ __('Academic') }}</li> --}}

                {{-- <li>
                    <a href="{{ route("dashboard.achievements.index") }}" class="waves-effect">
                        <i class="mdi mdi-medal"></i>
                        <span>{{ __('Achievement') }}</span>
                    </a>
                </li> --}}


                <li class="menu-title">{{ __('News') }}</li>

                <li>
                    <a href="{{ route('dashboard.news.index') }}" class="waves-effect">
                        <i class="mdi mdi-newspaper"></i>
                        <span>{{ __('News') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.categories.index') }}" class="waves-effect">
                        <i class="mdi mdi-newspaper-variant-multiple-outline"></i>
                        <span>{{ __('Categories') }}</span>
                    </a>
                </li>


                @can('admin')
                    <li class="menu-title">{{ __('Other') }}</li>
                    <li>
                        <a href="{{ route('dashboard.master-data.lecturers.index') }}" class="waves-effect">
                            <i class="mdi mdi-school"></i>
                            {{ __('Lecturers and Educators') }}</a>
                    </li>
                    <li>

                        <a href="{{ route('dashboard.publications.index') }}" class="wafes-effect">
                            <i class="mdi mdi-book-education"></i>
                            {{ __('Publication') }}

                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.sliders.index') }}" class="waves-effect">
                            <i class="mdi mdi-tune-variant"></i>
                            <span>{{ __('Slider') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.partners.index') }}" class="waves-effect">
                            <i class="mdi mdi-handshake"></i>
                            <span>{{ __('Partners') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.testimonials.index') }}" class="waves-effect">
                            <i class="mdi mdi-star"></i>
                            <span>{{ __('Testimonials') }}</span>
                        </a>
                    </li>
                    <li>

                        <a href="{{ route('dashboard.master-data.users.index') }}" class="wafes-effect">
                            <i class="mdi mdi-account"></i>
                            {{ __('Users') }}

                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.settings.index') }}" class="waves-effect">
                            <i class="mdi mdi-cog"></i>
                            <span>{{ __('Settings') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.about.index') }}" class="waves-effect">
                            <i class="mdi mdi-information"></i>
                            <span>{{ __('About') }}</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="dropdown px-3 sidebar-user sidebar-user-info">
        <button type="button" class="btn w-100 px-0 border-0" id="page-header-user-dropdown" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <img src="{{ Auth::user()->getPhoto() }}" class="img-fluid header-profile-user rounded-circle"
                        alt="">
                </div>

                <div class="flex-grow-1 ms-2 text-start">
                    <span class="ms-1 fw-medium user-name-text">{{ Auth::user()->name }}</span>
                </div>

                <div class="flex-shrink-0 text-end">
                    <i class="mdi mdi-dots-vertical font-size-16"></i>
                </div>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <a class="dropdown-item" href="{{ route('dashboard.profile.index') }}"><i
                    class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span
                    class="align-middle">{{ __('Profile') }}</span></a>
            <a class="dropdown-item" href="{{ route('logout') }}" id="logout"><i
                    class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i> <span
                    class="align-middle">{{ __('Logout') }}</span></a>
        </div>
    </div>

</div>
<!-- Left Sidebar End -->
