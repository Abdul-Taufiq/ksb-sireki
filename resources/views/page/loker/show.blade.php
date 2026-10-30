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
                    <th style="width: 20%">Untuk Cabang</th>
                    <td style="width: 1%">:</td>
                    <td>
                        {{ $loker->cabang->cabang }}
                    </td>
                </tr>
                <tr>
                    <th style="width: 20%">Posisi</th>
                    <td style="width: 1%">:</td>
                    <td>
                        {{ $loker->posisi }}
                    </td>
                </tr>
                <tr>
                    <th style="width: 20%">Tanggal Berakhir</th>
                    <td style="width: 1%">:</td>
                    <td>
                        {{ $loker->tgl_berakhir->translatedFormat('d F Y') }}
                    </td>
                </tr>
                <tr>
                    <th style="width: 20%">Status</th>
                    <td style="width: 1%">:</td>
                    <td>
                        @if ($loker->status === 'Active')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Non-Active</span>
                        @endif
                    </td>
                </tr>
            </table>

            <div class="row">
                <div class="col-md-4">
                    <strong>Gambar: </strong>
                    <a href="{{ asset('file_upload/img/' . $loker->gambar) }}" target="blank">
                        {{ $loker->gambar }}
                    </a> <br><br>
                    <img src="{{ asset('file_upload/img/' . $loker->gambar) }}" style="max-width: 80%">
                </div>
                <div class="col-md-8">
                    <strong>Kualifikasi: </strong>
                    {!! $loker->kualifikasi !!}
                </div>
            </div>
        </div>
    </div>


    {{-- Bootstrap 5 Bundle sudah termasuk Popper --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

</body>

</html>
