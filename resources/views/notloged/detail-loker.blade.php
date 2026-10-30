<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        .konten {
            margin: 0px 5px 0px 5px;
            width: 98%;
        }
    </style>
</head>

<body>
    <div class="konten">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('file_upload/img/' . $loker->gambar) }}" alt="{{ $loker->gambar }}"
                    class="img-fluid">
            </div>
            <div class="col-md-8">
                <table class="table table-striped w-100 small">
                    <tr>
                        <th style="width: 18%">Posisi</th>
                        <td style="width: 1px">:</td>
                        <td>
                            {{ $loker->posisi }}
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 18%">Kantor Cabang</th>
                        <td style="width: 1px">:</td>
                        <td>
                            {{ $loker->cabang?->cabang ?? 'ALL CABANG' }}
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 18%">Kualifikasi</th>
                        <td style="width: 1px">:</td>
                        <td class="">
                            {!! $loker->kualifikasi !!}
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
