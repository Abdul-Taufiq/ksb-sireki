@extends('notloged.main-log')
@section('content')
    <style>
        label {
            font-weight: bold;
            font-size: 13px;
        }

        label:has(+ input[required])::after {
            content: "  *";
            color: red;
            font-style: italic;
        }

        label:has(+ select[required])::after {
            content: "  *";
            color: red;
            font-style: italic;
        }

        label:has(+ textarea[required])::after {
            content: " *";
            color: red;
        }

        .wajib::after {
            content: " *";
            color: red;
        }

        input {
            border-radius: 8px !important;
        }

        textarea {
            border-radius: 8px !important;
        }

        select {
            border-radius: 8px !important;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.357);
            width: 100%;
            position: relative;
            overflow: hidden;
            text-align: left;
        }
    </style>


    <h2>Apply Lowongan Pekerjaan</h2>
    <p>
        Anda Akan Melakukan Apply Lowongan Pekerjaan <strong>{{ $loker->posisi }}</strong> di PT BPR KUSUMA SUMBING,
        Silahkan isi form dibawah ini dengan data yang valid dan benar. Terima kasih.
    </p>
    <hr>

    <div class="card">
        <form action="{{ route('pelamar-store') }}" method="POST" enctype="multipart/form-data" id="quickForm">
            @csrf
            <div class="card-body">
                <input type="hidden" name="id_loker" value="{{ encrypt($loker->id_loker) }}">
                <div class="row" style="margin-left: 5px">
                    <div class="col-md-4 mb-4">
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-sm is-invalid input" required
                                id="nama_lengkap" name="nama_lengkap">
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control form-control-sm is-invalid input" required
                                id="tempat_lahir" name="tempat_lahir">
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control form-control-sm is-invalid input" required
                                id="tgl_lahir" name="tgl_lahir">
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="form-group">
                            <label for="alamat">Alamat <small><i>(Sesuai KTP)</i></small></label>
                            <textarea class="form-control form-control-sm is-invalid input" required id="alamat" name="alamat"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="form-group">
                            <label for="alamat_domisili">Alamat <small><i>(Domisili)</i></small></label>
                            <textarea class="form-control form-control-sm is-invalid input" required id="alamat_domisili" name="alamat_domisili"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="form-group">
                            <label for="jns_kelamin">Jenis Kelamin</label>
                            <select class="form-select form-select-sm is-invalid input" required id="jns_kelamin"
                                name="jns_kelamin">
                                <option selected disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-sm is-invalid input" required
                                id="email" name="email">
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="form-group">
                            <label for="no_hp">No. HP / WhatsApp Aktif</label>
                            <input type="text" class="form-control form-control-sm is-invalid input" required
                                id="no_hp" name="no_hp" maxlength="16">
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="form-group">
                            <label for="pendidikan">Pendidikan Terakhir:</label>
                            <select name="pendidikan" id="pendidikan" autocomplete="off" required
                                class="form-select form-select-sm is-invalid input">
                                <option value="" disabled selected hidden>- Pilih Pendidikan Terakhir -</option>
                                <option value="SD">SD</option>
                                <option value="SMP/Sederajat">SMP/Sederajat</option>
                                <option value="SMA/Sederajat">SMA/Sederajat</option>
                                <option value="D1">D1</option>
                                <option value="D2">D2</option>
                                <option value="D3">D3</option>
                                <option value="Bachelor/S1">Bachelor/S1</option>
                                <option value="Master/S2">Master/S2</option>
                                <option value="Doctor/S3">Doctor/S3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="form-group">
                            <label for="jurusan">Jurusan/Prodi <small><i>(jika tidak ada isi dengan tanda '-')</i></small>
                            </label>
                            <input type="text" class="form-control form-control-sm is-invalid input" required
                                id="jurusan" name="jurusan">
                        </div>
                    </div>
                    @if ($loker->id_cabang == 99)
                        <div class="col-md-4 mb-4">
                            <div class="form-group">
                                <label for="jurusan">
                                    Kantor Cabang <small><i>(Pilih kantor cabang yang ingin Anda tuju)</i></small>
                                </label>
                                <select name="id_cabang" id="id_cabang" autocomplete="off" required
                                    class="form-select form-select-sm is-invalid input">
                                    <option value="" disabled selected hidden>- Pilih Kantor Cabang -</option>
                                    <option value="1">Kantor Pusat Operasional (Parakan)</option>
                                    <option value="2">Kc Temanggung</option>
                                    <option value="3">Kc Wonosobo</option>
                                    <option value="4">Kc Ambarawa</option>
                                    <option value="5">Kc Semarang</option>
                                    <option value="6">Kc Mranggen</option>
                                    <option value="7">Kc Sukorejo</option>
                                    <option value="8">Kc Weleri</option>
                                    <option value="9">Kc Delanggu</option>
                                    <option value="10">Kc Gombong</option>
                                    <option value="11">Kc Sokaraja</option>
                                </select>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="row" style="margin-left: 5px">
                    <div class="col-md-12 mb-4">
                        <div class="form-group">
                            <label>Berkas Pendukung (Surat Lamaran, CV, KTP, Transkip Nilai, Portfolio, Ijazah dan lainnya)
                                jadikan
                                satu dalam bentuk PDF: (File Max: 10MB)</label>
                            <input type="file" name="berkas_pendukung" id="berkas_pendukung" required
                                class="form-control form-control-sm is-invalid input" accept=".pdf">

                            <!-- Tampilan Progress Bar (Awalnya Tersembunyi) -->
                            <div id="progressWrapper" class="progress d-none"
                                style="height: 20px; border-radius: 8px; margin-top: 10px;">
                                <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated"
                                    role="progressbar" style="width: 0%;">0%</div>
                            </div>
                        </div>
                    </div>
                </div>

                <span class="text-primary m-3">
                    <b>Note: </b> Pastikan bahwa data yang diisikan <b>Benar dan Valid</b> karena setelah dikirim data tidak
                    dapat <b>Diubah!</b>
                </span>


            </div>
            <div class="card-footer text-end">
                <button type="button" id="simpan" class="btn btn-primary mb-2" style="border-radius: 8px">
                    <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status"
                        aria-hidden="true"></span>
                    <span id="btnText">Kirim Lamaran</span>
                </button>
            </div>
        </form>

    </div>
@endsection

@section('script')
    <script src="{{ asset('script/confirm-button.js') }}"></script>
    <script>
        $(function() {
            // Event listener untuk semua elemen dengan class .input
            $(document).on("change keyup", ".input", function() {
                var value = $(this).val();

                if (value && value.toString().trim() !== "") {
                    // Ada value → hijau
                    $(this).addClass("is-valid").removeClass("is-invalid");
                } else {
                    // Kosong → merah
                    $(this).addClass("is-invalid").removeClass("is-valid");
                }
            });
        })

        // fungsi allow only number
        allowOnlyNumbers(document.getElementById('no_hp'))

        function allowOnlyNumbers(input) {
            input.addEventListener("input", function() {
                // Hapus semua karakter yang bukan angka
                this.value = this.value.replace(/[^0-9]/g, "");
            });
        }
    </script>


    {{-- progress --}}
    <script>
        document.getElementById('berkas_pendukung').addEventListener('change', function() {
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
                if (file.type !== "application/pdf" && !file.name.endsWith('.pdf')) {
                    Swal.fire({
                        title: "Gagal!",
                        text: "Format file tidak didukung! Hanya file PDF yang diperbolehkan.",
                        icon: "error",
                    });
                    this.value = ''; // Reset input file
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
                        btnText.textContent = 'Kirim Lamaran';
                    }
                }, 100);
            }
        });
    </script>
@endsection
