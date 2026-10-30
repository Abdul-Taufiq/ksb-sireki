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
                                <label for="status_filter" class="sr-only">Status:</label>
                                <select name="status_filter" id="status_filter" class="form-select">
                                    <option selected disabled>-Pilih-</option>
                                    <option value="Screening Berkas">Screening Berkas</option>
                                    <option value="Assesment/Psikotes">Assesment/Psikotes</option>
                                    <option value="Teruskan ke SDM">Teruskan ke SDM</option>
                                    <option value="Interview User">Interview User</option>
                                    <option value="Interview SDM">Interview SDM</option>
                                    <option value="Offering/Finalisasi">Offering/Finalisasi</option>
                                    <option value="Arsip u/ DB Calon Karyawan">Arsip u/ DB Calon Karyawan</option>
                                    <option value="Tidak Lolos Seleksi">Tidak Lolos Seleksi</option>
                                    <option value="Tidak Sesuai Kualifikasi">Tidak Sesuai Kualifikasi</option>
                                </select>
                            </div>

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
                                <th>Status</th>
                                <th>KC</th>
                                <th>Nama</th>
                                <th>TTL</th>
                                <th>Kontak</th>
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

    {{-- modal edit Statys --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalStatus" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form id="quickForm" method="POST" action="{{ route('applicant.changeStatus') }}">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalStatus">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_pelamar" name="id_pelamar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-select form-select-sm input"
                                        required>
                                        <option selected disabled>-Pilih-</option>

                                        @if (Auth::user()->level == 'MEDIUM USER')
                                            <option value="Screening Berkas">Screening Berkas</option>
                                            <option value="Assesment/Psikotes">Assesment/Psikotes</option>
                                            <option value="Selesai Tes">Selesai Tes</option>
                                            <option value="Interview User">Interview User</option>
                                            <option value="Teruskan ke SDM">Teruskan ke SDM</option>
                                            <option value="Tidak Lolos Seleksi">Tidak Lolos Seleksi</option>
                                        @endif

                                        @if (Auth::user()->level == 'SUPER USER')
                                            <option value="Screening Berkas">Screening Berkas</option>
                                            <option value="Assesment/Psikotes">Assesment/Psikotes</option>
                                            <option value="Selesai Tes">Selesai Tes</option>
                                            <option value="Interview User">Interview User</option>
                                            <option value="Interview SDM">Interview SDM</option>
                                            <option value="Offering/Finalisasi">Offering/Finalisasi</option>
                                            <option value="Arsip u/ DB Calon Karyawan">Arsip u/ DB Calon Karyawan</option>
                                            <option value="Tidak Lolos Seleksi">Tidak Lolos Seleksi</option>
                                            {{-- <option value="Diterima">Diterima</option> --}}
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" id="head_paket_soal">
                                <div class="form-group mb-3">
                                    <label for="paket_soal">Paket Soal <small><i>(Untuk Soal Tes)</i></small></label>
                                    <select name="paket_soal" id="paket_soal" class="form-select form-select-sm input"
                                        required>
                                        <option selected disabled>-Pilih Paket-</option>
                                        @foreach ($paket as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_paket }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="wajib" for="catatan">Catatan</label>
                            <textarea required name="catatan" id="catatan"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="jadwalkan">Jadwalkan?</label>
                                    <select name="jadwalkan" id="jadwalkan" class="form-select form-select-sm input"
                                        required>
                                        <option selected disabled>-Pilih-</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3" id="head_jadwal">
                                <div class="form-group">
                                    <label for="tgl_jadwal">Jadwal</label>
                                    <input type="datetime-local" name="tgl_jadwal" id="tgl_jadwal"
                                        class="form-control form-control-sm input" required>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3" id="head_keterangan">
                                <div class="form-group">
                                    <label class="wajib" for="keterangan">Keterangan</label>
                                    <textarea required name="keterangan" id="keterangan"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="simpan" type="button" class="btn btn-primary" style="letter-spacing: 2px;">
                            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status"
                                aria-hidden="true"></span>
                            <i class="bi bi-floppy2"></i><span id="btnText"><b> SIMPAN</b></span>
                        </button>
                    </div>
                </div>

            </form>
        </div>
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

        $(document).ready(function() {
            initializeSummernote("#catatan", "Catatan...", 80);
            initializeSummernote("#keterangan", "Keterangan...", 80);

            let jadwalkan = document.getElementById('jadwalkan');
            let tgl_jadwal = document.getElementById('tgl_jadwal');
            let keterangan = document.getElementById('keterangan');
            let head_jadwal = document.getElementById('head_jadwal');
            let head_keterangan = document.getElementById('head_keterangan');

            jadwalkan.addEventListener('change', function() {
                let val = this.value;

                if (val === 'Ya') {
                    tgl_jadwal.setAttribute('required', 'true');
                    keterangan.setAttribute('required', 'true');
                    head_jadwal.classList.remove('d-none');
                    head_keterangan.classList.remove('d-none');
                } else {
                    tgl_jadwal.removeAttribute('required');
                    keterangan.removeAttribute('required');
                    head_jadwal.classList.add('d-none');
                    head_keterangan.classList.add('d-none');
                }
            });


            let status = document.getElementById('status');
            let paket_soal = document.getElementById('paket_soal');
            let head_paket_soal = document.getElementById('head_paket_soal');

            status.addEventListener('change', function() {
                let val = this.value;

                if (val === 'Assesment/Psikotes') {
                    paket_soal.setAttribute('required', 'true');
                    head_paket_soal.classList.remove('d-none');
                } else {
                    paket_soal.removeAttribute('required');
                    head_paket_soal.classList.add('d-none');
                }
            })

        });

        $(function() {
            $("input").attr("autocomplete", "off");
            // Default semua form diberi border merah
            $(".input").addClass("is-invalid");

            // Event listener untuk semua elemen dengan class .input
            $(document).on("input change", ".input", function() {
                var value = $(this).val();

                if (value && value.toString().trim() !== "") {
                    // Ada value → hijau
                    $(this).addClass("is-valid").removeClass("is-invalid");
                } else {
                    // Kosong → merah
                    $(this).addClass("is-invalid").removeClass("is-valid");
                }
            });

            // Cek kondisi awal (misalnya form edit sudah ada value)
            $(".input").each(function() {
                var value = $(this).val();
                if (value && value.toString().trim() !== "") {
                    $(this).addClass("is-valid").removeClass("is-invalid");
                }
            });

            for (let i = 1; i <= 20; i++) {
                if (document.getElementById(`nama_${i}`)) {
                    autoFill(i);
                    updateAdminSurvey(i);
                }
            }
        })
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
                    [8, "desc"]
                ],
                ajax: {
                    type: 'GET',
                    url: 'applicant',
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
                        data: "status",
                        name: "status",
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
                        data: "email",
                        name: "email",
                        render: function(data, type, row) {
                            return `<i class="bi bi-envelope-at"></i>: 
                                <a href="mailto:${row.email}" target="_blank">
                                    ${row.email}
                                </a> <br>
                                <i class="bi bi-telephone"></i>: 
                                <a href="https://wa.me/${row.no_telp}" target="_blank">
                                    ${row.no_telp}
                                </a>
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


    {{-- config show data --}}
    <script>
        $(document).ready(function() {
            $("body").on("click", ".detail_data", function() {
                var Id = $(this).attr("id");
                var kode = $(this).data("kode");

                $("#modalHeader").text("DETAIL DATA - " + kode);
                $("#frameDetail").attr("src", "/applicant/" + Id);
            });
        });
    </script>


    {{-- config change status data --}}
    <script>
        $(document).ready(function() {
            $("body").on("click", ".changeStatus", function() {
                var Id = $(this).data("id");
                var kode = $(this).data("kode");

                $("#modalStatus").text("Ganti Status - " + kode);

                document.getElementById('id_pelamar').value = Id;
            });
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
                        url: '/applicant/' + id, // route destroy
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
