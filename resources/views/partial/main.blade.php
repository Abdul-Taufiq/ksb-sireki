<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--begin::Head-->

@include('partial.header')

@php
    $akses = '';
    if (auth('pelamar')->check()) {
        $akses = 'pelamar';
    }
@endphp

<body
    class="{{ $akses == 'pelamar' ? 'layout-fixed sidebar-expand-lg sidebar-mini sidebar-collapse bg-body-tertiary' : 'fixed-header layout-fixed sidebar-expand-lg bg-body-tertiary' }}">


    {{-- loading screen --}}
    <div id="loading-screen"
        style="display: none; justify-content: center; align-items: center; position: fixed; width: 100%; height: 100%; background: #000000bd;z-index: 9999; top: 0; left: 0;">
        <div
            style="display: flex; margin: auto; width: 100%; height: 100%; justify-content: center; align-items: center;">
            <img style="width: 250px;" src="{{ asset('img/loading_ksb.gif') }}" alt="Loading...">
        </div>
    </div>

    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body-secondary shadow">
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"
                            aria-label="Toggle sidebar">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <div id="timerApps" class="text-danger fw-bold" style="margin-top: 10px;"></div>
                    </li>
                </ul>
                <!--end::Start Navbar Links-->

                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">
                    <!--begin::Notifications Dropdown Menu-->
                    @auth('web')
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link" data-bs-toggle="dropdown" href="#"
                                aria-label="Notifications: 15 unread">
                                <i class="bi bi-bell-fill"></i>
                                <span class="navbar-badge badge text-bg-warning">15</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                                <span class="dropdown-item dropdown-header">15 Notifications</span>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="bi bi-envelope me-2"></i> 4 new messages
                                    <span class="float-end text-secondary fs-7">3 mins</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="bi bi-people-fill me-2"></i> 8 friend requests
                                    <span class="float-end text-secondary fs-7">12 hours</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                                    <span class="float-end text-secondary fs-7">2 days</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
                            </div>
                        </li> --}}
                    @endauth
                    <!--end::Notifications Dropdown Menu-->

                    <!--begin::Fullscreen Toggle-->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen" aria-label="Toggle fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit d-none"></i>
                        </a>
                    </li>
                    <!--end::Fullscreen Toggle-->

                    <!--begin::Color Mode Toggle (#6010)-->
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="bd-theme" aria-label="Toggle color scheme"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-sun-fill" data-lte-theme-icon="light"></i>
                            <i class="bi bi-moon-fill d-none" data-lte-theme-icon="dark"></i>
                            <i class="bi bi-circle-half d-none" data-lte-theme-icon="auto"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme"
                            style="--bs-dropdown-min-width: 8rem">
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="light" aria-pressed="false">
                                    <i class="bi bi-sun-fill me-2"></i>
                                    Light
                                    <i class="bi bi-check-lg ms-auto d-none"></i>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="dark" aria-pressed="false">
                                    <i class="bi bi-moon-fill me-2"></i>
                                    Dark
                                    <i class="bi bi-check-lg ms-auto d-none"></i>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center active"
                                    data-bs-theme-value="auto" aria-pressed="true">
                                    <i class="bi bi-circle-half me-2"></i>
                                    Auto
                                    <i class="bi bi-check-lg ms-auto d-none"></i>
                                </button>
                            </li>
                        </ul>
                    </li>
                    <!--end::Color Mode Toggle-->

                    <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ asset('img/icon_logo.png') }}" class="user-image rounded-circle shadow"
                                alt="{{ auth()->user()->nama }}"
                                style="max-width: 160px; max-width: 160px; background-color: white" />
                            @php
                                function shortenName($name, $maxLength = 15)
                                {
                                    if (strlen($name) > $maxLength) {
                                        $shortened = substr($name, 0, $maxLength) . '...';
                                        return $shortened;
                                    }
                                    return $name;
                                }
                            @endphp
                            <span class="d-none d-md-inline">{{ shortenName(Auth::user()->nama) }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--begin::User Image-->
                            <li class="user-header text-bg-primary">
                                <img src="{{ asset('img/icon_logo.png') }}" class="rounded-circle shadow"
                                    alt="{{ auth()->user()->nama }}"
                                    style="max-width: 160px; max-width: 160px; background-color: white" />
                                <p>
                                    {{ auth()->user()->nama }} <br> {{ Auth::user()->sub_jabatan }}
                                    <small>Terdaftar sejak
                                        {{ Auth::user()->created_at?->translatedFormat('d F Y') ?? '-' }}</small>
                                </p>
                            </li>
                            <!--end::User Image-->
                            <!--begin::Menu Body-->
                            {{-- <li class="user-body">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </div>
                                <!--end::Row-->
                            </li> --}}
                            <!--end::Menu Body-->
                            <!--begin::Menu Footer-->
                            <li class="user-footer">
                                {{-- <a href="#" class="btn btn-outline-secondary">Profile</a> --}}
                                @if (Auth::guard('pelamar')->check())
                                    <a href="#" class="btn btn-outline-danger float-end" id="logout_pelamar"
                                        data-data="{{ encrypt(Auth::guard('pelamar')->user()->id_pelamar) }}">
                                        Sign out
                                    </a>
                                @else
                                    <a href="#" class="btn btn-outline-danger float-end" id="logout"
                                        data-data="{{ encrypt(Auth::user()->id) }}">
                                        Sign out
                                    </a>
                                @endif
                            </li>

                            <!--end::Menu Footer-->
                        </ul>
                    </li>
                    <!--end::User Menu Dropdown-->
                </ul>
                <!--end::End Navbar Links-->
            </div>
        </nav>
        <!--end::Header-->

        {{-- pembagian sidebar per Session --}}
        @auth('web')
            @include('partial.sidebar')
        @endauth

        @auth('pelamar')
            @include('partial.sidebar-for-applicant')
        @endauth
        {{-- End pembagian sidebar per Session --}}

        <!--begin::App Main-->
        <main class="app-main">

            <!--begin::App Content Header-->
            <div class="app-content-header no-print">
                <div class="container-fluid">
                    <div class="card py-2 px-3 card-outline card-primary">
                        <div class="row">
                            <div class="col-sm-6">
                                <h1 class="mb-0 fs-3">{{ $title }}</h1>
                            </div>
                            <div class="col-sm-6 d-none d-sm-block">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb float-sm-end">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('home') }}"><i class="bi bi-houses"></i></a>
                                        </li>
                                        <li class="breadcrumb-item" aria-current="page">
                                            {{ $title }}
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::App Content Header-->

            <!--begin::App Content-->
            @yield('content')
            <!--end::App Content-->
        </main>
        <!--end::App Main-->


        <!--begin::fOOTER-->
        <footer class="app-footer">
            <!--begin::To the end-->
            <div class="float-end d-none d-sm-inline" style="margin-bottom: -15px !important">
                <ul class="d-flex">
                    <li class="nav-item d-none d-sm-block">
                        <a class="nav-link"
                            href="https://www.instagram.com/taufiq_fiq17?igsh=ZGJqdjBwbW9zeDc1&utm_source=qr"
                            target="__blank">About</a>
                    </li>
                    <li class="nav-item d-none d-sm-block">&nbsp; | &nbsp;</li>
                    <li class="nav-item d-none d-sm-block">
                        <a class="nav-link"
                            href="https://www.instagram.com/taufiq_fiq17?igsh=ZGJqdjBwbW9zeDc1&utm_source=qr"
                            target="__blank">Support</a>
                    </li>
                    <li class="nav-item d-none d-sm-block">&nbsp; | &nbsp;</li>
                    <li class="nav-item d-none d-sm-block">
                        <a class="nav-link"
                            href="https://www.instagram.com/taufiq_fiq17?igsh=ZGJqdjBwbW9zeDc1&utm_source=qr"
                            target="__blank">Puchase</a>
                    </li>
                    <li class="nav-item d-none d-sm-block">&nbsp; | &nbsp;</li>
                    <li class="nav-item d-none d-sm-block">Version 2.0.0</li>
                </ul>
            </div>
            <!--end::To the end-->
            <!--begin::Copyright-->
            <strong>
                <?php echo date('Y'); ?> © TSI -
                <a href="#" target="_blank" rel="noopener noreferrer"
                    style="font-weight: bold; text-decoration: none;" class="text-base">KSB SIREKI</a>
            </strong>
            <!--end::Copyright-->
        </footer>
        <!--end::App FOOTER-->

    </div>


    <!--begin::Script-->
    {{-- JAVASCRIPT CORE --}}
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    {{-- Bootstrap 5 Bundle sudah termasuk Popper --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    {{-- OverlayScrollbars --}}
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>

    {{-- CORE JS TEMPLATE --}}
    <script src="{{ asset('template/js/adminlte.min.js') }}"></script>

    {{-- Summernote --}}
    <script src="{{ asset('template/summernote/summernote-bs5.min.js') }}"></script>
    <script src="{{ asset('script/summernote-area.js') }}"></script>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- OVERLAY SCROLLBAR CONFIG --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const sidebarWrapper =
                document.querySelector('.sidebar-wrapper');

            const isMobile = window.innerWidth <= 992;

            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal !== 'undefined' &&
                OverlayScrollbarsGlobal.OverlayScrollbars &&
                !isMobile
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(
                    sidebarWrapper, {
                        scrollbars: {
                            theme: 'os-theme-light',
                            autoHide: 'leave',
                            clickScroll: true,
                        },
                    }
                );
            }
        });
    </script>

    {{-- SCRIPT --}}
    <script src="{{ asset('script/script-footer-lainnya.js') }}"></script>


    {{-- LOGOUT --}}
    <script>
        $(function() {
            $(document).on('click', '#logout', function(e) {
                e.preventDefault();

                const currentTheme =
                    document.documentElement.getAttribute(
                        'data-bs-theme'
                    );

                Swal.fire({
                    title: 'Apa Anda Yakin?',
                    text: 'Apakah Anda Ingin Keluar Dari Aplikasi?',
                    icon: 'question',

                    theme: currentTheme === 'dark' ?
                        'dark' : 'light',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya!',
                    cancelButtonText: 'Tidak'

                }).then((result) => {
                    if (!result.isConfirmed) {
                        return;
                    }

                    $.ajax({
                        url: '{{ route('logout') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            window.location.href = '/login';
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat logout.',
                                icon: 'error'
                            });
                        }
                    });

                });
            });

        });
    </script>


    {{-- LOGOUT PELAMAR/APPLICANT --}}
    <script>
        $(function() {
            $(document).on('click', '#logout_pelamar', function(e) {
                e.preventDefault();

                let data = $(this).data("data"); // ambil data-data (ID terenkripsi)

                const currentTheme = document.documentElement.getAttribute('data-bs-theme');

                Swal.fire({
                    title: 'Apa Anda Yakin?',
                    text: 'Apakah Anda Ingin Keluar Dari Aplikasi?',
                    icon: 'question',
                    theme: currentTheme === 'dark' ? 'dark' : 'light',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya!',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (!result.isConfirmed) {
                        return;
                    }

                    // 🔹 Hapus localStorage per user sebelum logout
                    Object.keys(localStorage).forEach(function(key) {
                        if (idPelamar && key.includes(idPelamar)) {
                            localStorage.removeItem(key);
                        }
                    });

                    Object.keys(localStorage).forEach(function(key) {
                        // cek apakah key diawali dengan "endTime_Apps"
                        if (key.startsWith("endTime_Apps")) {
                            localStorage.removeItem(key);
                        }
                    });

                    Object.keys(localStorage).forEach(function(key) {
                        // cek apakah key diawali dengan "endTimes_"
                        if (key.startsWith("endTimes_")) {
                            localStorage.removeItem(key);
                        }
                    });

                    // 🔹 Proses logout via AJAX
                    $.ajax({
                        url: '{{ route('pelamar.logout') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            data: data
                        },
                        success: function() {
                            window.location.href = '/tq/applicant/login';
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat logout.',
                                icon: 'error'
                            });
                        }
                    });
                });
            });
        });
    </script>


    {{-- SESSION SUCCESS --}}
    @if (session('AlertSuccess'))
        <script>
            Swal.fire({
                title: 'Sukses!',
                text: @json(session('AlertSuccess')),
                icon: 'success',
                theme: document.documentElement.getAttribute('data-bs-theme') === 'dark' ?
                    'dark' : 'light',
                confirmButtonText: 'OK'
            });
        </script>
    @endif


    {{--  SESSION ERROR --}}
    @if (session('AlertFail'))
        <script>
            Swal.fire({
                title: 'Failed!',
                text: @json(session('AlertFail')),
                icon: 'error',
                theme: document.documentElement.getAttribute('data-bs-theme') === 'dark' ?
                    'dark' : 'light',
                confirmButtonText: 'OK'
            });
        </script>
    @endif


    {{-- LIVEWIRE / PAGE SCRIPT --}}
    @stack('wire-script')
    @yield('script')

</body>
<!--end::Body-->

</html>
