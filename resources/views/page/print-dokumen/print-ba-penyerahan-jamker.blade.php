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
            margin: 1.5cm 1cm 1.5cm 1.7cm;
            font-size: 12pt;
            text-align: justify !important;
            line-height: 14pt;
            letter-spacing: 0.4px;

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
            margin-left: 1rem !important;
        }

        .premis-jaminan {
            margin-left: 4.5rem;
        }
    </style>
</head>

<body>
    <table class="table table-borderless w-100 mb-4">
        <tr>
            <td style="width: 2%; border: none;">&nbsp;</td>
            <td style="width: 96%; text-align: center !important; vertical-align: middle; border: none;">
                <h2 style="text-decoration: underline">BERITA ACARA SERAH TERIMA JAMINAN KERJA</h2> <br>
                <h3>NO. {{ $dokumen->no_ba_jamker }}</h3>
            </td>
            <td style="width: 2%; border: none;">&nbsp;</td>
        </tr>
    </table>

    <br>
    <br>
    <p>
        Pada hari ini {!! $dokumen->tgl_print_ba_jamker?->translatedFormat('l') !!}, tanggal {{ $dokumen->tgl_print_ba_jamker->translatedFormat('d F Y') }}
        telah dibuat Berita Acara Serah Terima Jaminan Kerja oleh dan diantara :
    </p>

    <br>
    <table style="margin-left: 40px; width: 94%; ">
        <tr>
            <td style="width: 25%">Nama</td>
            <td style="width: 1%;">:</td>
            <td>Prastiyani</td>
        </tr>
        <tr>
            <td>No. NIK</td>
            <td>:</td>
            <td>3323034809820002</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>Kepala Bidang SDM PT BPR Kusuma Sumbing</td>
        </tr>
    </table>
    dan

    <br>
    <br>
    <table style="margin-left: 40px; width: 94%; ">
        <tr>
            <td style="width: 25%">Nama</td>
            <td style="width: 1%;">:</td>
            <td>{{ ucwords(strtolower($dokumen->pelamar->nama)) }}</td>
        </tr>
        <tr>
            <td>No. NIK</td>
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
            <td>Alamat</td>
            <td>:</td>
            <td>
                {{ ucwords(strtolower($dokumen->pelamar->alamat)) }}
            </td>
        </tr>
        <tr>
            <td>Domisili</td>
            <td>:</td>
            <td>
                {{ ucwords(strtolower($dokumen->pelamar->domisili)) }}
            </td>
        </tr>
    </table>


    <br>
    <p>
        Dengan ketentuan sebagai berikut :
    </p>
    <div class="row" style="margin-left: 1rem;">
        <div class="col-md-1">1.</div>
        <div class="col-md-11" style="width: 93% !important">
            Dalam Perjanjian Kerja Nomor {{ $dokumen->nomor_pk }}
            tanggal {{ $dokumen->tgl_pk->translatedFormat('d F Y') }} telah diwajibkan kepada karyawan untuk
            menyerahkan Jaminan Kerja.
            Jaminan Kerja ini disimpan oleh pihak manajemen selama karyawan bekerja di PT BPR Kusuma Sumbing
        </div>
        <div class="clearfix"></div>
        <div class="col-md-1">2.</div>
        <div class="col-md-11" style="width: 93% !important">
            Telah diserahkan Jaminan Kerja dengan spesifikasi sebagai berikut :
            <ul class="list">
                <li>
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 30%">Jenis</td>
                            <td style="width: 2%;">:</td>
                            <td>{{ $dokumen->jns_jamker }}</td>
                        </tr>
                    </table>
                </li>
                <li>
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 30%">Atas Nama</td>
                            <td style="width: 2%;">:</td>
                            <td>
                                {{ $dokumen->atas_nama }}
                            </td>
                        </tr>
                    </table>
                </li>
                <li>
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 30%">Nomor Ijazah</td>
                            <td style="width: 2%;">:</td>
                            <td>
                                {{ $dokumen->no_ijazah }}
                            </td>
                        </tr>
                    </table>
                </li>
                <li>
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 30%">Tingkatan</td>
                            <td style="width: 2%;">:</td>
                            <td>
                                {{ $dokumen->tingkatan }}
                            </td>
                        </tr>
                    </table>
                </li>
                <li>
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 30%">Instansi</td>
                            <td style="width: 2%;">:</td>
                            <td>
                                {{ $dokumen->instansi }}
                            </td>
                        </tr>
                    </table>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-1">3.</div>
        <div class="col-md-11" style="width: 93% !important">
            Ijazah tersebut di atas diterima dalam keadaan :
            <ul class="list">
                <li>
                    Berlaminating/Tidak Berlaminating <span style="font-size: 9px;">*)Coret Salah Satu</span>
                </li>
                <li>
                    Jelas terbaca dan hard cover
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-1">4.</div>
        <div class="col-md-11" style="width: 93% !important">
            Dengan diserahkannya Jaminan Kerja seperti tersebut dalam poin 2 (dua), maka manajemen berkewajiban untuk
            memastikan Jaminan Kerja tersimpan dalam keadaan baik dan utuh sampai dikemudian hari dikembalikan kepada
            karyawan.
        </div>
        <div class="clearfix"></div>
        <div class="col-md-1">5.</div>
        <div class="col-md-11" style="width: 93% !important">
            Apabila karena kepentingan tertentu, atas persetujuan Kepala Bidang SDM, dapat dilakukan peminjaman
            sementara Jaminan Kerja untuk jangka waktu maksimal 3 (tiga) hari dengan syarat karyawan yang bersangkutan
            menandatangani buku register Pengeluaran Jaminan Kerja.
        </div>
        <div class="clearfix"></div>
        <div class="col-md-1">6.</div>
        <div class="col-md-11" style="width: 93% !important">
            Pengembalian Jaminan Kerja dilakukan selambat-lambatnya 1 (satu) bulan setelah terjadi Pemutusan Hubungan
            Kerja dan memenuhi persyaratan administrasi berakhirnya hubungan kerja antara karyawan dan perusahaan dengan
            penyelesaian secara benar.
        </div>
        <div class="clearfix"></div>
        <div class="col-md-1">7.</div>
        <div class="col-md-11" style="width: 93% !important">
            Bahwa apabila terjadi kejadian luar biasa yang tidak sesuai dengan ketentuan dalam Perjanjian Kerja maupun
            Berita Acara Serah Terima Jaminan Kerja ini dan memerlukan perlakuan khusus yang menyangkut dengan
            penyerahan jaminan kerja, akan diadakan musyawarah antara pihak manajemen dan karyawan untuk mencapai kata
            mufakat.
        </div>
        <div class="clearfix"></div>
        <div class="col-md-1">8.</div>
        <div class="col-md-11" style="width: 93% !important">
            Bahwa Berita Acara Serah Terima Jaminan Kerja ini berlaku sebagai Tanda Terima Jaminan Kerja antara pihak
            manajemen dan karyawan dan merupakan bagian dari pelaksanaan Perjanjian Kerja sehingga merupakan satu
            kesatuan yang tidak terpisahkan daripadanya.
        </div>
    </div>

    <br>

    <p>
        Demikian Berita Acara Serah Terima Jaminan Kerja ini dibuat dan ditandatangani dalam keadaan sadar, atas
        kehendak sendiri, serta tanpa ada paksaan dan tekanan dari pihak manapun, pada hari dan tanggal sebagaimana
        tersebut diatas.
    </p>


    <br>
    <br>
    <table>
        <tr>
            <td style="width: 50%; text-align: center">
                Yang Menerima <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <u>Prastiyani</u> <br>
                Kepala Bidang SDM
            </td>
            <td style="text-align: center">
                Yang Menyerahkan, <br>
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
