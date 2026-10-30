@extends('partial.main')

@section('content')
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header p-2">
                </div>

                {{-- Form --}}
                <form
                    action="{{ $tipe == 'create' ? route('kraepelin.store') : route('kraepelin.update', base64_encode($krae->id)) }}"
                    enctype="multipart/form-data" method="POST" id="quickForm">
                    @csrf
                    @if ($tipe != 'create')
                        @method('patch')
                    @endif

                    {{-- card body --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="form-group">
                                    <label for="id_kategori_soal">Kategori Kraepelin</label>
                                    <select name="id_kategori_soal" id="id_kategori_soal"
                                        class="form-select form-select-sm input" required>
                                        <option {{ $krae?->id_kategori_soal == '3' ? 'selected' : '' }} value="3">
                                            Kraepelin Rekrut</option>
                                        <option {{ $krae?->id_kategori_soal == '21' ? 'selected' : '' }} value="21">
                                            Kraepelin Assesment</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="form-group">
                                    <label for="nilai_1">Nilai 1</label>
                                    <input type="number" name="nilai_1" id="nilai_1"
                                        class="form-control form-control-sm input" required
                                        value="{{ $krae->nilai_1 ?? '' }}" min="0" max="9" maxlength="1">
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="form-group">
                                    <label for="nilai_2">Nilai 2</label>
                                    <input type="number" name="nilai_2" id="nilai_2"
                                        class="form-control form-control-sm input" required
                                        value="{{ $krae->nilai_2 ?? '' }}" min="0" max="9" maxlength="1">
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="form-group">
                                    <label for="kunci_jawaban">Kunci Jawaban</label>
                                    <input type="number" name="kunci_jawaban" id="kunci_jawaban"
                                        class="form-control form-control-sm input" required
                                        value="{{ $krae->kunci_jawaban ?? '' }}" max="20">
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- end card body --}}

                    {{-- card-footer --}}
                    <div class="card-footer text-end">
                        <a href="{{ route('loker.index') }}" type="button" class="btn btn-secondary">Kembali</a>
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

    <script>
        document.getElementById("kunci_jawaban").addEventListener("input", function() {
            if (this.value > 20) {
                this.value = 20; // otomatis set ke 20
            }
        });
        document.getElementById("nilai_1").addEventListener("input", function() {
            if (this.value > 9) {
                this.value = 9; // otomatis set ke 20
            }
        });
        document.getElementById("nilai_2").addEventListener("input", function() {
            if (this.value > 9) {
                this.value = 9; // otomatis set ke 20
            }
        });
    </script>

    <script>
        $(function() {
            $("input").attr("autocomplete", "off");
            // Default semua form diberi border merah
            $(".input").addClass("is-invalid");

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
