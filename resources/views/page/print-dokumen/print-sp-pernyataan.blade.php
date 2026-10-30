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
            margin: 1cm 1cm 1.5cm 1.7cm;
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
    <table class="table table-borderless w-100">
        <tr>
            <td style="text-align: center !important">
                <h3 style="margin-bottom: 2px !important">SURAT PERNYATAAN</h3>
            </td>
        </tr>
    </table>

    <p>
        Saya yang bertanda tangan di bawah ini:
    </p>

    <table style="margin-left: 40px; width: 94%;">
        <tr>
            <td style="width: 20%">Nama</td>
            <td style="width: 1%;">:</td>
            <td>{{ ucwords(strtolower($dokumen->pelamar->nama)) }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>
                {{ ucwords(strtolower($dokumen->pelamar->alamat)) }}
            </td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $dokumen->pelamar->nik }}</td>
        </tr>
        <tr>
            <td>Kandidat</td>
            <td>:</td>
            <td>
                Jabatan: {{ ucwords(strtolower($dokumen->pelamar->posisi)) }}, Penempatan:
                {{ $dokumen->cabang->cabang }}
            </td>
        </tr>
    </table>

    <p>
        Bahwa sehubungan dengan minat dan keinginan saya untuk menjadi karyawan di PT. BPR Kusuma Sumbing maka dengan
        ini menyatakan,
    </p>


    <div class="row" style="margin-left: 2.5rem;">
        <div class="col-md-1">1.</div>
        <div class="col-md-11" style="width: 93% !important">
            Bersedia mengikuti tahap dan proses rekrutmen berdasarkan prosedur dan ketentuan yang ada di PT. BPR
            Kusuma Sumbing.
        </div>
        <div class="clearfix"></div>
        <div class="col-md-1">2.</div>
        <div class="col-md-11" style="width: 93% !important">
            Bersedia menyerahkan kelengkapan persyaratan administrasi calon karyawan baru PT. BPR Kusuma Sumbing yang
            didalamnya berkaitan dengan data-data pribadi saya antara lain :
            <table class="table table-sm table-bordered" style="font-size: 12px !important">
                <thead>
                    <tr>
                        <th style="width: 5%; text-align: center">No</th>
                        <th style="width: 40%; text-align: center">Syarat Administrasi</th>
                        <th style="width: 5%; text-align: center">#</th>
                        <th style="width: 5%; text-align: center">No</th>
                        <th style="width: 40%; text-align: center">Syarat Administrasi</th>
                        <th style="width: 5%; text-align: center">#</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Surat Lamaran Kerja *</td>
                        <td></td>
                        <td>7</td>
                        <td>Foto Copy Ijazah&Transkip Akademik *</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Daftar Riwayat Hidup (CV) *</td>
                        <td></td>
                        <td>8</td>
                        <td>SKCK Asli (Boleh menyusul) *</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Foto Copy KTP *</td>
                        <td></td>
                        <td>9</td>
                        <td>Foto Berwarna (sesuai ukuran ydps) *</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Foto Copy KK *</td>
                        <td></td>
                        <td>10</td>
                        <td>Surat Referensi/pengalaman kerja</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Foto Copy NPWP </td>
                        <td></td>
                        <td>11</td>
                        <td>Surat Keterangan Sehat (Bila diperlukan)</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Foto Copy SIM </td>
                        <td></td>
                        <td>12</td>
                        <td>Lain-Lain</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            #: Terlampir (v) || Belum terlampir (BT) || Tidak ada (X) || * Wajib
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>



        <div class="clearfix"></div>
        <div class="col-md-1">3.</div>
        <div class="col-md-11" style="width: 93% !important">
            Bersedia untuk mengikuti tahapan pemrosesan data persyaratan administrasi pribadi saya seperti tersebut pada
            point (2) untuk dilakukan verifikasi, pengecekan, maupun analisa lebih lanjut sesuai kebutuhan PT. BPR
            Kusuma Sumbing.
        </div>
        <div class="clearfix"></div>
        <div class="col-md-1">4.</div>
        <div class="col-md-11" style="width: 93% !important">
            Bersedia untuk dilakukan pengecekan reputasi keuangan saya berkaitan dengan data SLIK pribadi saya termasuk
            pengecekan SLIK pasangan saya apabila diperlukan.
        </div>
        <div class="clearfix"></div>
        <div class="col-md-1">5.</div>
        <div class="col-md-11" style="width: 93% !important">
            Bersedia agar syarat-syarat administrasi pribadi saya tersebut untuk disimpan dan didokumentasikan oleh
            pihak PT. BPR Kusuma Sumbing.
        </div>
    </div>

    <br>
    <p>
        Demikian surat pernyataan ini saya buat tanpa ada paksaan dari pihak manapun untuk dipergunakan sesuai dengan
        kepentingannya.
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
