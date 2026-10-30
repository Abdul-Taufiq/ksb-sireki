@extends('partial.main')

@section('style')
    <!-- CSS -->
@endsection

@section('content')
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">

            <div class="card card-outline card-primary mb-4">
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
                                        {{ $pelamar->kode_pelamar }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Posisi yg dilamar</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        {{ $pelamar->posisi }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">KC yg dituju</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        {{ $pelamar->cabang?->cabang ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Kategori</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        {{ $pelamar->kategori ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Nama</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        {{ $pelamar->nama }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">TTL</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        {{ $pelamar->tempat_lahir }}
                                        {{ $pelamar->tgl_lahir->translatedFormat('d F Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Gender</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        {{ $pelamar->jns_kelamin }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Kontak</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        <i class="bi bi-envelope-at"></i>:
                                        <a href="mailto:{{ $pelamar->email }}" target="_blank">
                                            {{ $pelamar->email }}
                                        </a> <br>
                                        <i class="bi bi-telephone"></i>:
                                        <a href="https://wa.me/{{ $pelamar->no_telp }}" target="_blank">
                                            {{ $pelamar->no_telp }}
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
                                        {{ $pelamar->pendidikan }} | {{ $pelamar->jurusan }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Alamat</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        {{ $pelamar->alamat }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">Domisili</th>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        {{ $pelamar->domisili }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Berkas Pendukung</th>
                                    <td>:</td>
                                    <td>
                                        <a href="{{ asset('file_upload/pdf/' . $pelamar->berkas_pendukung) }}"
                                            target="blank">
                                            {{ $pelamar->berkas_pendukung }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status Akhir</th>
                                    <td>:</td>
                                    <td>
                                        {{ $pelamar->status_akhir }}
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card card-outline card-primary">
                <div class="card-header p-2 m-2">
                    <div class="row">
                        @if (auth()->user()->level == 'SUPER USER')
                            <div class="col-md-6">
                                <a href="{{ route('resume.create', base64_encode($pelamar->id_pelamar)) }}"
                                    class="btn btn-outline-primary w-100">
                                    <i class="bi bi-plus"></i> Tambah/Edit Resume
                                </a>
                            </div>
                        @endif
                        <div class="col-md-6">
                            @if ($pelamar->printResume->isEmpty())
                                <a class="btn btn-outline-danger w-100" title="Tidak bisa melakukan aksi ini!">
                                    <i class="bi bi-print"></i> Print Resume
                                </a>
                            @else
                                <a href="{{ route('resume.print', base64_encode($pelamar->id_pelamar)) }}"
                                    class="btn btn-outline-primary w-100" target="_blank">
                                    <i class="bi bi-print"></i> Print Resume
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <strong>Nama Paket Soal : </strong> {{ $paket->nama_paket }}
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Tes</th>
                                <th>Jumlah Soal</th>
                                <th>Waktu</th>
                                <th>Show Hasil Tes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paket->paketkategori as $i => $relasi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $relasi->kategori->nama_tes }}</td>
                                    <td>{{ $relasi->kategori->jumlah_soal }}</td>
                                    <td>{{ $relasi->kategori->waktu }} {{ $relasi->kategori->satuan_waktu }}</td>
                                    <td>
                                        <a href="{{ route('hasil-test-peserta-detail.show', [base64_encode($pelamar->id_pelamar), base64_encode($relasi->kategori->id)]) }}"
                                            class="btn btn-info btn-sm detail_data btn-table">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>



    <input type="hidden" name="level" id="level" value="{{ Auth::user()->level }}">
@endsection


@section('script')
    <!-- JS -->
@endsection
