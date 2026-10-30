<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KSB | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css"
        integrity="sha512-ApSLB1Pd3/bZN8fWB/RG9YhN/7bd9Hkf3AGaE2mPfebjrxagjuBtx2GcgdqIlJkUzwylBo61r9Xa9NmgBI0swA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- icheck bootstrap -->
    {{-- <link rel="stylesheet" href="{{ asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/css/adminlte.min.css') }}">

    {{-- logo --}}
    <link rel="shortcut icon" href="{{ asset('img/logo-ksb.png') }}">
    <link rel="icon" href="{{ asset('img/logo-ksb.png') }}">
</head>

<body class="hold-transition login-page" style="background-color: rgb(220, 220, 220)">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="{{ asset('img/logo ksb lengkap.png') }}" alt="icon" style="width: 300px">
            </div>
            <div class="card-body">
                <p class="login-box-msg">Silahkan masuk untuk mengakses aplikasi sebagai Pelamar.</p>

                <form action="/applicant/login" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="input-group mb-3">
                        <input type="kode" class="form-control @error('password') is-invalid @enderror"
                            aria-label="kode" aria-describedby="inputGroup-sizing-default" id="kode" name="kode"
                            required value="{{ old('kode') }}" placeholder="Kode Lamaran" maxlength="20"
                            autocomplete="off">
                        <span class="input-group-text" id="inputGroup-sizing-default">
                            <i class="fa-solid fa-shield-halved"></i>
                        </span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            aria-label="Password" aria-describedby="inputGroup-sizing-default" id="password"
                            name="password" required value="{{ old('password') }}" placeholder="Password">
                        <span class="input-group-text" id="inputGroup-sizing-default">
                            <span class="fas fa-lock" id="lock" onclick="showPw()"></span>
                        </span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group mb-2">
                        <div class="hasil_refereshrecapcha d-inline" style="margin-left: 5px;">
                            {!! captcha_img('math') !!}
                        </div>
                        {{-- refresh captcha --}}
                        <a class="btn btn-outline-secondary" style="margin-left: 10px;" href="javascript:void(0)"
                            onclick="refreshCaptcha()">
                            <span>
                                <i class="fas fa-sync"></i>
                            </span>
                        </a>
                    </div>
                    <div class="form-group mb-2">
                        <input type="text"
                            class="form-control form-control-user @error('captcha') is-invalid @enderror" name="captcha"
                            required id="captcha" placeholder="Masukan Captcha">
                        @error('captcha')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <br>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </form>
                {{-- <hr>
                <p class="mb-1">
                    <a href="{{ route('forget.password.get') }}">Lupa Password?</a>
                </p> --}}
            </div>
            <div class="card card-outline card-danger"></div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- AdminLTE App -->
    <script src="{{ asset('template/js/adminlte.min.js') }}"></script>
    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                lock.classList.remove("fa-lock");
                lock.classList.add("fa-unlock");
                input.type = "text";
            } else {
                lock.classList.remove("fa-unlock");
                lock.classList.add("fa-lock");
                input.type = "password";
            }
        }
    </script>

    {{-- Sweet Alert Pesan Gagal --}}
    @if (session('loginError'))
        <script>
            Swal.fire({
                title: 'Gagal Login!',
                html: @json(session('loginError')),
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('loginSukses'))
        <script>
            Swal.fire({
                title: 'Sukses Login!',
                html: '@json(session('loginSukses')),
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

</body>

</html>
