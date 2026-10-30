@extends('partial.main')

@section('style')
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header p-2">
                    Resume Hasil Tes <strong>{{ $pelamar->nama }}</strong>
                </div>

                {{-- Form --}}
                <form action="{{ route('resume.store') }}" enctype="multipart/form-data" method="POST" id="quickForm">
                    @csrf

                    <input type="hidden" name="id_pelamar" id="id_pelamar"
                        value="{{ base64_encode($pelamar->id_pelamar) ?? null }}">
                    <input type="hidden" name="id_resume" id="id_resume" value="{{ base64_encode($resume?->id) ?? null }}">

                    {{-- card body --}}
                    <div class="card-body">
                        <div class="row">
                            <strong>Penilaian</strong>
                            <div class="col-md-12 mb-4">
                                <table class="table table-sm table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Test</th>
                                            <th>Skor</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($resume?->penilaian_tes != null && $resume?->penilaian_tes != '[]')
                                            @php
                                                $penilaian = json_decode($resume->penilaian_tes);
                                            @endphp

                                            @foreach ($penilaian as $item)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="tes_{{ $loop->iteration }}"
                                                            id="tes_{{ $loop->iteration }}"
                                                            class="form-control form-control-sm input" required
                                                            value="{{ $item->tes }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="skor_{{ $loop->iteration }}"
                                                            id="skor_{{ $loop->iteration }}"
                                                            class="form-control form-control-sm input" required
                                                            value="{{ $item->skor }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="keterangan_{{ $loop->iteration }}"
                                                            id="keterangan_{{ $loop->iteration }}"
                                                            class="form-control form-control-sm input" required
                                                            value="{{ $item->keterangan }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            @for ($i = 1; $i <= 5; $i++)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="tes_{{ $i }}"
                                                            id="tes_{{ $i }}"
                                                            class="form-control form-control-sm input" required
                                                            value="-">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="skor_{{ $i }}"
                                                            id="skor_{{ $i }}"
                                                            class="form-control form-control-sm input" required
                                                            value="-">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="keterangan_{{ $i }}"
                                                            id="keterangan_{{ $i }}"
                                                            class="form-control form-control-sm input" required
                                                            value="-">
                                                    </td>
                                                </tr>
                                            @endfor
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <strong class="mt-2">Analisa Strong/Week Point</strong>
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="analisa_kelebihan">Analisa Kelebihan</label>
                                    <textarea name="analisa_kelebihan" id="analisa_kelebihan" class="summernote" cols="30" rows="10" required>{!! $resume->analisa_kelebihan ?? '' !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="analisa_kekurangan">Analisa Kekurangan</label>
                                    <textarea name="analisa_kekurangan" id="analisa_kekurangan" class="summernote" cols="30" rows="10" required>{!! $resume->analisa_kekurangan ?? '' !!}</textarea>
                                </div>
                            </div>

                            <strong class="mt-2">Catatan Cek Lingk/Reputasi/Kondite</strong>
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="catatan_slik">Catatan SLIK</label>
                                    <textarea name="catatan_slik" id="catatan_slik" class="summernote" cols="30" rows="10" required>{!! $resume->catatan_slik ?? '' !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="kondite_tempat_kerja">Kondite ditempat kerja sebelumnya</label>
                                    <textarea name="kondite_tempat_kerja" id="kondite_tempat_kerja" class="summernote" cols="30" rows="10"
                                        required>{!! $resume->kondite_tempat_kerja ?? '' !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="catatan_lainnya">Catatan Lainnya</label>
                                    <textarea name="catatan_lainnya" id="catatan_lainnya" class="summernote" cols="30" rows="10" required>{!! $resume->catatan_lainnya ?? '' !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="rekomendasi_sdm">Rekomendasi Bidang SDM</label>
                                    <select name="rekomendasi_sdm" id="rekomendasi_sdm"
                                        class="form-select form-select-sm input" required>
                                        <option selected disabled>-pilih-</option>
                                        <option
                                            {{ $resume?->rekomendasi_sdm == 'Dipertimbangkan/Disarankan' ? 'selected' : '' }}
                                            value="Dipertimbangkan/Disarankan">Dipertimbangkan/Disarankan</option>
                                        <option
                                            {{ $resume?->rekomendasi_sdm == 'Tidak Dipertimbangkan/Disarankan' ? 'selected' : '' }}
                                            value="Tidak Dipertimbangkan/Disarankan">Tidak Dipertimbangkan/Disarankan
                                        </option>
                                        <option {{ $resume?->rekomendasi_sdm == 'Dipertimbangkan lain' ? 'selected' : '' }}
                                            value="Dipertimbangkan lain">Dipertimbangkan lain</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- end card body --}}

                    {{-- card-footer --}}
                    <div class="card-footer text-end">
                        <a href="{{ route('hasil-test-peserta.index') }}" type="button"
                            class="btn btn-secondary">Kembali</a>
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


@section('script')
    <script src="{{ asset('script/confirm-button.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>


    <script>
        $(document).ready(function() {

        });

        $(function() {
            $("input").attr("autocomplete", "off");
            // Default semua form diberi border merah
            $(".input").addClass("is-invalid");

            initializeSummernote(".summernote", "ketikan sesuatu...", 200);

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
