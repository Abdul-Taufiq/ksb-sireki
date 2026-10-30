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
            margin: 0.8cm 1cm 1cm 1.5cm;
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

        strong {
            font-size: 12pt !important;
        }
    </style>
</head>

<body>
    <table class="table table-bordered  w-100 mb-2">
        <tr>
            <td style="width: 70%; vertical-align: top; border: none;">
                <strong style="text-decoration: underline;">RESUME TEST PROSES REKRUTMEN KANDIDAT</strong>
                <table class="table table-borderless table-sm ">
                    <tr>
                        <th style="width: 28%">Atas Nama</th>
                        <td style="width: 2%">:</td>
                        <td>{{ $pelamar->nama }}</td>
                    </tr>
                    <tr>
                        <th style="width: 28%">Jabatan</th>
                        <td style="width: 2%">:</td>
                        <td>{{ $pelamar->posisi }}</td>
                    </tr>
                    <tr>
                        <th style="width: 28%">Rnc Penempatan</th>
                        <td style="width: 2%">:</td>
                        <td>{{ $pelamar->cabang->cabang }}</td>
                    </tr>
                    <tr>
                        <th style="width: 28%">Seleksi</th>
                        <td style="width: 2%">:</td>
                        <td>{{ $jadwal->tgl_jadwal->translatedFormat('d F Y') }}</td>
                    </tr>
                </table>
            </td>
            <td style="border: none;">
                <strong style="color: white; background-color: blue; outline: 4px solid yellow; padding: 4px">
                    BIDANG SDM/KP.PRK
                </strong>
            </td>
        </tr>
    </table>

    <strong>PENILAIAN</strong>
    <table class="table table-sm table-striped table-bordered">
        <thead style="text-align: center">
            <tr>
                <th style="width: 5%; background-color: rgb(169, 167, 167);">NO</th>
                <th style="width: 45%; background-color: rgb(169, 167, 167);">TEST</th>
                <th style="width: 20%; background-color: rgb(169, 167, 167);">SKOR</th>
                <th style="width: 20%; background-color: rgb(169, 167, 167);">KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1; // deklarasi sekali saja
            @endphp

            {{-- Loop paket kategori --}}
            @foreach ($paket->paketkategori as $relasi)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $relasi->kategori->nama_tes }}</td>
                    <td style="text-align: center">
                        @php
                            $benar = null;
                            if (
                                $relasi->kategori->nama_tes == 'Kraepelin Assesment' ||
                                $relasi->kategori->nama_tes == 'Kraepelin Rekrut'
                            ) {
                                $benar = $answers_krap->count();
                            } else {
                                $benar = $answers->where('nama_tes', $relasi->kategori->nama_tes)->count();
                            }
                        @endphp

                        @if ($relasi->kategori->nama_tes != 'DISC' && $relasi->kategori->nama_tes != 'MBTI')
                            {{ $benar }} / {{ $relasi->kategori->jumlah_soal }}
                        @endif
                    </td>
                    <td style="text-align: center">
                        @php
                            $grade = null;
                            if ($relasi->kategori->istimewa_start != null && $relasi->kategori->istimewa_start != '-') {
                                if ($benar >= $relasi->kategori->istimewa_start) {
                                    $grade = 'Istimewa';
                                } elseif (
                                    $benar >= $relasi->kategori->baik_start &&
                                    $benar <= $relasi->kategori->baik_end
                                ) {
                                    $grade = 'Baik';
                                } elseif (
                                    $benar >= $relasi->kategori->cukup_start &&
                                    $benar <= $relasi->kategori->cukup_end
                                ) {
                                    $grade = 'Cukup';
                                } elseif (
                                    $benar >= $relasi->kategori->kurang_start &&
                                    $benar <= $relasi->kategori->kurang_end
                                ) {
                                    $grade = 'Kurang';
                                } elseif ($benar <= $relasi->kategori->buruk_start) {
                                    $grade = 'Buruk';
                                } else {
                                    $grade = 'Tidak terdefinisi';
                                }
                            } else {
                                $grade = 'Tidak terdefinisi';
                            }
                        @endphp

                        @if ($relasi->kategori->nama_tes != 'DISC' && $relasi->kategori->nama_tes != 'MBTI')
                            {{ $grade }}
                        @endif
                    </td>
                </tr>
            @endforeach

            {{-- Loop penilaian tes --}}
            @php
                $penilaianTes = json_decode($resume->penilaian_tes, true);
            @endphp

            @if (is_array($penilaianTes))
                @foreach ($penilaianTes as $data)
                    @php
                        $skip = $data['tes'] === '-' && $data['skor'] === '-' && $data['keterangan'] === '-';
                    @endphp

                    @if (!$skip)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $data['tes'] }}</td>
                            <td style="text-align: center">{{ $data['skor'] }}</td>
                            <td style="text-align: center">{{ $data['keterangan'] }}</td>
                        </tr>
                    @endif
                @endforeach
            @endif
        </tbody>

    </table>


    <table class="table table-sm table-bordered">
        <thead style="text-align: center">
            <tr>
                <th colspan="2" style="background-color: rgb(169, 167, 167);">
                    ANALISA STRONG/WEEK POINT (+) dan (-)
                </th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align: center">
                <td style="width: 50%">Kelebihan</td>
                <td style="width: 50%">Kekurangan</td>
            </tr>
            <tr>
                <td>{!! $resume->analisa_kelebihan !!}</td>
                <td>{!! $resume->analisa_kekurangan !!}</td>
            </tr>
        </tbody>
    </table>


    <table class="table table-sm table-bordered">
        <thead style="text-align: center">
            <tr>
                <th colspan="2" style="background-color: rgb(169, 167, 167);">
                    CATATAN CEK LINGK/REPUTASI/KONDITE
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {!! $resume->catatan_slik !!}
                    <br>
                    <hr>
                    {!! $resume->catatan_lainnya !!}
                </td>
                <td>{!! $resume->kondite_tempat_kerja !!}</td>
            </tr>
        </tbody>
    </table>

    <table class="table table-sm table-bordered">
        <thead style="text-align: center">
            <tr>
                <th style="background-color: rgb(169, 167, 167);">
                    REKOMENDASI BIDANG SDM
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{ $resume->rekomendasi_sdm }}
                </td>
            </tr>
        </tbody>
    </table>


    <table class="table table-sm table-bordered">
        <thead style="text-align: center">
            <tr>
                <th colspan="3" style="background-color: rgb(169, 167, 167);">
                    PERSETUJUAN DAN PERTIMBANGAN USER
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>[ &nbsp; ] Menyetujui</td>
                <td>[ &nbsp; ] Tidak Menyetujui</td>
                <td>[ &nbsp; ] Dipertimbangkan lain</td>
            </tr>
        </tbody>
    </table>

    <p>
        ...............................................................................................................................................................
    </p>
    <p>
        ...............................................................................................................................................................
    </p>
    <p>
        ...............................................................................................................................................................
    </p>
    <p>
        ...............................................................................................................................................................
    </p>

    <br>
    <table class="table table-sm table-borderless">
        <tbody>
            <tr>
                <td>Nama:</td>
                <td>Jabatan:</td>
                <td>Ttd/Paraf:</td>
            </tr>
        </tbody>
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
