<!DOCTYPE html>
<html lang="en">

@include('partial.header')

<style>
    body {
        font-size: 14px;
    }

    p {
        margin-bottom: 2px;
    }
</style>

<body>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-sm table-responsive table-striped">
                        <tr>
                            <th style="width: 20%">Nama Tes</th>
                            <td style="width: 1%">:</td>
                            <td>
                                {{ $data->nama_tes }}
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 20%">Jenis Tes</th>
                            <td style="width: 1%">:</td>
                            <td>
                                {{ $data->jns_tes }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-responsive table-striped">
                        <tr>
                            <th style="width: 20%">Disimpan Pada</th>
                            <td style="width: 1%">:</td>
                            <td>
                                {{ $data->created_at->translatedFormat('d F Y | H:i') }}WIB
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 20%">Last Update</th>
                            <td style="width: 1%">:</td>
                            <td>
                                {{ $data->updated_at->translatedFormat('d F Y | H:i') }}WIB
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-sm table-responsive table-striped">
                        <tr>
                            <th style="width: 20%">Pertanyaan</th>
                            <td style="width: 1%">:</td>
                            <td>
                                {!! $data->pertanyaan !!}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-responsive table-striped">
                        <tr>
                            <th style="width: 20%">Opsi Jawaban</th>
                            <td style="width: 1%">:</td>
                            <td>
                                @if ($data->opsi_jawaban && $data->opsi_jawaban != '-')
                                    @php
                                        $array = json_decode($data->opsi_jawaban, true);
                                    @endphp
                                    @if (is_array($array) && !empty($array))
                                        <ul>
                                            @foreach ($array as $item)
                                                @if ($item != '-')
                                                    <li>{{ $item }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @else
                                        <i>Tidak ada opsi jawaban</i>
                                    @endif
                                @else
                                    <i>Tidak ada opsi jawaban</i>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 20%">Kunci Jawaban</th>
                            <td style="width: 1%">:</td>
                            <td>
                                {!! $data->kunci_jawaban ?? '<i>Tidak ada jawaban</i>' !!}
                            </td>
                        </tr>
                    </table>
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
