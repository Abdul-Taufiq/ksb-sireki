<!DOCTYPE html>
<html lang="en">

@include('partial.header')

<style>
    body {
        font-size: 14px;
    }
</style>

<body>

    <div class="card">
        <div class="card-header bg-info text-white">
            <strong>Data Applicant</strong>
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
                                <a href="{{ asset('file_upload/pdf/' . $pelamar->berkas_pendukung) }}" target="blank">
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

    <br>
    <div class="card">
        <div class="card-header bg-info text-white">
            <strong>Tracking</strong>
        </div>
        <div class="card-body">
            <table class="table table-sm table-responsive table-striped">
                <tr>
                    <th style="width: 10%">#</th>
                    <th style="width: 1%"></th>
                    <th style="width: 25%">Nama</th>
                    <th style="width: 20%">Jabatan</th>
                    <th>Status</th>
                    <th style="width: 20%">Tanggal Status</th>
                </tr>
                <tr>
                    <th>Creator</th>
                    <td>:</td>
                    <td>
                        {{ $pelamar->nama }}
                    </td>
                    <td>-</td>
                    <td>Sended</td>
                    <td>
                        {{ $pelamar->created_at->format('d-m-Y | H:i') }} WIB
                    </td>
                </tr>
                @if ($pelamar->tracking->isNotEmpty())
                    @foreach ($pelamar->tracking as $items)
                        <tr>
                            <td>Admin</td>
                            <td>:</td>
                            <td>{{ $items->nama }}</td>
                            <td>{{ $items->jabatan }}</td>
                            <td>{{ $items->status }}</td>
                            <td>{{ $items->tgl_status->format('d-m-Y | H:i') }} WIB</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>

    <br>
    <div class="card">
        <div class="card-header bg-warning">
            <strong>Generate Kode Pelamar</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('applicant.update', base64_encode($pelamar->id_pelamar)) }}" method="POST"
                id="quickForm">
                @csrf
                @method('patch')

                <input type="hidden" name="nama" id="nama" value="{{ $pelamar->nama }}">

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="kode_pelamar">Kode Pelamar</label>
                            <input type="text" name="kode_pelamar" id="kode_pelamar"
                                class="form-control form-control-sm input border-info" required
                                value="{{ $pelamar->kode_pelamar ?? null }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-sm btn-secondary"
                            style="margin-top: 20px; margin-right: 5px;" onclick="GenerateKode()"
                            {{ $pelamar->kode_pelamar != null ? 'disabled' : '' }}>
                            <i class="bi bi-gear-wide-connected"></i> Generate
                        </button>
                        <button id="simpan" type="submit" class="btn btn-primary btn-sm"
                            style="letter-spacing: 2px; margin-top: 20px;" disabled>
                            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status"
                                aria-hidden="true"></span>
                            <i class="bi bi-floppy2"></i><span id="btnText"><b> SIMPAN</b></span>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>


    {{-- Bootstrap 5 Bundle sudah termasuk Popper --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <script>
        function GenerateKode() {
            let nama = document.getElementById('nama').value;
            let kode = document.getElementById('kode_pelamar');
            let btnSave = document.getElementById('simpan');

            btnSave.disabled = false;

            // ambil kata pertama (dipisah spasi)
            let firstWord = nama.trim().split(" ")[0];

            // fungsi bikin random string 6 karakter
            function randomString(length) {
                const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                let result = "";
                for (let i = 0; i < length; i++) {
                    result += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                return result;
            }

            // gabungkan kata pertama + random string
            let finalResult = firstWord + "-" + randomString(6);
            kode.value = finalResult;
        }

        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById('quickForm');
            const simpan = document.getElementById('simpan');
            const btnSpinner = document.getElementById('btnSpinner');
            const btnText = document.getElementById('btnText');
            let kode = document.getElementById('kode_pelamar');
            let kodval = kode.value;

            form.addEventListener('submit', function() {
                // disable tombol
                simpan.disabled = true;

                // tampilkan spinner
                btnSpinner.classList.remove('d-none');

                // ubah teks tombol
                btnText.textContent = ' Menyimpan data...';
            });

        });
    </script>

</body>

</html>
