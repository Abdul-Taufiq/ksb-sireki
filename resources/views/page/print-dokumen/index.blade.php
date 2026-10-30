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
                    <a class="btn btn-primary btn-icon-split btn-sm" href="{{ route('print-document.create') }}">
                        <span class="icon text-white-50">
                            <i class="bi bi-file-earmark-plus"></i>
                        </span>
                        <span class="text">Tambah {{ $title }}</span>
                    </a>
                </div>
                <div class="card-body">
                    {{-- filter --}}
                    <div class="d-flex align-items-center justify-content-center flex-wrap mb-4">
                        <strong class="m-1">
                            <span class="text">Filter</span>
                        </strong>
                        <div class="d-flex align-items-end ">
                            @if (auth()->user()->id_cabang == 0)
                                <div class="form-group m-1">
                                    <label for="id_cabang" class="sr-only">Cabang:</label>
                                    <select name="id_cabang" id="id_cabang" class="form-control">
                                        <option selected value="99">All Cabang</option>
                                        <option value="1">KPO</option>
                                        <option value="2">Kc Temanggung</option>
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
                            @endif

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
                                <th>#</th>
                                <th>Aksi</th>
                                <th>KC</th>
                                <th>Nama</th>
                                <th>Pakta Integritas</th>
                                <th>Kode Etik</th>
                                <th>SP Jamker</th>
                                <th>BA Jamker</th>
                                <th>SP Slik</th>
                                <th>Created at</th>
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


    <input type="hidden" name="level" id="level" value="{{ Auth::user()->level }}">
@endsection


@section('script')
    <!-- JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment-with-locales.min.js"
        smbFGFpmeFlQgoDccgg==" crossorigin=" anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('script/confirm-button.js') }}"></script>


    <script>
        $(document).ready(function() {
            loadtable();
        });
    </script>

    {{-- config datatbles --}}
    <script>
        function loadtable(min, max, id_cabang) {

            // Kondisi memunculkan button export
            var level = document.getElementById('level').value;
            var buttons = ["colvis"];

            if (level === "SUPER USER" || level === "DIREKTUR") {
                buttons.push({
                    extend: "copyHtml5",
                    exportOptions: {
                        columns: [0, 3, 4, 5, 6, 7, 8]
                    }
                }, {
                    extend: "excelHtml5",
                    exportOptions: {
                        columns: [0, 3, 4, 5, 6, 7, 8]
                    }
                }, {
                    extend: "pdfHtml5",
                    exportOptions: {
                        columns: [0, 3, 4, 5, 6, 7, 8]
                    }
                });
            }

            // url gambar
            // const baseImgUrl = "{{ asset('file_upload/img') }}";
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
                    [9, "desc"]
                ],
                ajax: {
                    type: 'GET',
                    url: 'print-document',
                    data: function(d) {
                        d.min = min;
                        d.max = max;
                        d.id_cabang = id_cabang; // kalau mau kirim kode juga
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
                        data: "cabang",
                        name: "cabang",
                    }, {
                        data: "pelamar.nama",
                        name: "pelamar.nama",
                        render: function(data, type, row) {
                            if (!row.pelamar) {
                                return '-';
                            }

                            return `
                                ${row.pelamar.nama ?? '-'}
                                <br>
                                <b><i>${row.pelamar.kode_pelamar ?? '-'}</i></b>
                            `;
                        }
                    },

                    {
                        data: 'tgl_print_pakta',
                        data: 'tgl_print_pakta',
                        render: function(data, type, row) {
                            if (data) {
                                return moment(data).locale("id").format("DD MMM YYYY, HH:mm");
                            } else {
                                return '-';
                            }
                        }
                    },
                    {
                        data: 'tgl_print_kode_etik',
                        data: 'tgl_print_kode_etik',
                        render: function(data, type, row) {
                            if (data) {
                                return moment(data).locale("id").format("DD MMM YYYY, HH:mm");
                            } else {
                                return '-';
                            }
                        }
                    },
                    {
                        data: 'tgl_print_sp_jamker',
                        data: 'tgl_print_sp_jamker',
                        render: function(data, type, row) {
                            if (data) {
                                return moment(data).locale("id").format("DD MMM YYYY, HH:mm");
                            } else {
                                return '-';
                            }
                        }
                    },
                    {
                        data: 'tgl_print_ba_jamker',
                        data: 'tgl_print_ba_jamker',
                        render: function(data, type, row) {
                            if (data) {
                                return moment(data).locale("id").format("DD MMM YYYY, HH:mm");
                            } else {
                                return '-';
                            }
                        }
                    },
                    {
                        data: 'tgl_print_sp_slik',
                        data: 'tgl_print_sp_slik',
                        render: function(data, type, row) {
                            if (data) {
                                return moment(data).locale("id").format("DD MMM YYYY, HH:mm");
                            } else {
                                return '-';
                            }
                        }
                    },
                    {
                        data: "created_at",
                        name: "created_at",
                        render: function(data, type, row) {
                            return moment(data).locale("id").format("DD MMM YYYY, HH:mm")
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
            let id_cabang = $("#id_cabang").val();
            $("#table_index").DataTable().destroy();

            loadtable(min, max, id_cabang);
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
                        url: '/print-document/' + id, // route destroy
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
