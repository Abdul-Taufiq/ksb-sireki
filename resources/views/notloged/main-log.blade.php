<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>KSB | {{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;600;800&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Libraries Stylesheet -->
    <link href="https://web.bprkusumasumbing.com/lib/animate/animate.min.css" rel="stylesheet">
    <link href="https://web.bprkusumasumbing.com/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="https://web.bprkusumasumbing.com/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="https://web.bprkusumasumbing.com/css/style.css" rel="stylesheet">

    <link rel="shortcut icon" href="https://web.bprkusumasumbing.com/ksb-img/icon_logo.png" />
    <link rel="icon" href="https://web.bprkusumasumbing.com/ksb-img/icon_logo.png" />


    <style>
        .size {
            font-size: 15px
        }

        .kotak {
            /* position: absolute; */
            top: 0;
            left: 0;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.357);
            width: 350px;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .card img {
            width: 100%;
            height: auto;
            display: block;
        }

        .card h3 {
            margin: 10px 0;
            font-size: 15px;
            color: #333;
        }

        .due-date {
            font-size: 14px;
            color: #999;
        }

        .date {
            font-size: 15px;
            color: #097fce;
            font-weight: bold;
            margin: 5px 0;
        }

        .btn-konten {
            display: inline-block;
            margin: 10px 15px;
            padding: 8px 12px;
            background: #097fce;
            color: #fff;
            border-radius: 7px;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.3s;
        }

        .btn-konten:hover {
            background: #02548a;
            color: #fff;
        }
    </style>
</head>


<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark text-white-50 py-2 px-0 d-lg-block">
        <div class="row gx-0 align-items-center">
            <div class="col-lg-7 px-5 text-start d-none d-lg-block">
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <small class="fa fa-phone-alt me-2"></small>
                    <small>(0293) 596390, 596362</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <small class="far fa-envelope-open me-2"></small>
                    <small>ksbpusat.sekretariat2@gmail.com</small>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <ol class="breadcrumb justify-content-end mb-0">
                    <li class="breadcrumb-item"><a class="text-white-50 small"
                            href="https://web.bprkusumasumbing.com/">Back to Website KSB</a></li>
                    <li class="breadcrumb-item"><a class="text-white-50 small"
                            href="https://web.bprkusumasumbing.com/edukasi">Edukasi</a></li>
                    <li class="breadcrumb-item"><a class="text-white-50 small"
                            href="https://web.bprkusumasumbing.com/ws-system">Whistleblowing</a></li>
                    <li class="breadcrumb-item"><a class="text-white-50 small" href="/login">Login</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5">
        <a href="/" class="navbar-brand d-flex align-items-center">
            <img class="img-fluid me-0" src="{{ asset('img/logo ksb lengkap.png') }}" style="width: 270px"
                alt="KSB">
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto bg-light pe-4 py-3 py-lg-0">
                <a href="/" class="nav-item nav-link ">Home Rekrutmen</a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#showAlur" class="nav-item nav-link ">Alur
                    Rekrutmen</a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#showLamaran" class="nav-item nav-link ">Cek
                    Status Pendaftaran Anda</a>
            </div>
            <div style="width: 100px">&nbsp;</div>
            <div class="h-100 d-lg-inline-flex align-items-center d-none">
                <a class="btn btn-square rounded-circle bg-light text-primary me-2"
                    href="https://www.youtube.com/channel/UCB9TUIb-s3AkjpTAlyfgDnw"><i class="fab fa-youtube"></i></a>
                <a class="btn btn-square rounded-circle bg-light text-primary me-2"
                    href="https://www.instagram.com/bprkusumasumbing/"><i class="fab fa-instagram"></i></a>
                <a class="btn btn-square rounded-circle bg-light text-primary me-2"
                    href="https://www.facebook.com/bprkusumasumbing"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-square rounded-circle bg-light text-primary me-2"
                    href="https://wa.me/message/25UWAPQIKULSD1"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid py-5 mb-2 wow fadeIn" data-wow-delay="0.1s"
        style="background: linear-gradient(rgba(1, 10, 53, 0.411), rgba(1, 10, 53, 0.678)),
                url('{{ asset('img/bg home.avif') }}') center center no-repeat; background-size: cover;">
        <div class="container text-center py-5">
            <h2 class="display-4 text-white animated slideInDown mb-4">Karir</h2>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="https://web.bprkusumasumbing.com/">Home Web KSB</a></li>
                    <li class="breadcrumb-item active text-white-50" aria-current="page">/ &nbsp;&nbsp; Karir</li>
                    @if ($title == 'Apply Loker KSB')
                        <li class="breadcrumb-item active text-white-50" aria-current="page">/ &nbsp;&nbsp;
                            {{ $title }}</li>
                    @endif
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- CONTENT Start -->
    <div class="container-xxl py-5">
        <div class="container">
            @yield('content')
        </div>
    </div>
    <!-- CONTENT End -->



    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 pt-4 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-4">
            <div class="row g-5">
                <div class="col-lg-5 col-md-8">
                    <h5 class="text-light mb-4">Jaringan Kantor</h5>
                    <div class="d-flex">
                        <div class="row me-3 mt-2">
                            <i class="bi bi-buildings-fill"></i>
                        </div>
                        <div class="row" style="width: 90%">
                            <select class="form-select bg-dark mb-4"
                                style="outline: none; border-top: none; font-weight: 900; width: 100%" name="kantor"
                                id="kantor" onchange="ubahAlamat()">
                                <option value="1">Kantor Pusat Operasional</option>
                                <option value="2">Kantor Cabang Temanggung</option>
                                <option value="3">Kantor Cabang Wonosobo</option>
                                <option value="4">Kantor Cabang Ambarawa</option>
                                <option value="5">Kantor Cabang Semarang</option>
                                <option value="6">Kantor Cabang Mranggen</option>
                                <option value="7">Kantor Cabang Sukorejo</option>
                                <option value="8">Kantor Cabang Weleri</option>
                                <option value="9">Kantor Cabang Delanggu</option>
                                <option value="10">Kantor Cabang Gombong</option>
                                <option value="11">Kantor Cabang Sokaraja</option>
                                <option value="12">Kantor Kas Temanggung</option>
                            </select>

                        </div>
                    </div>
                    <p id="alamat"><i class="fa fa-map-marker-alt me-3"></i>Jl Diponegoro No 210 Parakan -
                        Temanggung
                        56254</p>
                    <p id="telp"><i class="fa fa-phone-alt me-3"></i>(0293) 596390, 596362, 5914468</p>
                    <p><i class="fa fa-envelope me-3"></i>ksbpusat.sekretariat2@gmail.com</p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-light mb-4">PT BPR Kusuma Sumbing</h5>
                    <p>
                        Berizin dan diawasi oleh Otoritas Jasa Keuangan <b>(OJK)</b> <br>
                        Serta merupakan peserta penjaminan <b>LPS</b> Hingga Rp2 miliar per Nasabah per Bank
                    </p>
                    <!--<img class="img-fluid me-0" style="width: 150px; margin-top: 0; " src="https://web.bprkusumasumbing.com/ksb-img/lps.png"-->
                    <!--    alt="LPS">-->
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Ikuti Kami</h5>
                    <p>Ikuti akun sosial media kami untuk mendapatkan informasi terbaru.</p>
                    <div class="d-flex">
                        <a class="btn btn-square rounded-circle me-1"
                            href="https://www.youtube.com/channel/UCB9TUIb-s3AkjpTAlyfgDnw">
                            <i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square rounded-circle me-1"
                            href="https://www.instagram.com/bprkusumasumbing/">
                            <i class="fab fa-instagram"></i></a>
                        <a class="btn btn-square rounded-circle me-1"
                            href="https://www.facebook.com/bprkusumasumbing">
                            <i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square rounded-circle me-1" href="https://wa.me/message/25UWAPQIKULSD1">
                            <i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a href="/">BPR Kusuma Sumbing</a>, All Right Reserved 2026.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        Designed By <a href="/">TSI | KSB</a>, Application version <a href="/">2.1.0</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- MODAL Show Lamaran -->
    <div class="modal fade" id="showLamaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="showLamaranLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showLamaranLabel">Cek Status Pendaftaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Untuk melihat status pendaftaran Anda, silahkan masukkan kode lamaran yang telah dikirimkan melalui
                    email Anda atau pada halaman pendaftaran pertama kali! <br> <br>
                    <div class="row" style="margin-left: 5px">
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label style="font-weight: bold; font-size: 13px;" for="kode_lamaran">Kode
                                    Lamaran</label>
                                <input type="text" class="form-control form-control-sm border-primary" required
                                    id="kode_lamaran" name="kode_lamaran" style="border-radius: 8px;"
                                    maxlength="40">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label style="font-weight: bold; font-size: 13px;" for="password">Password</label>
                                <input type="text" class="form-control form-control-sm border-primary" required
                                    id="password" name="password" style="border-radius: 8px;" maxlength="15">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="getData()">Lihat Lamaran</button>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL Show Alur -->
    <div class="modal fade" id="showAlur" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="showLamaranLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showLamaranLabel">Alur Proses Rekruitment PT BPR Kusuma Sumbing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm table-responsive">
                        <thead>
                            <tr>
                                <th style="width: 42%">Alur</th>
                                <th>Penjelasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <a href="{{ asset('img/Alur Sistem.png') }}" target="__blank">
                                        <img src="{{ asset('img/Alur Sistem.png') }}" alt="Alur Sistem"
                                            style="max-width: 100%"> <i class="bi bi-eye-fill"></i> Lihat alur
                                    </a>
                                </td>
                                <td>
                                    <table class="table table-responsive table-striped w-100">
                                        <tr>
                                            <td style="width: 4%">1.</td>
                                            <td>
                                                Pelamar menginputkan permohonan lamaran pekerjaan.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 3%">2.</td>
                                            <td>
                                                Pelamar akan mendapatkan email dari sistem berisikan kode dan
                                                password yang digunakan untuk tracking pengajuan lamaran.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 3%">3.</td>
                                            <td>
                                                Admin akan melakukan pemeriksaan berkas.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 3%">4.</td>
                                            <td>
                                                Jika lolos seleksi berkas, pelamar akan melakukan tes <i>Assesment
                                                    maupun psikotes</i>.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 3%">5.</td>
                                            <td>
                                                Pelamar akan melakukan interview dengan User maupun dengan SDM.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 3%">6.</td>
                                            <td>
                                                Jika semua lolos, akan diadakan <i>Offering dan Finalisasi</i> oleh SDM
                                                maupun petugas cabang terkait.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 3%">7.</td>
                                            <td>
                                                Selesai.
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>



    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://web.bprkusumasumbing.com/lib/wow/wow.min.js"></script>
    <script src="https://web.bprkusumasumbing.com/lib/easing/easing.min.js"></script>
    <script src="https://web.bprkusumasumbing.com/lib/waypoints/waypoints.min.js"></script>
    <script src="https://web.bprkusumasumbing.com/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="https://web.bprkusumasumbing.com/lib/counterup/counterup.min.js"></script>
    <script src="https://web.bprkusumasumbing.com/lib/parallax/parallax.min.js"></script>

    <!-- Template Javascript -->
    <script src="https://web.bprkusumasumbing.com/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function ubahAlamat() {
            var select = document.getElementById("kantor");
            var alamat = document.getElementById("alamat");
            var telp = document.getElementById("telp");
            var selectedValue = select.value;
            console.log(select);

            switch (selectedValue) {
                case "1":
                    alamat.innerHTML =
                        '<i class="fa fa-map-marker-alt me-3"></i>Jl Diponegoro No 210 Parakan - Temanggung 56254';
                    telp.innerHTML = '<i class="fa fa-phone-alt me-3"></i>(0293) 596390, 596362, 5914468';
                    break;
                case "2":
                    alamat.innerHTML = '<i class="fa fa-map-marker-alt me-3"></i>Jl Pahlawan No 2D Temanggung 56213';
                    telp.innerHTML = '<i class="fa fa-phone-alt me-3"></i>(0293) 493905, 5573237';
                    break;
                case "3":
                    alamat.innerHTML =
                        '<i class="fa fa-map-marker-alt me-3"></i>Ruko Abragen Jl Mayjen Bambang Sugeng Wonosobo 56317';
                    telp.innerHTML = '<i class="fa fa-phone-alt me-3"></i>(0286) 3301511';
                    break;
                case "4":
                    alamat.innerHTML =
                        '<i class="fa fa-map-marker-alt me-3"></i>Jl Kompleks Pertokoan Ambarawa Permai Blok B II, Ambarawa 50612';
                    telp.innerHTML = '<i class="fa fa-phone-alt me-3"></i>(0298) 591333';
                    break;
                case "5":
                    alamat.innerHTML =
                        '<i class="fa fa-map-marker-alt me-3"></i>Jl Pringgading No 25 Semarang 50136';
                    telp.innerHTML = '<i class="fa fa-phone-alt me-3"></i>(024) 3519456, 3519455';
                    break;
                case "6":
                    alamat.innerHTML =
                        '<i class="fa fa-map-marker-alt me-3"></i>Jl Raya No 140 Mranggen - Demak 59567';
                    telp.innerHTML = '<i class="fa fa-phone-alt me-3"></i>(024) 6710013';
                    break;
                case "7":
                    alamat.innerHTML =
                        '<i class="fa fa-map-marker-alt me-3"></i>Jl Raya No 27 Sukorejo - Kendal 51363';
                    telp.innerHTML = '<i class="fa fa-phone-alt me-3"></i>(0294) 451106, 452573';
                    break;
                case "8":
                    alamat.innerHTML =
                        '<i class="fa fa-map-marker-alt me-3"></i>Jl Terminal Colt No 9 Weleri - Kendal 51355';
                    telp.innerHTML = '<i class="fa fa-phone-alt me-3"></i>(0294) 641397';
                    break;
                case "9":
                    alamat.innerHTML =
                        '<i class="fa fa-map-marker-alt me-3"></i>Jl Raya No 15 - 16 Delanggu - Klaten 57471';
                    telp.innerHTML = '<i class="fa fa-phone-alt me-3"></i>(0272) 555258, 551086';
                    break;
                case "10":
                    alamat.innerHTML =
                        '<i class="fa fa-map-marker-alt me-3"></i>Jl Yos Sudarso No 392 Gombong - Kebumen 54412';
                    telp.innerHTML = '<i class="fa fa-phone-alt me-3"></i>(0287) 471808';
                    break;
                case "11":
                    alamat.innerHTML =
                        '<i class="fa fa-map-marker-alt me-3"></i>Jl Jend Sudirman No 86 Sokaraja - banyumas 53181';
                    telp.innerHTML = '<i class="fa fa-phone-alt me-3"></i>(0281) 6441272, 6441076';
                    break;
                case "12":
                    alamat.innerHTML =
                        '<i class="fa fa-map-marker-alt me-3"></i>Jl Raya Temanggung - Kranggan, Ruko No 6 Kenalan, Kranggan - Temanggung 56271';
                    telp.innerHTML = '<i class="fa fa-phone-alt me-3"></i>(0293) 4901368';
                    break;
            }
        }
    </script>

    {{-- s --}}
    <script>
        function getData() {
            var kodeLamaran = document.getElementById("kode_lamaran").value;
            var password = document.getElementById("password").value;

            if (!kodeLamaran || !password) {
                swal.fire({
                    icon: 'error',
                    title: 'ERROR!',
                    text: 'Kode Lamaran dan Password harus diisi!',
                });
                return;
            }

            if (kodeLamaran.length > 40) {
                swal.fire({
                    icon: 'error',
                    title: 'ERROR!',
                    text: 'Kode Lamaran tidak boleh lebih dari 40 karakter!',
                });
                return;
            }

            if (password.length > 15) {
                swal.fire({
                    icon: 'error',
                    title: 'ERROR!',
                    text: 'Password tidak boleh lebih dari 15 karakter!',
                });
                return;
            }

            // Lakukan permintaan AJAX ke server untuk mendapatkan data pelamar
            fetch(`/get-data-pelamar?kode=${kodeLamaran}&pass=${password}`)
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    if (data.success) {
                        // Jika data ditemukan, redirect ke halaman detail pelamar
                        window.location.href = `/pelamar/show/${data.data}`;
                    } else {
                        // Jika data tidak ditemukan, tampilkan pesan error
                        swal.fire({
                            icon: 'error',
                            title: 'ERROR!',
                            text: data.message,
                        });
                    }
                })
                .catch((error) => console.error("Error fetching data:", error));
        }
    </script>

    @yield('script')
</body>

</html>
