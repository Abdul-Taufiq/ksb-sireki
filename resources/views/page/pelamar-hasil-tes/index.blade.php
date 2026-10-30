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
                    -
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
                                <th>TTL</th>
                                <th>Posisi Dilamar</th>
                                <th>Tanggal Dikirim</th>
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
        function loadtable(min, max, id_cabang, status_filter) {
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
                    [6, "desc"]
                ],
                ajax: {
                    type: 'GET',
                    url: 'hasil-test-peserta',
                    data: function(d) {
                        d.min = min;
                        d.max = max;
                        d.id_cabang = id_cabang; // kalau mau kirim kode juga
                        d.status_filter = status_filter; // kalau mau kirim kode juga
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
                    },
                    {
                        data: "nama",
                        name: "nama",
                        render: function(data, type, row) {
                            return `
                                ${row.nama} <br>
                                <b><i>${row.kode_pelamar}</i></b>
                            `
                        }
                    },
                    {
                        data: "tempat_lahir",
                        name: "tempat_lahir",
                        render: function(data, type, row) {
                            const date = moment(row.tgl_lahir).locale("id").format("DD MMM YYYY");
                            return `
                                ${row.tempat_lahir}, ${date}
                            `
                        }
                    },
                    {
                        data: "posisi",
                        name: "posisi"
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
            let status_filter = $("#status_filter").val();
            $("#table_index").DataTable().destroy();

            loadtable(min, max, id_cabang, status_filter);
        });

        // reset filter
        $(document).on("click", "#btn-refresh", function() {
            $("#table_index").DataTable().destroy();
            loadtable();
        });
    </script>
@endsection
