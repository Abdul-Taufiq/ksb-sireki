@extends('partial.main')

@section('style')
    <!-- CSS -->

    <style>
        p {
            margin-bottom: 2px;
        }
    </style>
@endsection

@section('content')
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <strong># Petunjuk Tes</strong> <br>

                            {{-- isi rules --}}
                            {!! $soal->petunjuk_tes !!}

                        </div>
                        <div class="col-md-4">
                            <strong># info Soal Tes</strong>
                            <ol>
                                <li>
                                    Jumlah Soal: <b>{{ $soal->jumlah_soal }} Soal</b>
                                </li>
                                <li>
                                    Waktu Pengerjaan: <b>{{ $soal->waktu }} {{ $soal->satuan_waktu }}</b>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('applicant.cek.kode') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ base64_encode($soal->id) }}">
                        <input type="hidden" name="nama_tes" id="nama_tes" value="{{ $soal->nama_tes }}">

                        <div class="row m-2">
                            {{-- @if ($answer == null) --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_tes">Password Tes</label>
                                    <input type="text" name="password_tes" id="password_tes"
                                        class="form-control input border-info" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-key"></i> &nbsp; Masuk ke Soal Tes
                                </button>
                            </div>
                            {{-- @else
                                <strong>
                                    Jawaban Anda sudah direkam! <br>
                                    Anda tidak dapat mengakses halaman soal dan mengerjakannya kembali. <br>
                                    Hubungi Admin untuk info lebih lanjut.
                                </strong>
                            @endif --}}
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
@endsection


@section('script')
    <!-- JS -->
@endsection
