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
                    action="{{ $tipe == 'create' ? route('kategori-soal.store') : route('kategori-soal.update', base64_encode($kategori->id)) }}"
                    enctype="multipart/form-data" method="POST" id="quickForm">
                    @csrf
                    @if ($tipe != 'create')
                        @method('patch')
                    @endif


                    {{-- card body --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="password_tes">Password Tes
                                        <span style="font-weight: normal; font-style: italic">digunakan peserta untuk
                                            membuka soal (Minimal 6 karakter)</span>
                                    </label>
                                    <input type="text" name="password_tes" id="password_tes" class="form-control input"
                                        required value="{{ $kategori->password_tes ?? '' }}" minlength="6">
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="nama_tes">Nama Tes</label>
                                    <input type="text" name="nama_tes" id="nama_tes" class="form-control input" required
                                        value="{{ $kategori->nama_tes ?? '' }}" list="nama_tes_datalist">
                                    <datalist id="nama_tes_datalist">
                                        <option value="Sesi One">Sesi One</option>
                                        <option value="Pengetahuan Perbankang">Pengetahuan Perbankang</option>
                                        <option value="Analogi Verbal">Analogi Verbal</option>
                                        <option value="Hitung Cepat">Hitung Cepat</option>
                                        <option value="Tes Integritas">Tes Integritas</option>
                                        <option value="Tes Informasi Singkat">Tes Informasi Singkat</option>
                                        <option value="Tes Penalaran Analitik">Tes Penalaran Analitik</option>
                                        <option value="Tes Kemampuan Verbal">Tes Kemampuan Verbal</option>
                                        <option value="Tes Ketelitian">Tes Ketelitian</option>
                                        <option value="Tes Kemampuan Kuantitatif">Tes Kemampuan Kuantitatif</option>
                                        <option value="Tes Jabatan Analis Kredit">Tes Jabatan Analis Kredit</option>
                                        <option value="Tes Jabatan Audit Internal">Tes Jabatan Audit Internal</option>
                                        <option value="Tes Jabatan Marketing">Tes Jabatan Marketing</option>
                                        <option value="Tes Bidang Perkreditan">Tes Bidang Perkreditan</option>
                                        <option value="Tes Jabatan Bidang Legal">Tes Jabatan Bidang Legal</option>
                                        <option value="Tes Jabatan Remedial">Tes Jabatan Remedial</option>
                                        <option value="Analisa Diri (SWOT)">Analisa Diri (SWOT)</option>
                                        <option value="DISC">DISC</option>
                                        <option value="MBTI">MBTI</option>
                                        <option value="Kraepelin Rekrtut">Kraepelin Rekrtut</option>
                                        <option value="Kraepelin Assesment">Kraepelin Assesment</option>
                                    </datalist>

                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="jumlah_soal">Jumlah Soal</label>
                                    <input type="number" name="jumlah_soal" id="jumlah_soal" class="form-control input"
                                        required value="{{ $kategori->jumlah_soal ?? '' }}" min="0">
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label class="wajib" for="waktu">Waktu</label>

                                    <div class="input-group mb-4">
                                        <input type="number" class="form-control input" id="waktu" name="waktu"
                                            value="{{ $kategori->waktu ?? '' }}" required min="0"
                                            style="width: 60%;">

                                        <select name="satuan_waktu" id="satuan_waktu" required
                                            class="form-select form-select-sm is-valid">
                                            <option {{ $kategori?->satuan_waktu == 'Menit' ? 'selected' : '' }}
                                                value="Menit">
                                                Menit</option>
                                            <option {{ $kategori?->satuan_waktu == 'Detik' ? 'selected' : '' }}
                                                value="Detik">
                                                Detik</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-4 mb-4">
                                <div class="form-group">
                                    <label for="istimewa_start" class="wajib">Istimewa</label>

                                    <div class="input-group mb-4">
                                        <input type="number" name="istimewa_start" id="istimewa_start"
                                            class="form-control input" required
                                            value="{{ $kategori->istimewa_start ?? '' }}" min="0"
                                            placeholder="Start">
                                        <input type="number" name="istimewa_end" id="istimewa_end"
                                            class="form-control input" required value="{{ $kategori->istimewa_end ?? '' }}"
                                            min="0" placeholder="End">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="form-group">
                                    <label for="baik_start" class="wajib">Baik</label>

                                    <div class="input-group mb-4">
                                        <input type="number" name="baik_start" id="baik_start"
                                            class="form-control input" required value="{{ $kategori->baik_start ?? '' }}"
                                            min="0" placeholder="Start">
                                        <input type="number" name="baik_end" id="baik_end" class="form-control input"
                                            required value="{{ $kategori->baik_end ?? '' }}" min="0"
                                            placeholder="End">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="form-group">
                                    <label for="cukup_start" class="wajib">Cukup</label>

                                    <div class="input-group mb-4">
                                        <input type="number" name="cukup_start" id="cukup_start"
                                            class="form-control input" required
                                            value="{{ $kategori->cukup_start ?? '' }}" min="0"
                                            placeholder="Start">
                                        <input type="number" name="cukup_end" id="cukup_end" class="form-control input"
                                            required value="{{ $kategori->cukup_end ?? '' }}" min="0"
                                            placeholder="End">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="form-group">
                                    <label for="kurang_start" class="wajib">Kurang</label>

                                    <div class="input-group mb-4">
                                        <input type="number" name="kurang_start" id="kurang_start"
                                            class="form-control input" required
                                            value="{{ $kategori->kurang_start ?? '' }}" min="0"
                                            placeholder="Start">
                                        <input type="number" name="kurang_end" id="kurang_end"
                                            class="form-control input" required value="{{ $kategori->kurang_end ?? '' }}"
                                            min="0" placeholder="End">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="form-group">
                                    <label for="buruk_start" class="wajib">Buruk</label>

                                    <div class="input-group mb-4">
                                        <input type="number" name="buruk_start" id="buruk_start"
                                            class="form-control input" required
                                            value="{{ $kategori->buruk_start ?? '' }}" min="0"
                                            placeholder="Start">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <label for="petunjuk_tes">Petunjuk Tes</label>
                                    <textarea name="petunjuk_tes" id="petunjuk_tes" cols="30" rows="10">{!! $kategori->petunjuk_tes ?? '' !!}</textarea>
                                </div>
                            </div>


                        </div>

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


@section('script')
    <script src="{{ asset('script/confirm-button.js') }}"></script>


    <script>
        $(function() {
            $("input").attr("autocomplete", "off");
            // Default semua form diberi border merah
            $(".input").addClass("is-invalid");

            initializeSummernote("#petunjuk_tes", "ketikan sesuatu...", 200);

            // Event listener untuk semua elemen dengan class .input
            $(document).on("input change", ".input", function() {
                var value = $(this).val();

                if (value && value.toString().trim() !== "") {
                    $(this).addClass("is-valid").removeClass("is-invalid");
                } else {
                    $(this).addClass("is-invalid").removeClass("is-valid");
                }

                // Khusus untuk password_tes
                if ($(this).attr("id") === "password_tes") {
                    if (value.length < 6) {
                        $(this).addClass("is-invalid").removeClass("is-valid");
                        $("#simpan").prop("disabled", true);
                    } else {
                        $(this).addClass("is-valid").removeClass("is-invalid");
                        $("#simpan").prop("disabled", false);
                    }
                }
            });

            // Cek kondisi awal (misalnya form edit sudah ada value)
            $(".input").each(function() {
                var value = $(this).val();
                if (value && value.toString().trim() !== "") {
                    $(this).addClass("is-valid").removeClass("is-invalid");
                }
            });

            // Cek kondisi awal khusus password_tes
            var passVal = $("#password_tes").val();
            if (passVal && passVal.length >= 6) {
                $("#password_tes").addClass("is-valid").removeClass("is-invalid");
                $("#simpan").prop("disabled", false);
            } else {
                $("#password_tes").addClass("is-invalid").removeClass("is-valid");
                $("#simpan").prop("disabled", true);
            }
        });
    </script>
@endsection
