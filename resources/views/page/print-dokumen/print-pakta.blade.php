<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link rel="shortcut icon" href="{{ public_path('images/logo-ksb.png') }}">
    <link rel="icon" href="{{ public_path('images/logo-ksb.png') }}">
    {{-- @include('page.master-kredit.muk.show-scoring.style') --}}
    <link rel="stylesheet" href="{{ public_path('template/css/style-for-print-dompdf.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('template/css/style-for-print-dompdf.css') }}"> --}}

    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 2.8cm 1cm 1.5cm 1.7cm;
            font-size: 12pt;
            text-align: justify !important;
            line-height: 14pt;
            letter-spacing: 0.5px;

        }

        table {
            font-size: 12pt !important;
            text-align: justify !important;
            color: black !important;
        }

        p {
            font-size: 12pt !important;
        }

        h3 {
            font-size: 12pt !important;
            /* line-height: 0px !important; */
            margin-bottom: -5px !important;
            /* font-weight: bold !important; */
        }

        h2 {
            font-size: 14pt !important;
            letter-spacing: 0.5px !important;
            /* line-height: 0px !important; */
            margin-bottom: -15px !important;
            /* font-weight: bold !important; */
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            page-break-after: avoid;
        }

        .col-md-6 {
            width: 47% !important;
        }

        .col-md-4 {
            width: 30% !important;
        }

        .col-md-1 {
            width: 5% !important;
            padding-left: 0.1rem !important;
            padding-right: 0.4rem !important;
            padding-bottom: 0.10rem !important;
        }

        .col-md-11 {
            width: 93.8% !important;
            padding: 0rem 0rem 0.15rem 0rem !important;
        }

        .row {
            page-break-inside: avoid;
        }

        td ol {
            list-style-type: decimal !important;
            /* Pastikan angka tetap muncul */
            padding-left: 20px !important;
            /* Sesuaikan indentasi */
        }

        td ul {
            list-style-type: disc !important;
            /* Pastikan bullet tetap muncul */
            padding-left: 20px !important;
        }

        .table-borderless tbody+tbody,
        .table-borderless td,
        .table-borderless th {
            border: none !important;
            padding-right: 0px !important;
            padding-left: 0px !important;
            padding-bottom: 0.10rem !important;
            text-align: justify !important;
        }

        .list {
            margin-left: 5.3rem !important;
        }

        .premis-jaminan {
            margin-left: 4.5rem;
        }

        .double-border {
            border: 3px double black;
            /* 2 garis border */
        }

        .double-border td {
            border: 3px double black;
            /* border cell juga 2 garis */
        }

        header {
            display: block;
            position: fixed;
            width: 87%;
            top: 10px;
        }
    </style>
</head>

<body>
    <header>
        <table class="table double-border">
            <tr>
                <td style="width: 70%">
                    <h3 style="margin-bottom: 2px !important">LAMPIRAN SE.DIR NO: 020/SE.DIR/SDM-PI/IX/2020</h3>
                    Tentang: Pembaharuan Pedoman Pelaksanaan Pakta Integritas
                </td>
                <td style="text-align: center">
                    <b>DOK SDM</b> <br>
                    <b>KSB-PI/REV1/08-2020</b>
                </td>
            </tr>
        </table>
    </header>


    <table class="table table-borderless w-100" style="margin-top: -20px !important; ">
        <tr>
            <td style="width: 25%; border: none;">&nbsp;</td>
            <td style="width: 50%; text-align: center !important; vertical-align: middle; border: none;">
                <img style="width: 100px;"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/logo-ksb.png'))) }}">
                <br>
                <h2>PAKTA INTEGRITAS</h2>
            </td>
            <td style="width: 25%; border: none;">&nbsp;</td>
        </tr>
    </table>

    <br>
    <p>
        Saya yang bertanda tangan di bawah ini:
    </p>

    <table style="margin-left: 40px; width: 94%;">
        <tr>
            <td style="width: 28%">Nama</td>
            <td style="width: 1%;">:</td>
            <td>{{ ucwords(strtolower($dokumen->pelamar->nama)) }}</td>
        </tr>
        <tr>
            <td>No. KTP</td>
            <td>:</td>
            <td>{{ $dokumen->pelamar->nik }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $dokumen->pelamar->jns_kelamin }}</td>
        </tr>
        <tr>
            <td>Tempat, Tanggal Lahir</td>
            <td>:</td>
            <td>
                {{ ucwords(strtolower($dokumen->pelamar->tempat_lahir)) }},
                {{ $dokumen->pelamar->tgl_lahir->translatedFormat('d F Y') }}
            </td>
        </tr>
        <tr>
            <td>Alamat KTP</td>
            <td>:</td>
            <td>
                {{ ucwords(strtolower($dokumen->pelamar->alamat)) }}
            </td>
        </tr>
        <tr>
            <td>Pekerjaan/Jabatan</td>
            <td>:</td>
            <td>
                {{ ucwords(strtolower($dokumen->pelamar->posisi)) }}
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
            <td>PT BPR Kusuma Sumbing {{ $dokumen->cabang->cabang }}</td>
        </tr>
    </table>

    <br>
    <p>
        Bersama ini menyatakan dengan sesungguhnya tanpa paksaan dari pihak manapun juga bahwa berkenaan dengan
        pekerjaan dan jabatan saya di BPR KUSUMA SUMBING yang berkantor pusat di PARAKAN dan beserta kantor-kantor
        cabangnya berkomitmen dan berjanji :
    </p>


    <div class="row" style="margin-left: 2.5rem;">
        <div class="col-md-1">1.</div>
        <div class="col-md-11" style="width: 93% !important">
            Dalam mengemban tugas dan tanggung jawab saya akan melaksanakan dengan penuh kejujuran sesuai etika
            bisnis dan moralitas kebenaran terhadap segala kegiatan usaha yang akan saya laksanakan dengan prinsip
            kewajaran, berakuntabilitas dan menganut prinsip keterbukaan/transparancy serta bersedia untuk dilakukan
            pengawasan maupun pemeriksaan dari pihak yang ditunjuk oleh perusahaan jika patut dilaksanakan.
        </div>
        <div class="clearfix"></div>
        <div class="col-md-1">2.</div>
        <div class="col-md-11" style="width: 93% !important">
            Prinsip tersebut di atas berlaku juga bagi pihak keluarga dan sanak saudara saya dalam menjaga agar tidak
            terjadi 'Benturan Kepentingan' (Conflict of Interest) maupun 'Kepentingan Tertentu' (Vested Interest) yang
            bermaksud untuk memperkaya diri sendiri dan keluarga maupun pihak / orang lain dalam mendapatkan sesuatu
            baik yang berupa janji maupun pemberian komisi, ucapan terima kasih atau apapun bentuknya dalam pemberian
            pinjaman bank maupun penempatan sumber dana di bank di tempat saya bekerja.
        </div>
        <div class="clearfix"></div>
        <div class="col-md-1">3.</div>
        <div class="col-md-11" style="width: 93% !important">
            Bahwa saya akan melaksanakan sistem 'Good Corporate Governance' (tata kelola perusahaan) dengan baik dan
            benar serta sesuai prinsip kehati-hatian seperti yang dicantumkan dalam undang-undang perbankan No. 10 tahun
            1998 dan Forum Corporate Governance Indonesia (FCGI) tahun 2001 yang bertanggung jawab, transparan,
            akuntabel, setara dan wajar serta independen.
        </div>
        <div class="clearfix"></div>
        <div class="col-md-1">4.</div>
        <div class="col-md-11" style="width: 93% !important">
            Memberi contoh dalam kepatuhan terhadap Peraturan Perundang-Undangan dalam melaksanakan tugas bagi
            pegawai di lingkungan PT BPR Kusuma Sumbing.
        </div>
        <div class="clearfix"></div>
        <div class="col-md-1">5.</div>
        <div class="col-md-11" style="width: 93% !important">
            Akan memegang teguh rahasia perusahaan dan jabatan serta setia dan taat kepada Pimpinan dalam menjalankan
            tugas dan instruksi yang benar.
        </div>
        <div class="clearfix"></div>
        <div class="col-md-1">6.</div>
        <div class="col-md-11" style="width: 93% !important">
            Apabila saya melanggar hal-hal yang telah saya nyatakan dalam Pakta Integritas ini saya bersedia
            dikenakan sanksi sesuai dengan ketentuan peraturan perundang-undangan maupun menerima konsekuensi hukum yang
            berlaku.
        </div>
        <div class="clearfix"></div>
        <div class="col-md-1">7.</div>
        <div class="col-md-11" style="width: 93% !important">
            Dan terkait konsekuensi pelanggaran yang dimaksud pada point (6) maka saya bersedia mengundurkan diri
            secara sukarela dari PT BPR Kusuma Sumbing dan pihak Perusahaan tidak berkewajiban memberikan kompensasi
            Pemutusan Hubungan Kerja sesuai dengan perundangan yang berlaku.
        </div>
    </div>

    <br>
    <p>
        Dengan pernyataan Pakta Integritas yang saya tanda tangani ini maka dengan ini saya sadar sepenuhnya untuk
        mempertanggung-jawabkan setiap perbuatan saya di hadapan hukum yang berlaku di Negara Kesatuan Republik
        Indonesia baik secara pidana maupun perdata.
    </p>

    <br>
    <p>
        Demikian surat pernyataan ini saya buat dengan penuh kesadaran dan semoga Tuhan Yang Maha Esa membimbing serta
        merestui pekerjaan saya dengan penuh rakhmat.
    </p>


    <br>
    <br>
    <table>
        <tr>
            <td style="width: 50%">&nbsp;</td>
            <td style="text-align: center">
                {{ ucwords(strtolower($dokumen->cabang->alamat)) }}, {{ now()->translatedFormat('d F Y') }} <br>
                Yang Menyatakan, <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                {{ ucwords(strtolower($dokumen->pelamar->nama)) }}
            </td>
        </tr>
    </table>

    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font("times", "normal");
            $size = 9;
            $color = array(0,0,0);

            // buat garis horizontal (x1, y1, x2, y2)
            $pdf->page_line(50, 800, 558, 800, $color, 0.2); 
            // angka terakhir (0.5) = ketebalan garis

            // nomor halaman
            $pdf->page_text(485, 810, "Halaman {PAGE_NUM} dari {PAGE_COUNT}", $fontMetrics->get_font("times","bold"), 10, array(0,0,0));

        }
    </script>

</body>

</html>
