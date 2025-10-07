@include('partial.header')
@yield('header')

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('img/icon_logo.png')}}" alt="ksb" height="60" width="60">
  </div>

  

<main id="main" style="background-color: #112978">
    <!-- Navbar -->

    <div style="text-align: center" class="p-4">
        <h1 style="color: white">Daftar Sekarang</h1>
        <h5 style="color: white">Kirimkan CV anda ke PT BPR Kusuma Sumbing</h5>
        <h5 style="color: white">Dengan Mengisi Form Di Bawah ini</h5>
    </div>
        &nbsp;
        <br>
        <br>
        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
            <a href="/" style="padding-inline-start: 140px; color: white">< Kembali Ke Halaman Karir ...</a>
            <div class="container">
                <div class="ml-3 justify-content-center p-1">



                     <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                            <!-- jquery validation -->
                            <div class="card card-Secondary">
                                <div class="card-header text-center">
                                    <img src="{{ asset('img/logo ksb lengkap.png') }}" alt="icon" style="width: 300px">
                                </div>
                                <div class="card card-outline card-success">
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form id="quickForm" action="  {{ url('calon/store') }} " method="post" enctype="multipart/form-data" class="p-2">
                                {{-- CSRF TOKEN --}}
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                    <label for="nama">Nama :</label>
                                    <input type="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" autocomplete="off"
                                        placeholder="Full Name" value="{{ old('nama') }}" required>
                                    {{-- Erorr Message --}}
                                    @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    </div>
                
                                    <table style="width: 100%">
                                    <tr>
                                        <th style="width: 50%">
                                            <div class="form-group">
                                                <label for="tempat_lahir">Tempat Lahir:</label>
                                                <input type="tempat_lahir" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" autocomplete="off"
                                                    placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}" required>
                                                {{-- Erorr Message --}}
                                                @error('tempat_lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </th>
                                        <td style="width: 50%">
                                            <!-- Date -->
                                            <div class="form-group">
                                                <label>Tanggal Lahir:</label>
                                                <div class="input-group date" id="date" data-target-input="nearest">
                                                    <input readonly type="text" class="form-control datetimepicker-input @error('nama_calonur') is-invalid @enderror" data-target="#date" 
                                                        id="tgl_lahir" name="tgl_lahir" autocomplete="off" value="{{ old('tgl_lahir') }}" required placeholder="DD-MM-YYYY"/>
                                                    <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                                {{-- Erorr Message --}}
                                                @error('tgl_lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </td>
                                    </tr>
                                    </table>
                                    <div class="form-group">
                                        <label>Alamat Sesuai KTP:</label>
                                        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" 
                                            placeholder="Alamat" required>{{ old('alamat') }}</textarea>
                                        {{-- Erorr Message --}}
                                        @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Domisili:</label>
                                        <textarea name="domisili" id="domisili" class="form-control @error('domisili') is-invalid @enderror" rows="3" 
                                            placeholder="Alamat Domisili" required>{{ old('domisili') }}</textarea>
                                        {{-- Erorr Message --}}
                                        @error('domisili')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                    <label for="jns_kelamin">Jenis Kelamin:</label>
                                    <select name="jns_kelamin" id="jns_kelamin" autocomplete="off" required value="{{ old('jns_kelamin') }}" class="form-control @error('jns_kelamin') is-invalid @enderror">
                                        <option value="" disabled selected hidden>- Pilih Jenis Kelamin -</option>
                                        <option value="Laki-laki"  {{ old('jns_kelamin') == "Laki-laki" ? 'selected' : null }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jns_kelamin') == "Perempuan" ? 'selected' : null }}>Perempuan</option>
                                    </select>
                                    {{-- Erorr Message --}}
                                    @error('jns_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" id="email"  autocomplete="off"
                                            placeholder="Email" maxlength="100" value="{{ old('email') }}" required autocomplete="off">
                                        {{-- Erorr Message --}}
                                        @error('email]')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                
                                    <table style="width: 100%">
                                    <tr>
                                        <th style="width: 50%">
                                            <div class="form-group">
                                                <label for="no_telp">Nomor Hp/Telephone:</label>
                                                <input type="text" class="form-control" id="no_telp" name="no_telp" autocomplete="off" 
                                                    required maxlength="14" value="{{ old('no_telp') }}" placeholder="Nomor Hp/Telephone">
                                                </div>
                                                {{-- Erorr Message --}}
                                                @error('no_telp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                        </th>
                                        <td style="width: 50%">
                                            <div class="form-group">
                                                <label for="no_wa">Nomor WhatsApp Aktif:</label>
                                                <input type="text" class="form-control" id="no_wa" name="no_wa" autocomplete="off" 
                                                    required maxlength="14" value="{{ old('no_wa') }}" placeholder="Nomor WhatsApp">
                                                {{-- Erorr Message --}}
                                                @error('no_wa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </td>
                                    </tr>
                                    </table>
                                    <div class="form-group">
                                        <label for="posisi">Posisi Yang Dilamar:</label>
                                        <select name="posisi" id="posisi" autocomplete="off" required value="{{ old('posisi') }}" class="form-control @error('posisi') is-invalid @enderror">
                                            <option value="" disabled selected hidden>- Pilih Posisi -</option>
                                            @foreach ($loker as $item)
                                            <option value="{{ $item->posisi }}"  {{ old('posisi') == $item->posisi ? 'selected' : null }}>{{ $item->posisi }}</option>
                                            @endforeach 
                                        </select>
                                        {{-- Erorr Message --}}
                                        @error('posisi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="pendidikan">Pendidikan Terakhir:</label>
                                        <select name="pendidikan" id="pendidikan" autocomplete="off" required value="{{ old('pendidikan') }}" class="form-control @error('pendidikan') is-invalid @enderror">
                                            <option value="" disabled selected hidden>- Pilih Pendidikan Terakhir -</option>
                                            <option value="SD"  {{ old('pendidikan') == "SD" ? 'selected' : null }}>SD</option>
                                            <option value="SMP/Sederajat" {{ old('pendidikan') == "SMP/Sederajat" ? 'selected' : null }}>SMP/Sederajat</option>
                                            <option value="SMA/Sederajat" {{ old('pendidikan') == "SMA/Sederajat" ? 'selected' : null }}>SMA/Sederajat</option>
                                            <option value="D1" {{ old('pendidikan') == "D1" ? 'selected' : null }}>D1</option>
                                            <option value="D2" {{ old('pendidikan') == "D2" ? 'selected' : null }}>D2</option>
                                            <option value="D3" {{ old('pendidikan') == "D3" ? 'selected' : null }}>D3</option>
                                            <option value="Bachelor/S1" {{ old('pendidikan') == "Bachelor/S1" ? 'selected' : null }}>Bachelor/S1</option>
                                            <option value="Master/S2" {{ old('pendidikan') == "Master/S2" ? 'selected' : null }}>Master/S2</option>
                                            <option value="Doctor/S3" {{ old('pendidikan') == "Doctor/S3" ? 'selected' : null }}>Doctor/S3</option>
                                        </select>
                                        {{-- Erorr Message --}}
                                        @error('pendidikan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Jurusan (Jika Ada):</label>
                                        <input name="jurusan" id="jurusan" class="form-control @error('jurusan') is-invalid @enderror" rows="3" 
                                            placeholder="Jurusan" required value="{{ old('jurusan') }}" maxlength="50"></input>
                                        {{-- Erorr Message --}}
                                        @error('jurusan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Berkas Pendukung (Surat Lamaran, CV, KTP, Transkip Nilai, Portfolio, Ijazah dan lainnya) jadikan satu dalam bentuk PDF: (File Max: 10MB)</label>
                                        <input type="file" name="berkas_pendukung" id="berkas_pendukung" required class="form-control @error('berkas_pendukung') is-invalid @enderror">
                                        {{-- Erorr Message --}}
                                        @error('berkas_pendukung')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                   
                    
                                    <div class="form-group mb-0">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1" required>
                                            <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </div>
                                    </form>
                                    <br>
                                </div>
                            <div class="card card-outline card-success">
                            <!-- /.card -->
                            </div>
                            <!--/.col (left) -->
                            <!-- right column -->
                            <div class="col-md-6">
                
                            </div>
                            <!--/.col (right) -->
                        </div>
                        <!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </section>




                   
                </div><!-- End blog posts list -->

                <hr>
                <hr>
            </div>
        </section><!-- End Blog Section -->
        
        <br><br><br><br>
        {{-- main --}}
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<section id="footer" style="background-color: white;">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-3 col-md-12 footer-info">
                <h3>Alamat Kantor Pusat</h3>
                <p>Jl Diponegoro No 210 Parakan

                Temanggung
                
                Telp. (0293) 596390, 596362</p>
            </div>

            <div class="col-lg-6 col-md-12 footer-info">
                <h3>PT BPR Kusuma Sumbing</h3>
            
                <p>Berizin dan diawasi oleh Otoritas Jasa Keuangan (OJK)</p>
                <p class="mb-1">serta merupakan peserta penjaminan LPS</p>
                <img src="https://web.bprkusumasumbing.com/img/icon/lps.png" width="150">
            </div>

            <div class="col-lg-3 col-md-12 footer-info" >
                <h3>Ikuti Kami</h3>
                <p>Follow akun sosial kami untuk mendapatkan informasi terbaru.</p>
                <div class="flex items-center mt-3">
                    <!-- youtube -->
                    <a href="https://www.youtube.com/channel/UCB9TUIb-s3AkjpTAlyfgDnw" style="text-decoration: none;" target="_blank" class="mx-3 w-9 h-9 mr-3 rounded-full flex justify-center">
                        <svg role="img" width="20" class="fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>YouTube</title>
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>

                    <!-- Instagram -->
                    <a href="https://www.instagram.com/bprkusumasumbing/" target="_blank" class="mx-3 w-9 h-9 mr-3 rounded-full flex justify-center"  style="text-decoration: none;">
                        <svg role="img" width="20" class="fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Instagram</title><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                    </a>

                    <!-- facebook -->
                    <a href="https://www.facebook.com/bprkusumasumbing" target="_blank" class="mx-3 w-9 h-9 mr-3 rounded-full flex justify-center"  style="text-decoration: none;">
                        <svg role="img" width="20" class="fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Facebook</title><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>

                    <!-- WhatsApp -->
                    <a href="https://wa.me/message/25UWAPQIKULSD1" target="_blank" class="mx-3 w-9 h-9 mr-3 rounded-full flex justify-center"  style="text-decoration: none;">
                        <svg role="img" width="20" class="fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>WhatsApp</title><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    </a>
                </div>
            </div>
        </div>
     </div>
    </div>
<br><br>
</section>


</main>

<footer
  class="text-white shadow text-center pb-2"
  style="background-color: #112978">
  <p>
    Copyright &copy; <?php echo date('Y'); ?> <strong><span>TSI-BPR Kusuma Sumbing</span></strong>
  </p>
</footer>
<!-- End Footer -->


</body>



@yield('footer')
@include('partial.footer')