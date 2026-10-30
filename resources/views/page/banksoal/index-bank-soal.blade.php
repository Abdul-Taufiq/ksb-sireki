@extends('partial.main')

@section('style')
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/6.0.0/css/fixedColumns.dataTables.min.css">

    <style>
        p {
            margin-bottom: 2px;
        }
    </style>
@endsection

@section('content')
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header p-2">
                    @if (Auth::user()->jabatan === 'SDM')
                        <a class="btn btn-primary btn-icon-split btn-sm m-2"
                            href="{{ route('sesi-tes.create', ['tes' => $namaTes, 'jns_tes' => $jns_tes, 'id_kategori' => base64_encode($id_kategori_soal)]) }}">
                            <span class="icon text-white-50">
                                <i class="bi bi-file-earmark-plus"></i>
                            </span>
                            <span class="text">Tambah {{ $title }}</span>
                        </a>
                        <a class="btn btn-primary btn-icon-split btn-sm m-2"
                            href="{{ route('sesi-tes.import', ['tes' => $namaTes, 'jns_tes' => $jns_tes, 'id_kategori' => base64_encode($id_kategori_soal)]) }}">
                            <span class="icon text-white-50">
                                <i class="bi bi-file-earmark-plus"></i>
                            </span>
                            <span class="text">Import {{ $title }} by Excel</span>
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    {{-- filter --}}
                    <div class="d-flex align-items-center justify-content-center flex-wrap mb-4">
                        <strong class="m-1">
                            <span class="text">Filter</span>
                        </strong>
                        <div class="d-flex align-items-end ">
                            <div class="form-group m-1">
                                <label for="min" class="sr-only">From:</label>
                                <input type="date" name="min" id="min" class="form-control">
                            </div>

                            <div class="form-group m-1">
                                <label for="max" class="sr-only">To:</label>
                                <input type="date" name="max" id="max" class="form-control">
                            </div>
                        </div>
                        <div class="btn-group m-1">
                            <button id="btn-filter" class="btn btn-success">Filter</button>
                            <button id="btn-refresh" class="btn btn-info">Refresh</button>
                        </div>
                    </div>
                    {{-- end filter --}}

                    {{-- table & data --}}
                    <table id="table_index"
                        class="table table-sm table-hover table-striped table-responsive-md display mt-2 w-100">
                        <thead class="table-info text-center">
                            <tr>
                                <th style="width: 4%">#</th>
                                <th>Pertanyaan</th>
                                <th>Opsi Jawaban</th>
                                <th>Kunci Jawaban</th>
                                <th style="width: 17%">Created at</th>
                                <th style="width: 12%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    {{-- end table & data --}}
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>

    {{-- modal detail --}}
    <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeader" style="letter-spacing: 2px; font-weight: bold;">DETAIL
                        DATA
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="frameDetail" type="" width="100%" height="400px"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" name="level" id="level" value="{{ Auth::user()->level }}">
    <input type="hidden" name="url" id="url" value="{{ $urlIndex }}">
@endsection


@section('script')
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment-with-locales.min.js"
        smbFGFpmeFlQgoDccgg==" crossorigin=" anonymous" referrerpolicy="no-referrer"></script>


    <script>
        $(document).ready(function() {
            loadtable();
        });
    </script>

    {{-- config datatbles --}}
    <script>
        function loadtable(min, max) {
            // Ambil kode dari URL
            var urlParams = new URLSearchParams(window.location.search);
            var kode = urlParams.get("kode");
            const urlIndex = document.getElementById('url').value;

            // Kondisi memunculkan button export
            var level = document.getElementById('level').value;
            var buttons = ["colvis"];

            let columnDefsConfig;

            if (urlIndex === 'disc' || urlIndex === 'mbti') {
                columnDefsConfig = [{
                    targets: [1, 3],
                    visible: false,
                }];
            } else {
                columnDefsConfig = [{
                    targets: [2, 3],
                    visible: false,
                }];
            }

            if (level === "SUPER USER" || level === "DIREKTUR") {
                buttons.push({
                    extend: "copyHtml5",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                }, {
                    extend: "excelHtml5",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                }, {
                    extend: "pdfHtml5",
                    orientation: 'landscape', // Pilihan: 'portrait' atau 'landscape'
                    pageSize: 'LEGAL', // Pilihan: 'A3', 'A4', 'A5', 'LETTER', 'LEGAL', 'TABLOID'
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                });
            }

            // url gambar
            const baseImgUrl = "{{ asset('file_upload/img') }}";
            // Inisialisasi DataTable
            $('#table_index').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                responsive: true,

                processing: true,
                serverSide: true,
                order: [
                    [4, "DESC"]
                ],
                ajax: {
                    type: 'GET',
                    url: urlIndex,
                    data: function(d) {
                        d.min = min;
                        d.max = max;
                        d.kode = kode; // kalau mau kirim kode juga
                    }
                },
                columns: [{
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: "pertanyaan",
                        name: "pertanyaan",
                        render: function(data, type, row) {
                            // tampilkan HTML mentah saat mode display
                            if (type === 'display') {
                                return data;
                            }
                            // untuk export/print tetap string plain
                            return data;
                        }
                    },
                    {
                        data: "opsi_jawaban",
                        name: "opsi_jawaban",
                        render: function(data, type, row) {
                            // jika null atau kosong
                            if (!data || data.length === 0) {
                                return `
                                    <span class='text-muted'>
                                        <i>tidak ada data</i>
                                    </span>
                                `;
                            }

                            let html = "<ul>";

                            try {
                                // kalau data berupa string JSON, parse dulu
                                let arr = JSON.parse(data);

                                arr.forEach(function(item) {
                                    html += `<li>${item}</li>`;
                                });
                            } catch (e) {
                                // fallback: kalau bukan JSON, tampilkan apa adanya
                                html += `<li>${data}</li>`;
                            }

                            html += "</ul>";

                            if (type === 'display') {
                                return html;
                            }
                            // untuk export/print tetap string plain
                            return data;
                        }
                    },
                    {
                        data: "kunci_jawaban",
                        name: "kunci_jawaban",
                        render: function(data, type, row) {
                            // jika null atau kosong
                            if (!data || data.length === 0) {
                                return `
                                    <span class='text-muted'>
                                        <i>tidak ada data</i>
                                    </span>
                                `;
                            }
                            // tampilkan HTML mentah saat mode display
                            if (type === 'display') {
                                return data;
                            }
                            // untuk export/print tetap string plain
                            return data;
                        }
                    },
                    {
                        data: "created_at",
                        name: "created_at",
                        render: function(data) {
                            // pastikan data valid
                            if (!data) return "";

                            // format tanggal (L = lokal short date, LT = lokal time)
                            const tanggal = moment(data).locale("id").format("L");
                            const jam = moment(data).locale("id").format("LT");

                            // gabungkan dengan spasi atau tanda pemisah
                            return `${tanggal} | ${jam} WIB`;
                        }
                    },
                    {
                        data: "action",
                        name: "action",
                        orderable: false,
                        searchable: false
                    }
                ],

                columnDefs: columnDefsConfig,

                dom: "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row'<'col-md-5'i><'col-md-7'p>>",
                buttons: buttons,
                lengthMenu: [
                    [10, 20, 50, -1],
                    [10, 20, 50, "Semua"],
                ],
            });
        }

        // filter
        $(document).on("click", "#btn-filter", function() {
            let min = $("#min").val();
            let max = $("#max").val();
            $("#table_index").DataTable().destroy();
            loadtable(min, max);
        });

        // reset filter
        $(document).on("click", "#btn-refresh", function() {
            $("#table_index").DataTable().destroy();
            loadtable();
        });
    </script>


    {{-- show && --}}
    <script>
        // {{-- config show data --}}
        $(document).ready(function() {
            $("body").on("click", ".detail_data", function() {
                var Id = $(this).attr("id");

                console.log(Id);

                $("#modalHeader").text("DETAIL SOAL");
                $("#frameDetail").attr("src", "/sesi-tes/show/" + Id);
            });
        });

        // {{-- delete --}}
        $(document).on("click", ".delete-btn", function(e) {
            e.preventDefault();
            var id = $(this).data("id");

            Swal.fire({
                title: "Yakin hapus data?",
                text: "Data akan dihapus permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/bank-soal/sesi-tes/" + id, // route destroy
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            Swal.fire("Terhapus!", "Data berhasil dihapus.", "success");
                            // reload DataTable atau hapus row manual
                            $("#table_index").DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            Swal.fire(
                                "Gagal!",
                                "Terjadi kesalahan saat menghapus.",
                                "error",
                            );
                        },
                    });
                }
            });
        });
    </script>
@endsection
