@extends('notloged.main-log')
@section('content')
    <style>
        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.357);
            width: 100%;
            position: relative;
            overflow: hidden;
            text-align: left;
        }
    </style>


    <h2>Detail Lamaran</h2>
    <p>
        Berikut adalah detail lamaran yang telah Anda kirim ke PT BPR KUSUMA SUMBING.
    </p>
    <strong>Kode Lamaran Anda:</strong> "<strong class="text-primary">{{ $pelamar->kode_pelamar }}</strong>"
    <small><i>(digunakan untuk melacak status lamaran!)</i></small>
    <hr>

    <div class="card">
        <div class="card-body">
            <table class="table table-sm table-responsive ">
                <tr>
                    <th style="width: 30%">Nama Lengkap</th>
                    <td style="width: 1%">:</td>
                    <td>{{ $pelamar->nama }}</td>
                </tr>
                <tr>
                    <th>Tempat, Tanggal Lahir</th>
                    <td>:</td>
                    <td>{{ $pelamar->tempat_lahir }}, {{ $pelamar->tgl_lahir->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>:</td>
                    <td>{{ $pelamar->jns_kelamin }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>:</td>
                    <td>{{ $pelamar->alamat }}</td>
                </tr>
                <tr>
                    <th>Alamat Domisili</th>
                    <td>:</td>
                    <td>{{ $pelamar->domisili }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>:</td>
                    <td>{{ $pelamar->email }}</td>
                </tr>
                <tr>
                    <th>No. Telepon/WA</th>
                    <td>:</td>
                    <td>{{ $pelamar->no_telp }}</td>
                </tr>
                <tr>
                    <th>Pendidikan (Jurusan)</th>
                    <td>:</td>
                    <td>{{ $pelamar->pendidikan }} ({{ $pelamar->jurusan }})</td>
                </tr>
                <tr>
                    <th>Berkas Pendukung</th>
                    <td>:</td>
                    <td>
                        <a href="{{ asset('file_upload/pdf/' . $pelamar->berkas_pendukung) }}" target="_blank">
                            {{ $pelamar->berkas_pendukung }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Posisi yang dilamar</th>
                    <td>:</td>
                    <td>{{ $pelamar->posisi }}</td>
                </tr>
                <tr>
                    <th>Kantor Cabang yang dituju</th>
                    <td>:</td>
                    <td>{{ $pelamar->cabang?->cabang ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Status Lamaran</th>
                    <td>:</td>
                    <td>
                        @switch($pelamar->status)
                            @case('Tidak Sesuai Kualifikasi')
                            @case('Tidak Lolos Seleksi')
                                <span class="badge bg-danger">Tidak Lolos Seleksi!</span>
                            @break

                            @case('Offering/Finalisasi')
                                <span class="badge bg-success">Disetujui! - penjadwalan untuk Offering dan Finalisasi</span>
                            @break

                            @default
                                @if ($pelamar->status == 'Arsip u/ DB Calon Karyawan')
                                    <span class="badge bg-info">Proses! - Interview </span>
                                @else
                                    <span class="badge bg-info">Proses! - {{ $pelamar->status }} </span>
                                @endif
                            @break
                        @endswitch
                    </td>
                </tr>

            </table>
        </div>
    </div>
@endsection

@section('script')
    @if (session('AlertSuccess'))
        <script>
            Swal.fire({
                title: 'Sukses!',
                text: '{{ session('AlertSuccess') }}',
                theme: document.body.classList.contains('darkmode') ? "dark" : "light",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endsection
