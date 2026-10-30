@extends('partial.main')

@section('content')
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header p-2">
                </div>

                {{-- Form --}}
                <form action="{{ $route }}" enctype="multipart/form-data" method="POST" id="quickForm">
                    @csrf
                    @if ($tipe != 'create')
                        @method('patch')
                    @endif

                    <input type="hidden" id="id_kategori_soal" name="id_kategori_soal" value="{{ $id_kategori_soal }}">
                    <input type="hidden" id="nama_tes" name="nama_tes" value="{{ $nama_tes }}">
                    <input type="hidden" id="jns_tes" name="jns_tes" value="{{ $jns_tes }}">

                    {{-- card body --}}
                    <div class="card-body">
                        <div class="form-group mb-4">
                            <label class="wajib" for="pertanyaan">Pertanyaan</label>
                            <textarea required name="pertanyaan" id="pertanyaan">{!! $sesiOne->pertanyaan ?? null !!}</textarea>
                        </div>
                        <div class="form-group mb-4">
                            <label class="wajib" for="kunci_jawaban">Kunci Jawaban</label>
                            <textarea required name="kunci_jawaban" id="kunci_jawaban">{!! $sesiOne->kunci_jawaban ?? '-' !!}</textarea>
                        </div>

                        <div class="row mb-4" id="head_opsi_1">
                            <div class="col-md-12 mb-4 mt-4">
                                <strong>Opsional</strong> <i>(digunakan untuk menambahkan pilihan jawaban, jika
                                    tidak ada diisi tanda '-')</i>
                            </div>
                            @php
                                $opsi = json_decode($sesiOne?->opsi_jawaban ?? '[]', true);
                            @endphp


                            @if (!empty($opsi))
                                @foreach ($opsi as $item)
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="opsi_jawaban_{{ $loop->iteration }}">Opsi Jawaban
                                                {{ $loop->iteration }}</label>
                                            <input type="text" class="form-control form-control-sm input"
                                                id="opsi_jawaban_{{ $loop->iteration }}"
                                                name="opsi_jawaban_{{ $loop->iteration }}" value="{{ $item }}">
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @for ($i = 1; $i <= 5; $i++)
                                    <div class="col-md-4 mb-4">
                                        <div class="form-group">
                                            <label for="opsi_jawaban_{{ $i }}">Opsi Jawaban
                                                {{ $i }}</label>
                                            <input type="text" class="form-control form-control-sm input"
                                                id="opsi_jawaban_{{ $i }}"
                                                name="opsi_jawaban_{{ $i }}" value="-">
                                        </div>
                                    </div>
                                @endfor
                            @endif

                        </div>

                        {{-- tambahan --}}
                        {{-- <br>
                        <div id="tambah_opsi" class="row mb-2"></div>

                        <div class="row">
                            <div>
                                <div class="text-center"">
                                    <button class="btn btn-outline-warning w-100" id="kurangi_data" type="button"
                                        onclick="kurangiOpsi()">
                                        <i class="fa-solid fa-circle-minus"></i> Kurangi Data Opsi Jawaban <i
                                            class="fa-solid fa-circle-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-outline-primary w-100" id="tambah_data" type="button"
                                    onclick="tambahOpsi()">
                                    <i class="fa-solid fa-circle-plus"></i> Tambah Data Opsi Jawaban <i
                                        class="fa-solid fa-circle-plus"></i>
                                </button>
                            </div>
                        </div> --}}


                        <br>
                    </div>
                    {{-- end card body --}}

                    {{-- card-footer --}}
                    <div class="card-footer text-end">
                        <a href="{{ url()->previous() }}" type="button" class="btn btn-secondary">Kembali</a>
                        <button id="simpan" type="button" class="btn btn-primary" style="letter-spacing: 2px;">
                            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status"
                                aria-hidden="true"></span>
                            <i class="bi bi-floppy2"></i><span id="btnText"><b> SIMPAN</b></span>
                        </button>
                    </div>
                    {{-- end card-footer --}}
                </form>
                {{-- end Form --}}
            </div>
            <div class="card card-outline card-danger mb-0"></div>
        </div>
        <!--end::Container-->
    </div>
@endsection


<script src="{{ asset('script/quiz/input-config.js') }}"></script>
@section('script')
    <script src="{{ asset('script/confirm-button.js') }}"></script>
    <script src="{{ asset('script/quiz/input-soal.js') }}"></script>
@endsection
