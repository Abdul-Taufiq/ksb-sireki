  @include('partial.header')
  @yield('header')
  
  
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="{{ asset('img/logo ksb.png') }}" alt="icon" style="width: 300px">
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register akun baru</p>

      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
             placeholder="Full name" id="name" required autocomplete="name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
             placeholder="Email" id="email" required autocomplete="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" 
          required autocomplete="new-password" placeholder="Password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirm password" id="password-confirm" 
            name="password_confirmation" required autocomplete="new-password" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
         <select name="level" id="level" autocomplete="off" required value="{{ old('level') }}" class="form-control @error('level') is-invalid @enderror">
              <option  disabled selected hidden>- Pilih Hak Akses -</option>
							<option value="Admin SDM" {{ old('level') == "Admin SDM"  ? 'selected' : null }}>Admin SDM</option>
							<option value="Admin TSI" {{ old('level') == "Admin TSI"  ? 'selected' : null }}>Admin TSI</option>
					</select>
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
               &nbsp;
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      

    </div>
    <div class="card card-outline card-danger">
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->



{{-- Menonaktifkan select option --}}
{{-- <script>
  const select1 = document.getElementById("level");
  const select2 = document.getElementById("cabang");

  select1.addEventListener("change", function() {
    if (this.value === "Admin TSI" || this.value === "Direktur") {
      select2.setAttribute("disabled", "disabled");
    } else {
      select2.removeAttribute("disabled");
    }
  });
</script> --}}






@yield('footer')
@include('partial.footer')

