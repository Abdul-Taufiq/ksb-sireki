@extends('partial.main')

@section('style')
    <!-- CSS -->
@endsection

@section('content')
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">

            <div class="card card-outline card-primary mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('print-document.pakta-integritas', ['id' => encrypt($dokumen->id)]) }}"
                                class="btn btn-outline-primary w-100" target="_blank">
                                <i class="bi bi-print"></i> Print Pakta Integritas
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('print-document.kode-etik', ['id' => encrypt($dokumen->id)]) }}"
                                class="btn btn-outline-primary w-100" target="_blank">
                                <i class="bi bi-print"></i> Print Kode Etik
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            {{-- <a href="{{ route('print-document.sp-penyerahan-jamker', ['id' => encrypt($dokumen->id)]) }}"
                                class="btn btn-outline-primary w-100" target="_blank">
                                <i class="bi bi-print"></i> Print SP Penyerahan Jamker
                            </a> --}}
                            <a data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-outline-primary w-100"
                                data-id="{{ encrypt($dokumen->id) }}">
                                <i class="bi bi-print"></i> Print SP Penyerahan Jamker
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('print-document.ba-penyerahan-jamker', ['id' => encrypt($dokumen->id)]) }}"
                                class="btn btn-outline-primary w-100" target="_blank">
                                <i class="bi bi-print"></i> Print BA Penyerahan Jamker
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('print-document.sp-slik', ['id' => encrypt($dokumen->id)]) }}"
                                class="btn btn-outline-primary w-100" target="_blank">
                                <i class="bi bi-print"></i> Print SP SLIK
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('print-document.surat-pernyataan', ['id' => encrypt($dokumen->id)]) }}"
                                class="btn btn-outline-primary w-100" target="_blank">
                                <i class="bi bi-print"></i> Print SP Kandidat
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-outline card-primary">
                <div class="card-header p-2 m-2">
                    <strong>Data Peserta</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm table-responsive table-hover table-striped">
                                <tr>
                                    <th style="width: 30%">Kode Pelamar</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        {{ $dokumen->pelamar->kode_pelamar }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Posisi yg dilamar</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        {{ $dokumen->pelamar->posisi }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">KC yg dituju</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        {{ $dokumen->pelamar->cabang?->cabang ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Kategori</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        {{ $dokumen->pelamar->kategori ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">NIK</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        {{ $dokumen->pelamar->nik }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Nama</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        {{ $dokumen->pelamar->nama }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">TTL</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        {{ $dokumen->pelamar->tempat_lahir }}
                                        {{ $dokumen->pelamar->tgl_lahir->translatedFormat('d F Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Gender</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        {{ $dokumen->pelamar->jns_kelamin }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Kontak</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        <i class="bi bi-envelope-at"></i>:
                                        <a href="mailto:{{ $dokumen->pelamar->email }}" target="_blank">
                                            {{ $dokumen->pelamar->email }}
                                        </a> <br>
                                        <i class="bi bi-telephone"></i>:
                                        <a href="https://wa.me/{{ $dokumen->pelamar->no_telp }}" target="_blank">
                                            {{ $dokumen->pelamar->no_telp }}
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm table-responsive table-hover table-striped">
                                <tr>
                                    <th style="width: 30%">Pendidikan | Jurusan</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        {{ $dokumen->pelamar->pendidikan }} | {{ $dokumen->pelamar->jurusan }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Alamat</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        {{ $dokumen->pelamar->alamat }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Domisili</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        {{ $dokumen->pelamar->domisili }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Berkas Pendukung</th>
                                    <td>:</td>
                                    <td>
                                        <a href="{{ asset('file_upload/pdf/' . $dokumen->pelamar->berkas_pendukung) }}"
                                            target="blank">
                                            {{ $dokumen->pelamar->berkas_pendukung }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status Akhir</th>
                                    <td>:</td>
                                    <td>
                                        {{ $dokumen->pelamar->status_akhir }}
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>

    {{-- modal detail --}}
    <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form id="quickForm" action="{{ route('print-document.update-data') }}" method="POST" target="_blank">
                @csrf

                <input type="text" name="id" id="id" value="{{ base64_encode($dokumen->id) }}" hidden>

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalHeader" style="letter-spacing: 2px; font-weight: bold;">
                            Print SP Penyerahan Jamker
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Update data pelamar terlebih dahulu agar bisa lanjut proses print</h4>
                        <br>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="nomor_pk">Perjanjian Kerja Nomor</label>
                                <input type="text" class="form-control form-control-sm input" name="nomor_pk"
                                    id="nomor_pk" value="{{ $dokumen->nomor_pk }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="tgl_pk">Tanggal Perjanjian Kerja</label>
                                <input type="date" class="form-control form-control-sm input" name="tgl_pk"
                                    id="tgl_pk" value="{{ optional($dokumen->tgl_pk)->format('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="jns_jamker">Jenis Jaminan Kerja</label>
                                <input type="text" class="form-control form-control-sm input" name="jns_jamker"
                                    id="jns_jamker" value="Ijazah Pendidikan" required readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="atas_nama">Atas Nama</label>
                                <input type="text" class="form-control form-control-sm input" name="atas_nama"
                                    id="atas_nama" value="{{ $dokumen->atas_nama }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="no_ijazah">Nomor Ijazah</label>
                                <input type="text" class="form-control form-control-sm input" name="no_ijazah"
                                    id="no_ijazah" value="{{ $dokumen->no_ijazah }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="tgl_ijazah">Tanggal Ijazah</label>
                                <input type="date" class="form-control form-control-sm input" name="tgl_ijazah"
                                    id="tgl_ijazah" value="{{ optional($dokumen->tgl_ijazah)->format('Y-m-d') }}"
                                    required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="tingkatan">Tingkatan</label>
                                <input type="text" class="form-control form-control-sm input" name="tingkatan"
                                    id="tingkatan" value="{{ $dokumen->tingkatan }}" required list="tingkatanList">
                                <datalist id="tingkatanList">
                                    <option value="SD">
                                    <option value="SMP">
                                    <option value="SMA">
                                    <option value="SMK">
                                    <option value="D1">
                                    <option value="D2">
                                    <option value="D3">
                                    <option value="D4">
                                    <option value="S1">
                                    <option value="S2">
                                    <option value="S3">
                                </datalist>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="instansi">Instansi</label>
                                <input type="text" class="form-control form-control-sm input" name="instansi"
                                    id="instansi" value="{{ $dokumen->instansi }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="tgl_penyerahan">Tanggal Penyerahan</label>
                                <input type="date" class="form-control form-control-sm input" name="tgl_penyerahan"
                                    id="tgl_penyerahan" value="{{ optional($dokumen->tgl_penyerahan)->format('Y-m-d') }}"
                                    required>
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
    <script src="{{ asset('script/confirm-button.js') }}"></script>

    <script>
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
        })
    </script>
@endsection
