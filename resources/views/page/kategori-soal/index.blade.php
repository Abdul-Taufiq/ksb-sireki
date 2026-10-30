@extends('partial.main')

@section('style')
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <style>
        th,
        td {
            white-space: nowrap;
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
                        <a class="btn btn-primary btn-icon-split btn-sm" href="{{ route('kategori-soal.create') }}">
                            <span class="icon text-white-50">
                                <i class="bi bi-file-earmark-plus"></i>
                            </span>
                            <span class="text">Tambah {{ $title }}</span>
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
                            {{-- @if (auth()->user()->id_cabang == 0)
                                <div class="form-group m-1">
                                    <label for="id_cabang" class="sr-only">Cabang:</label>
                                    <select name="id_cabang" id="id_cabang" class="form-control">
                                        <option selected value="99">All Cabang</option>
                                        <option value="1">KPO</option>
                                        <option value="2">Kc Temanggun</option>
                                        <option value="3">Kc Wonosobo</option>
                                        <option value="4">Kc Ambarawa</option>
                                        <option value="5">Kc Semarang</option>
                                        <option value="6">Kc Mranggen</option>
                                        <option value="7">Kc Sukorejo</option>
                                        <option value="8">Kc Weleri</option>
                                        <option value="9">Kc Delanggu</option>
                                        <option value="10">Kc Gombong</option>
                                        <option value="11">Kc Sokaraja</option>
                                    </select>
                                </div>
                            @endif --}}
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
                        class="table table-sm table-hover table-striped table-responsive-md display mt-2 w-100 display">
                        <thead class="table-info text-center">
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 13%">Aksi</th>
                                <th>Password Tes</th>
                                <th>Nama Tes</th>
                                <th>Jumlah Soal</th>
                                <th>Durasi</th>
                                <th>Created At</th>
                                <th>Range Istimewa</th>
                                <th>Range Baik</th>
                                <th>Range Cukup</th>
                                <th>Range Kurang</th>
                                <th>Range Buruk</th>
                                <th>Petunjuk Tes</th>
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

            // Kondisi memunculkan button export
            var level = document.getElementById('level').value;
            var buttons = ["colvis"];

            if (level === "SUPER USER" || level === "DIREKTUR") {
                buttons.push({
                    extend: "copyHtml5",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                }, {
                    extend: "excelHtml5",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                }, {
                    extend: "pdfHtml5",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
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
                scrollX: true,

                processing: true,
                serverSide: true,
                order: [
                    [5, "Asc"]
                ],
                ajax: {
                    type: 'GET',
                    url: 'kategori-soal',
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
                        data: "action",
                        name: "action",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "password_tes",
                        name: "password_tes",
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: "nama_tes",
                        name: "nama_tes"
                    },
                    {
                        data: "jumlah_soal",
                        name: "jumlah_soal"
                    },
                    {
                        data: "waktu",
                        name: "waktu",
                        render: function(data, type, row) {
                            return data + " " + row.satuan_waktu;
                        }
                    },
                    {
                        data: "created_at",
                        name: "created_at",
                        // orderable: false,
                        searchable: false,
                        visible: false
                    },
                    {
                        data: "istimewa_start",
                        name: "istimewa_start",
                        render: function(data, type, row) {
                            return data + " - " + row.istimewa_end;
                        }
                    },
                    {
                        data: "baik_start",
                        name: "baik_start",
                        render: function(data, type, row) {
                            return data + " - " + row.baik_end;
                        }
                    },
                    {
                        data: "cukup_start",
                        name: "cukup_start",
                        render: function(data, type, row) {
                            return data + " - " + row.cukup_end;
                        }
                    },
                    {
                        data: "kurang_start",
                        name: "kurang_start",
                        render: function(data, type, row) {
                            return data + " - " + row.kurang_end;
                        }
                    },
                    {
                        data: "buruk_start",
                        name: "buruk_start",
                        render: function(data, type, row) {
                            return " < " + data;
                        }
                    },
                    {
                        data: "petunjuk_tes",
                        name: "petunjuk_tes",
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return data;
                        }
                    },
                ],

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


    {{-- delete --}}
    <script>
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            Swal.fire({
                title: 'Yakin hapus data?',
                text: "Data akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'kategori-soal/' + id, // route destroy
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Terhapus!',
                                'Data berhasil dihapus.',
                                'success'
                            );
                            // reload DataTable atau hapus row manual
                            $('#table_index').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>
@endsection
