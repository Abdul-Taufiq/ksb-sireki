<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KSB | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">

      {{-- logo --}}
      <link rel="shortcut icon" href="{{ asset('img/icon_logo.png') }}">
      <link rel="icon" href="{{ asset('img/icon_logo.png') }}">
</head>
<body class="hold-transition login-page" style="background-image:url({{url('img/bg.jpg')}});">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="{{ asset('img/logo ksb lengkap.png') }}" alt="icon" style="width: 300px">
    </div>
    <div class="card-body">
      <p class="login-box-msg">Silahkan masuk untuk mengakses aplikasi sebagai admin.</p>

      @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
      @endif

      {{-- LOGIN ERROR --}}
      @if(session()->has('loginError'))
      <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert" style="font-size: 13px">
          {{ session('loginError') }}
      </div>
      @endif

      <form action="/login" method="post">
        {{ csrf_field() }}
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" id="email" name="email" required value="{{ old('email') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="password" name="password" required value="{{ old('password') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock" id="lock" onclick="showPw()"></span>
            </div>
          </div>
        </div>
        
        <div class="form-group mb-2">
          <div class="hasil_refereshrecapcha d-inline">
              {!! captcha_img('math') !!}
          </div>
          {{-- refresh captcha --}}
          <a class="btn btn-default btn-icon-split"  style="padding: 10px;" 
          href="javascript:void(0)" onclick="refreshCaptcha()">
          <span>
              <i class="fas fa-sync"></i>
          </span>
      </a>
      </div>
      <div class="form-group mb-2">
          <input type="text" class="form-control form-control-user @error('captcha') is-invalid @enderror" 
          name="captcha" required id="captcha" placeholder="Masukan Captcha">
          @error('captcha')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror
      </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
<hr>
      <p class="mb-1">
        <a href="{{ route('forget.password.get') }}">Lupa Password?</a>
      </p>
    </div>
    <div class="card card-outline card-danger"></div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>

<script>
  function refreshCaptcha(){
      $.ajax({
          url: "/refereshcapcha",
          type: 'get',
          dataType: 'html',        
          success: function(json) {
              $('.hasil_refereshrecapcha').html(json);
          },
          error: function(data) {
              alert('Try Again.');
          }
      });
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

</body>
</html>
