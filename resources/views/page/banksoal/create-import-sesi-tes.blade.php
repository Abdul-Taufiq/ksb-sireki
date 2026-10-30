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
                            <label class="wajib" for="file_excel">Uploud file</label>
                            <input type="file" name="file_excel" id="file_excel" class="form-control input"
                                accept=".xls, .xlsx">


                            <!-- Tampilan Progress Bar (Awalnya Tersembunyi) -->
                            <div id="progressWrapper" class="progress d-none"
                                style="height: 20px; border-radius: 8px; margin-top: 10px;">
                                <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated"
                                    role="progressbar" style="width: 0%;">0%</div>
                            </div>
                        </div>

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


@section('script')
    <script src="{{ asset('script/confirm-button.js') }}"></script>
    <script src="{{ asset('script/quiz/input-soal.js') }}"></script>

    {{-- progress --}}
    <script>
        document.getElementById('file_excel').addEventListener('change', function() {
            const fileWrapper = document.getElementById('progressWrapper');
            const progressBar = document.getElementById('progressBar');
            const simpan = document.getElementById('simpan');
            const btnSpinner = document.getElementById('btnSpinner');
            const btnText = document.getElementById('btnText');

            if (this.files.length > 0) {
                // 0. ukuran file
                const file = this.files[0];
                const maxSize = 10 * 1024 * 1024; // Konversi 10 MB ke Bytes

                // cek file extensi
                if (
                    !(
                        file.type === "application/vnd.ms-excel" || // XLS (Excel lama)
                        file.type === "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ||
                        // XLSX (Excel baru)
                        file.name.toLowerCase().endsWith(".xls") ||
                        file.name.toLowerCase().endsWith(".xlsx")
                    )
                ) {
                    Swal.fire({
                        title: "Gagal!",
                        text: "Format file tidak didukung! Hanya file Excel (.xls/.xlsx) yang diperbolehkan.",
                        icon: "error",
                    });
                    this.value = ""; // Reset input file
                    return; // Batalkan proses
                }

                // VALIDASI UKURAN FILE
                if (file.size > maxSize) {
                    Swal.fire({
                        title: "Gagal!",
                        text: "UKURAN FILE TERLALU BESAR! MAX 10MB",
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
