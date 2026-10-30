<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>KSB | Login Page</title>

    <!--begin::Theme Init (prevents flash of incorrect theme on load, #6043)-->
    <script>
        (() => {
            'use strict';
            const STORAGE_KEY = 'lte-theme';
            let stored = null;
            try {
                stored = localStorage.getItem(STORAGE_KEY);
            } catch {
                // localStorage may be unavailable (private mode, sandboxed iframe).
            }
            const prefersDark = globalThis.matchMedia('(prefers-color-scheme: dark)').matches;
            // Mirror the resolution in _scripts.astro: explicit "dark"/"light" win,
            // otherwise ("auto" or unset) fall back to the OS preference.
            let resolved = 'light';
            if (stored === 'dark' || stored === 'light') {
                resolved = stored;
            } else if (prefersDark) {
                resolved = 'dark';
            }
            document.documentElement.setAttribute('data-bs-theme', resolved);
            document.documentElement.style.colorScheme = resolved;
        })();
    </script>
    <!--end::Theme Init-->

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="{{ asset('template/css/adminlte.min.css') }}" as="style" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
        onload="this.media = 'all'" />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <link rel="stylesheet" href="{{ asset('template/css/adminlte.min.css') }}" />
    {{-- logo --}}
    <link rel="shortcut icon" href="{{ asset('img/logo-ksb.png') }}">
    <link rel="icon" href="{{ asset('img/logo-ksb.png') }}">
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="login-page bg-body-secondary">
    <main class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header p-2">
                <center>
                    <img src="{{ asset('img/logo ksb lengkap.png') }}" alt="Logo" style="max-width: 70%">
                </center>
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silahkan masuk untuk mengakses aplikasi sebagai admin</p>

                <form action="/login" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="input-group mb-2">
                        <div class="form-floating">
                            <input id="email" name="email" type="email" class="form-control" required
                                value="{{ old('email') }}" autocomplete="off" autofocus />
                            <label for="email">Email</label>
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-envelope"></span>
                        </div>
                    </div>


                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Small</span>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-sm">
                    </div>


                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>


                    <div class="input-group mb-2">
                        <div class="form-floating">
                            <input id="password" name="password" type="password" class="form-control" placeholder=""
                                autocomplete="off" required />
                            <label for="password">Password</label>
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill" id="lock" onclick="showPw()"></span>
                        </div>
                    </div>

                    <div class="form-group m-2">
                        <div class="hasil_refereshrecapcha d-inline">
                            {!! captcha_img('math') !!}
                        </div>
                        {{-- refresh captcha --}}
                        <a class="btn btn-outline-secondary" style="margin: 10px;" href="javascript:void(0)"
                            onclick="refreshCaptcha()">
                            <span>
                                <i class="bi bi-arrow-clockwise"></i>
                            </span>
                        </a>
                    </div>

                    <div class="form-group mb-2">
                        <div class="form-floating">
                            <input id="captcha" name="captcha" type="text"
                                class="form-control @error('captcha') is-invalid @enderror" placeholder=""
                                autocomplete="off" required />
                            <label for="captcha">Captcha</label>
                        </div>

                        @error('captcha')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <br><br>
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-8 d-inline-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="remember" />
                                <label class="form-check-label" for="remember"> Remember Me </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!--end::Row-->
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </main>
    <!-- /.login-box -->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <script src="{{ asset('template/js/adminlte.min.js') }}"></script>

    <!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

            // Disable OverlayScrollbars on mobile devices to prevent touch interference
            const isMobile = window.innerWidth <= 992;

            if (
                sidebarWrapper &&
                OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
                !isMobile
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>

    <script>
        function refreshCaptcha() {
            fetch('/refereshcapcha')
                .then(response => response.text())
                .then(html => {
                    document.querySelector('.hasil_refereshrecapcha').innerHTML = html;
                })
                .catch(() => alert('Try Again.'));
        }



        function showPw() {
            var input = document.getElementById("password");
            var lock = document.getElementById("lock");
            if (input.type == "password") {
                lock.classList.remove("bi-lock-fill");
                lock.classList.add("bi-unlock-fill");
                input.type = "text";
            } else {
                lock.classList.remove("bi-unlock-fill");
                lock.classList.add("bi-lock-fill");
                input.type = "password";
            }
        }
    </script>

    {{-- Sweet Alert Pesan Gagal --}}
    @if (session('loginError'))
        <script>
            Swal.fire({
                title: 'Gagal Login!',
                html: 'User atau password yang Anda masukan salah!',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
</body>
<!--end::Body-->

</html>
