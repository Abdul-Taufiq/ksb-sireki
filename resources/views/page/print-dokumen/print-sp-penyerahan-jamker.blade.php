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
            margin: 0.8cm 1cm 1.5cm 1.7cm;
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
                <h2>
                    SURAT PERNYATAAN DAN KESEDIAAN PENYERAHAN <br> JAMINAN KERJA
                </h2>
            </td>
            <td style="width: 2%; border: none;">&nbsp;</td>
        </tr>
    </table>

    <br>
    <br>
    <p>
        Kami Yang bertanda tangan di bawah ini :
    </p>

    <br>

    <table style="width: 94%; margin-left: 1rem; ">
        <tr>
            <td style="width: 25%">Nama</td>
            <td style="width: 2%;">:</td>
            <td>{{ ucwords(strtolower($dokumen->pelamar->nama)) }}</td>
        </tr>
        <tr>
            <td>No. NIK</td>
            <td>:</td>
            <td>{{ $dokumen->pelamar->nik }}</td>
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
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>
                {{ ucwords(strtolower($dokumen->pelamar->posisi)) }}
            </td>
        </tr>
        <tr>
            <td>Unit Kerja</td>
            <td>:</td>
            <td>PT BPR Kusuma Sumbing {{ $dokumen->cabang->cabang }}</td>
        </tr>
    </table>


    <br>
    <p>
        Dengan ini menyatakan bahwa :
    </p>
    <div class="row" style="margin-left: 1rem;">
        <div class="col-md-1">1.</div>
        <div class="col-md-11" style="width: 93% !important">
            Bersedia menyerahkan berupa Ijazah asli {{ $dokumen->tingkatan }} saya No. {{ $dokumen->no_ijazah }}
            tanggal {{ $dokumen->tgl_ijazah->translatedFormat('d F Y') }} pada
            tanggal {{ $dokumen->tgl_penyerahan->translatedFormat('d F Y') }} kepada PT BPR Kusuma Sumbing untuk
            disimpan sebagai Jaminan Kerja, memenuhi perjanjian kerja No. {{ $dokumen->nomor_pk }} pada tanggal
            {{ $dokumen->tgl_pk->translatedFormat('d F Y') }} .
        </div>
        <div class="clearfix"></div>
        <div class="col-md-1">2.</div>
        <div class="col-md-11" style="width: 93% !important">
            Penyerahan Jamker tersebut saya lakukan dengan penuh kesadaran dan tanpa unsur paksaan dari pihak manapun.
        </div>
    </div>

    <br>

    <p>
        Demikian surat pernyataan ini kami buat dengan sadar tanpa ada unsur paksaan dari pihak mana pun.
    </p>


    <br>
    <br>
    <br>
    <table>
        <tr>
            <td style="text-align: center">
                {{ ucwords(strtolower($dokumen->cabang->alamat)) }}, {{ now()->translatedFormat('d F Y') }} <br>
                Yang membuat pernyataan, <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                {{ ucwords(strtolower($dokumen->pelamar->nama)) }}
            </td>
        </tr>
    </table>


    {{-- <script type="text/php">
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
    </script> --}}

</body>

</html>
