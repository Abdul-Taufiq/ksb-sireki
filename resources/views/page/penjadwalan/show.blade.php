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
        <div class="card-body">
            <table class="table table-sm table-responsive table-hover">
                <tr>
                    <th style="width: 20%">Kegiatan</th>
                    <td style="width: 1%">:</td>
                    <td>
                        {{ $jadwal->kegiatan }}
                    </td>
                </tr>
                <tr>
                    <th style="width: 20%">Tanggal Jadwal</th>
                    <td style="width: 1%">:</td>
                    <td>
                        {{ $jadwal->tgl_jadwal->translatedFormat('d F Y, H:i') }} WIB
                    </td>
                </tr>
                <tr>
                    <th style="width: 20%">Keterangan</th>
                    <td style="width: 1%">:</td>
                    <td>
                        {!! $jadwal->keterangan !!}
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pelamar</th>
                        <th>Kontak</th>
                        <th>Posisi Dilamar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal->jadwalpelamar as $i => $relasi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $relasi->pelamar->nama }} <br>
                                {{ $relasi->pelamar->kode_pelamar }}
                            </td>
                            <td>
                                <i class="bi bi-envelope-at"></i>:
                                <a href="mailto:{{ $relasi->pelamar->email }}" target="_blank">
                                    {{ $relasi->pelamar->email }}
                                </a> <br>
                                <i class="bi bi-telephone"></i>:
                                <a href="https://wa.me/'{{ $relasi->pelamar->no_telp }}" target="_blank">
                                    {{ $relasi->pelamar->no_telp }}
                                </a>
                            </td>
                            <td>{!! $relasi->pelamar->posisi !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    {{-- Bootstrap 5 Bundle sudah termasuk Popper --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

</body>

</html>
