@extends('partial.main')

@section('style')
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <style>
        @media print {

            @page {
                /* size: A4 portrait; */
                margin: 5mm;
            }

            body {
                margin: 0 !important;
                padding: 0 !important;
                background: white !important;
                color: #000 !important;
            }

            /* Sembunyikan navigasi */
            header,
            footer,
            nav,
            aside,
            .sidebar,
            .app-sidebar,
            .app-header,
            .app-footer,
            .no-print,
            .btn {
                display: none !important;
            }

            /* Reset wrapper layout */
            .app-wrapper,
            .app-main,
            .app-content-wrapper,
            .app-container {
                width: 100% !important;
                max-width: none !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            /* HANYA INI YANG DICETAK */
            .app-content {
                display: block !important;
                position: static !important;

                width: 100% !important;
                max-width: none !important;

                margin: 0 !important;
                padding: 0 !important;
            }

            .app-content .container-fluid {
                width: 100% !important;
                max-width: none !important;

                margin: 0 !important;
                padding: 0 !important;
            }

            .app-content .card {
                margin: 0 !important;
                box-shadow: none !important;
            }

            /* Tabel */
            .app-content table {
                width: 100% !important;
            }

            .app-content tr {
                page-break-inside: avoid !important;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
@endsection

@section('content')
    <div class="row m-2">
        <div class="col-md-6">
            <button type="button" class="btn btn-primary no-print w-50 mb-2" style="margin: auto" onclick="window.print()">🖨️
                Print</button>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('hasil-test-peserta.show', base64_encode($pelamar->id_pelamar)) }}"
                class="btn btn-secondary no-print w-50 mb-2" style="margin: auto">🔙
                Kembali</a>
        </div>
    </div>


    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header p-2 m-2">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Nama Peserta : </strong> {{ $pelamar->nama }} <br>
                            <strong>Nama Tes : </strong> {{ $kategori->nama_tes }} <br>
                            <strong>Jumlah Soal : </strong> {{ $kategori->jumlah_soal }} <br>
                            <strong>Waktu Pengerjaan : </strong> {{ $kategori->waktu }} {{ $kategori->satuan_waktu }}
                        </div>
                        <div class="col-md-6">
                            <strong>Dikerjakan Pada : </strong> {{ optional($tgl_pengerjaan)->translatedFormat('d F Y ') }}
                            <br>
                            <strong>Jumlah Benar : </strong> {{ $benar }} <br>
                            <strong>Jumlah Salah : </strong> {{ $salah }} <br>

                            @php
                                $grade = null;
                                if (
                                    $kategori->istimewa_start != null ||
                                    $kategori->istimewa_start != '-' ||
                                    $kategori->istimewa_start != '0'
                                ) {
                                    if ($benar >= $kategori->istimewa_start) {
                                        $grade = 'Istimewa';
                                    } elseif ($benar >= $kategori->baik_start && $benar <= $kategori->baik_end) {
                                        $grade = 'Baik';
                                    } elseif ($benar >= $kategori->cukup_start && $benar <= $kategori->cukup_end) {
                                        $grade = 'Cukup';
                                    } elseif ($benar >= $kategori->kurang_start && $benar <= $kategori->kurang_end) {
                                        $grade = 'Kurang';
                                    } elseif ($benar <= $kategori->buruk_start) {
                                        $grade = 'Buruk';
                                    } else {
                                        $grade = 'Tidak terdefinisi';
                                    }
                                } else {
                                    $grade = 'Tidak terdefinisi';
                                }
                            @endphp
                            <strong>GRADE: </strong> {{ $grade }}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-striped table-sm w-100">
                        <thead>
                            <tr>
                                <th style="width: 4%">#</th>
                                <th style="width: 50%">Pertanyaan</th>
                                <th style="width: 40%">Jawaban Peserta</th>
                                <th style="width: 6%">Benar?</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soal as $index => $item)
                                <tr>
                                    <td></td>
                                    <td>
                                        @if (auth()->user()->level == 'SUPER USER' || auth()->user()->level == 'DIREKTUR')
                                            @if ($kategori->nama_tes == 'Kraepelin Rekrut' || $kategori->nama_tes == 'Kraepelin Assesment')
                                                {{ $item->nilai_1 }} + {{ $item->nilai_2 }} <br>
                                            @else
                                                {!! $item->pertanyaan !!} <br>
                                            @endif

                                            @php
                                                $opsiArray = json_decode($item->opsi_jawaban, true) ?? [];

                                                // buang elemen ke-5 kalau nilainya "-"
                                                if (isset($opsiArray[4]) && $opsiArray[4] === '-') {
                                                    unset($opsiArray[4]);
                                                }

                                                // reset index array setelah unset
                                                $opsiArray = array_values($opsiArray);
                                            @endphp

                                            @if (!empty($opsiArray) && !collect($opsiArray)->every(fn($val) => $val === '-'))
                                                <strong>Opsi Jawaban:</strong>
                                                <ul>
                                                    @foreach ($opsiArray as $index => $opsi)
                                                        <li>{{ $opsi }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                            @if ($item->kunci_jawaban != null && $item->kunci_jawaban != '-')
                                                <strong>Kunci Jawaban: </strong>{{ $item->kunci_jawaban }}
                                            @endif
                                        @else
                                            <span class="text-muted">Hanya bisa dilihat oleh SUPER USER dan DIREKTUR</span>
                                        @endif

                                    </td>
                                    <td>
                                        {{ optional($item->answer->first())->answer }}
                                        @if ($kategori->nama_tes == 'Kraepelin Rekrut' || $kategori->nama_tes == 'Kraepelin Assesment')
                                            <i>(periode-{{ optional($item->answer->first())->answer_periode }})</i>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->answer->first() != null)
                                            @if (optional($item->answer->first())->is_correct == 'true')
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle p-0" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                        {{ auth()->user()->level != 'SUPER USER' ? 'disabled' : '' }}>
                                                        <span class="badge bg-success">✅</span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('hasil-test-peserta-detail.ganti-jawaban', [$item->answer->first()->id, 'false', $kategori->nama_tes]) }}">
                                                                <span class="badge bg-danger">❌ Koreksi Jawaban ke
                                                                    Salah</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @else
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle p-0" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                        {{ auth()->user()->level != 'SUPER USER' ? 'disabled' : '' }}>
                                                        <span class="badge bg-danger">❌</span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('hasil-test-peserta-detail.ganti-jawaban', [$item->answer->first()->id, 'true', $kategori->nama_tes]) }}">
                                                                <span class="badge bg-success">✅ Koreksi Jawaban ke
                                                                    Benar</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        @else
                                            <span class="badge bg-secondary">Belum Dijawab</span>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                        @if ($kategori->nama_tes === 'Kraepelin Rekrut' || $kategori->nama_tes == 'Kraepelin Assesment')
                            <tbody>
                                <tr>
                                    <td colspan="4"> <br>
                                        <h6>Rekap Per Periode</h6>
                                        <ul>
                                            @foreach ($periodeStats as $periode => $stat)
                                                <li>
                                                    Periode {{ $periode }} = dikerjakan {{ $stat['total'] }},
                                                    benar {{ $stat['benar'] }},
                                                    salah {{ $stat['salah'] }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>


    <input type="hidden" name="level" id="level" value="{{ Auth::user()->level }}">
    <input type="hidden" name="kategori" id="kategori" value="{{ $kategori->nama_tes }}">
@endsection


@section('script')
    <!-- JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment-with-locales.min.js"
        smbFGFpmeFlQgoDccgg==" crossorigin=" anonymous" referrerpolicy="no-referrer"></script>

    <script>
        // ambil level user
        const level = document.getElementById('level').value;
        const kategori = document.getElementById('kategori').value;

        // default tombol
        let buttons = ["colvis"];

        // kondisi tombol export
        if (level === "SUPER USER" || level === "DIREKTUR") {
            // siapkan pesan rekap kalau kategori Kraepelin
            let messageBottomText = "";
            if (kategori === "Kraepelin Rekrut" || kategori === "Kraepelin Assesment") {
                messageBottomText = `
            Rekap Per Periode:
            @foreach ($periodeStats as $periode => $stat)
                Periode {{ $periode }} = dikerjakan {{ $stat['total'] }},
                benar {{ $stat['benar'] }},
                salah {{ $stat['salah'] }}
            @endforeach
        `;
            }

            buttons.push({
                extend: "copyHtml5",
                exportOptions: {
                    columns: [0, 1, 2, 3]
                },
                messageBottom: messageBottomText
            }, {
                extend: "excelHtml5",
                exportOptions: {
                    columns: [0, 1, 2, 3]
                },
                messageBottom: messageBottomText
            }, {
                extend: "pdfHtml5",
                exportOptions: {
                    columns: [0, 1, 2, 3]
                },
                messageBottom: messageBottomText
            });
        }


        // inisialisasi DataTable
        const table = new DataTable('#table', {
            paging: true,
            searching: true,
            responsive: true,
            dom: "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
            buttons: buttons,
            lengthMenu: [
                [10, 20, 50, -1],
                [10, 20, 50, "Semua"],
            ],
            columnDefs: [{
                    targets: 0,
                    orderable: false
                } // kolom nomor tidak bisa di-sort
            ],
            // order: [
            //     [1, 'asc']
            // ], // default sort di kolom Pertanyaan
            drawCallback: function(settings) {
                let api = this.api();
                api.column(0, {
                        search: 'applied',
                        order: 'applied'
                    })
                    .nodes()
                    .each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
            }
        });
    </script>
@endsection
