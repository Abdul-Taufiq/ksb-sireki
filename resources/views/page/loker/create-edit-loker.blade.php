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
                    action="{{ $tipe == 'create' ? route('loker.store') : route('loker.update', base64_encode($loker->id_loker)) }}"
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
                                    <label for="kategori">Kategori Loker</label>
                                    <select name="kategori" id="kategori" class="form-select is-valid form-select-sm"
                                        required>
                                        <option {{ $loker?->kategori == 'Dibawah Kasi' ? 'selected' : '' }}
                                            value="Dibawah Kasi">Dibawah Kasi</option>
                                        <option {{ $loker?->kategori == 'Diatas Kasi' ? 'selected' : '' }}
                                            value="Diatas Kasi">Diatas Kasi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                @php
                                    $user = Auth::user();
                                @endphp
                                <div class="form-group">
                                    <label for="id_cabang">Untuk Cabang</label>
                                    @if ($user->id_cabang == 0 || $user->id_cabang == 20)
                                        <select name="id_cabang" id="id_cabang" class="form-select is-valid form-select-sm"
                                            required>
                                            @foreach ($cabang as $items)
                                                <option {{ $loker?->id_cabang == $items->id_cabang ? 'selected' : '' }}
                                                    value="{{ $items->id_cabang }}">{{ $items->cabang }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input type="hidden" name="id_cabang" id="id_cabang" value="{{ $user->id_cabang }}"
                                            class="form-control form-control-sm is-valid" required readonly>
                                        <input type="text" name="cbg" id="cbg"
                                            value="{{ $user->cabang->cabang }}"
                                            class="form-control form-control-sm is-valid" required readonly>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="posisi">Posisi</label>
                                    <input type="text" name="posisi" id="posisi"
                                        class="form-control form-control-sm input" required
                                        value="{{ $loker->posisi ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="tgl_berakhir">Tanggal Berakhir</label>
                                    <input type="date" name="tgl_berakhir" id="tgl_berakhir"
                                        class="form-control form-control-sm input" required
                                        value="{{ $loker?->tgl_berakhir?->format('Y-m-d') ?? '' }}">
                                </div>
                            </div>
                            <div
                                class="col-md-6 mb-4
                                {{ $user->id_cabang == 0 || $user->id_cabang == 20 ? '' : 'd-none' }}">
                                <div class="form-group">
                                    <label class="wajib" for="status">Status</label>
                                    <select name="status" id="status" class="form-select is-valid form-select-sm">
                                        <option value="Active" selected>Active</option>
                                        <option value="Non-active">Non-active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label class="wajib" for="gambar">Gambar</label> <span><i>(max 2MB)</i></span>

                                    <div class="d-flex {{ $tipe != 'edit' ? 'd-none' : '' }}">
                                        <input type="checkbox" class="form-check" id="cek_gambar" name="cek_gambar"
                                            value="edit" style="margin-right: 10px;" onclick="cekGambar()">
                                        <label for="cek_gambar" style="margin-top: 3px;">Ceklish ini jika tidak mengubah
                                            gambar </label>
                                        <a href="{{ asset('file_upload/img/' . $loker?->gambar) }}"
                                            style="margin-left: 5px;" target="blank">
                                            {{ $loker->gambar ?? '' }}
                                        </a>
                                    </div>

                                    <input type="file" name="gambar" id="gambar"
                                        class="form-control form-control-sm input" required
                                        value="{{ $loker->gambar ?? '' }}" accept="image/png, image/jpg, image/jpeg">

                                    <!-- Tampilan Progress Bar (Awalnya Tersembunyi) -->
                                    <div id="progressWrapper" class="progress d-none"
                                        style="height: 20px; border-radius: 8px; margin-top: 10px;">
                                        <div id="progressBar"
                                            class="progress-bar progress-bar-striped progress-bar-animated"
                                            role="progressbar" style="width: 0%;">0%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <label class="wajib" for="kualifikasi">Kualifikasi</label>
                                    <textarea required name="kualifikasi" id="kualifikasi">{!! $loker->kualifikasi ?? null !!}</textarea>
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
        $(document).ready(function() {
            initializeSummernote("#kualifikasi", "Keterangan...", 200);
        });

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

            for (let i = 1; i <= 20; i++) {
                if (document.getElementById(`nama_${i}`)) {
                    autoFill(i);
                    updateAdminSurvey(i);
                }
            }
        })


        function cekGambar() {
            const cek_gambar = document.getElementById('cek_gambar');
            const gambar = document.getElementById('gambar');

            if (cek_gambar.checked) {
                gambar.removeAttribute('required');
                $(gambar).addClass('is-valid').removeClass('is-invalid');
            } else {
                gambar.setAttribute('required', true);
                $(gambar).addClass('is-invalid').removeClass('is-valid');
            }
        }
    </script>

    {{-- progress --}}
    <script>
        document.getElementById('gambar').addEventListener('change', function() {
            const fileWrapper = document.getElementById('progressWrapper');
            const progressBar = document.getElementById('progressBar');
            const simpan = document.getElementById('simpan');
            const btnSpinner = document.getElementById('btnSpinner');
            const btnText = document.getElementById('btnText');

            if (this.files.length > 0) {
                // 0. ukuran file
                const file = this.files[0];
                const maxSize = 2 * 1024 * 1024; // Konversi 10 MB ke Bytes

                // cek file extensi
                if (
                    !(
                        file.type === "image/png" ||
                        file.type === "image/jpeg" ||
                        file.name.toLowerCase().endsWith(".png") ||
                        file.name.toLowerCase().endsWith(".jpg") ||
                        file.name.toLowerCase().endsWith(".jpeg")
                    )
                ) {
                    Swal.fire({
                        title: "Gagal!",
                        text: "Format file tidak didukung! Hanya file GAMBAR yang diperbolehkan.",
                        icon: "error",
                    });
                    this.value = ''; // Reset input file
                    return; // Batalkan proses
                }

                // VALIDASI UKURAN FILE
                if (file.size > maxSize) {
                    Swal.fire({
                        title: "Gagal!",
                        text: "UKURAN FILE TERLALU BESAR! MAX 2MB",
                        icon: "error",
                    });
                    this.value = ''; // Kosongkan kembali input file agar tidak bisa diupload
                    fileWrapper.classList.add('d-none'); // Sembunyikan progress bar jika sempat muncul
                    return; // Stop eksekusi kode di bawahnya (tidak jalan ke loading/simulasi)
                }

                // 1. Kunci tombol submit dan munculkan loading spinner
                simpan.disabled = true;
                btnSpinner.classList.remove('d-none');
                btnText.textContent = ' Memproses file...';

                // 2. Munculkan progress bar
                fileWrapper.classList.remove('d-none');

                // Reset status progress bar ke awal jika sebelumnya sudah pernah pilih file
                progressBar.style.width = '0%';
                progressBar.textContent = '0%';
                progressBar.classList.add('progress-bar-striped', 'progress-bar-animated');
                progressBar.classList.remove('bg-success');

                // 3. Jalankan simulasi progress naik
                let percent = 0;
                const interval = setInterval(() => {
                    percent += 5;

                    progressBar.style.width = percent + '%';
                    progressBar.textContent = percent + '%';

                    if (percent >= 100) {
                        clearInterval(interval);

                        // 4. Setelah 100%, matikan animasi bar dan ubah warna jadi hijau
                        progressBar.classList.remove('progress-bar-striped', 'progress-bar-animated');
                        progressBar.classList.add('bg-success');
                        progressBar.textContent = 'Selesai!';

                        // 5. Buka kembali kuncian tombol submit dan hilangkan loading spinner
                        simpan.disabled = false;
                        btnSpinner.classList.add('d-none');
                        btnText.textContent = 'SIMPAN';
                    }
                }, 100);
            }
        });
    </script>
@endsection
