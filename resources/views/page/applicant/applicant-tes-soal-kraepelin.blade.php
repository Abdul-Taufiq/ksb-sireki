@extends('partial.main')

@section('style')
    <!-- CSS -->

    <style>
        p {
            margin-bottom: 2px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 2px solid #1c8c94 !important;
        }

        textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 2px solid #1c8c94 !important;
        }
    </style>
@endsection

@section('content')
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header text-end">
                    {{-- Timer --}}
                    <div id="timer" class="mt-3 text-danger fw-bold"></div>
                </div>
                <div class="card-body">
                    <input type="hidden" name="waktu" id="waktu" value="{{ $kategori->waktu }}">
                    <input type="hidden" name="satuan_waktu" id="satuan_waktu" value="{{ $kategori->satuan_waktu }}">

                    <form id="formJawaban" method="POST" action="{{ route('simpan.jawaban') }}">
                        @csrf
                        <div id="soal-container">
                            @foreach ($soal as $index => $item)
                                <div class="soal d-none">
                                    <div class="m-3 p-4 bg-secondary-subtle p-3 rounded">
                                        <center>
                                            <table class="table table-borderless table-secondary"
                                                style="width: 10%; font-size: 2rem; text-align: center;">
                                                <tr class="align-middle">
                                                    <th> {{ $item->nilai_1 }} </th>
                                                    <th rowspan="2"> + </th>
                                                </tr>
                                                <tr>
                                                    <th> {{ $item->nilai_2 }} </th>
                                                </tr>

                                            </table>
                                        </center>
                                    </div>




                                    <input type="hidden" name="id_soal_{{ $loop->iteration }}"
                                        id="id_soal_{{ $loop->iteration }}" value="{{ base64_encode($item->id) }}"
                                        class="form-control">

                                    <div style="width: 20% !important; margin: auto;">
                                        <label for="jawaban_{{ $loop->iteration }}">Jawaban Anda:</label>
                                        <input type="text" id="jawaban_{{ $loop->iteration }}"
                                            name="jawaban_{{ $loop->iteration }}" class="form-control" maxlength="1"
                                            autocomplete="off" inputmode="numeric"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            onkeyup="handleKeyUp(this)">
                                    </div>


                                    <hr>
                                </div>
                            @endforeach
                        </div>

                        {{-- <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-info" onclick="gotoEmpty()">Cek Soal Kosong</button>
                            <button type="button" class="btn btn-secondary" onclick="prevPage()">Previous</button>
                            <button type="button" class="btn btn-primary" onclick="nextPage()">Next</button>
                            <button type="button" class="btn btn-success" onclick="selesai()">Selesai</button>
                        </div> --}}
                    </form>

                    <br>

                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
@endsection


@section('script')
    <!-- JS -->
    <script>
        let currentPage = 1;
        const perPage = 1;
        const soalEls = document.querySelectorAll(".soal");
        const totalPages = Math.ceil(soalEls.length / perPage);


        // ambil jawaban
        let jawabanSementara = [];
        let periodeTerakhir = 0;
        let detikBerjalan = 0;

        function handleKeyUp(input) {
            // Hanya angka
            input.value = input.value.replace(/[^0-9]/g, '');

            // Harus tepat 1 digit
            if (!/^[0-9]$/.test(input.value)) {
                return;
            }

            // Ambil soal aktif
            const soalEl = input.closest('.soal');

            // Ambil ID soal dari hidden input
            const idSoal = soalEl.querySelector(
                'input[type="hidden"][name^="id_soal_"]'
            ).value;

            // Simpan sementara
            jawabanSementara.push({
                id_soal: idSoal,
                jawaban: input.value
            });

            // Lanjut soal berikutnya
            nextPage();
        }


        async function simpanJawabanKeServer(
            waktuHabis = false,
            periodeSekarang = null
        ) {
            if (jawabanSementara.length === 0) {

                if (waktuHabis) {
                    window.location.href =
                        "{{ route('kraepelin.selesai') }}";
                }

                return;
            }

            const dataKirim = [...jawabanSementara];

            try {

                const csrfToken = document.querySelector(
                    '#formJawaban input[name="_token"]'
                ).value;

                const response = await fetch(
                    "{{ route('kraepelin.autosave') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": csrfToken
                        },
                        body: JSON.stringify({
                            periode: periodeSekarang,
                            jawaban: dataKirim
                        })
                    }
                );

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(
                        result.message ||
                        'Gagal menyimpan jawaban'
                    );
                }

                // Hapus hanya jawaban yang berhasil dikirim
                jawabanSementara =
                    jawabanSementara.filter(
                        item => !dataKirim.includes(item)
                    );

                console.log(
                    `Periode ${periodeSekarang} berhasil disimpan`
                );

                // Kalau waktu habis, redirect setelah berhasil save
                if (waktuHabis) {
                    window.location.href =
                        "{{ route('kraepelin.selesai') }}";
                }

            } catch (error) {

                console.error(
                    'Gagal mengirim jawaban:',
                    error
                );
            }
        }



        function showPage(page) {
            // Sembunyikan semua soal
            soalEls.forEach(el => {
                el.classList.add("d-none");
            });

            // Tentukan soal yang aktif
            const index = (page - 1) * perPage;
            const activeSoal = soalEls[index];

            if (!activeSoal) {
                return;
            }

            // Tampilkan soal aktif
            activeSoal.classList.remove("d-none");
            currentPage = page;
            // Ambil INPUT JAWABAN
            const inputField = activeSoal.querySelector(
                'input[type="text"][name^="jawaban_"]'
            );

            if (inputField) {
                // Pastikan input kosong / sesuai kebutuhan
                inputField.focus();
                // Cursor berada di input
                inputField.select();
            }
        }


        function nextPage() {

            if (currentPage < totalPages) {
                // Pindah ke soal berikutnya
                showPage(currentPage + 1);

            } else {
                // Kalau soal terakhir
                console.log("Soal selesai");

                // Jika ingin langsung submit:
                // document.getElementById("formJawaban").submit();
            }
        }


        // Ambil nilai awal dari input
        let duration = parseInt(document.getElementById('waktu').value) || 0;
        let satuan_waktu = document.getElementById('satuan_waktu').value;

        // Konversi ke detik
        if (satuan_waktu === 'Menit') {
            duration = duration * 60;
        } else if (satuan_waktu === 'Detik') {
            duration = duration;
        } else {
            console.error('Satuan waktu tidak dikenali');
        }

        let timerEl = document.getElementById('timer');
        let timerInterval = null;

        // Key unik per halaman (gunakan path URL)
        let pageKey = "endTime_" + window.location.pathname;

        // Jika belum ada endTime tersimpan → set baru
        if (!localStorage.getItem(pageKey)) {
            let endTime = Date.now() + (duration * 1000);
            localStorage.setItem(pageKey, endTime);
        }

        function updateTimer() {
            let endTime = parseInt(localStorage.getItem(pageKey));
            let sisaDetik = Math.floor((endTime - Date.now()) / 1000);

            detikBerjalan++;

            // ==========================================
            // HITUNG PERIODE
            // ==========================================
            const periodeSekarang =
                Math.ceil(detikBerjalan / 20);

            // ==========================================
            // WAKTU HABIS
            // ==========================================
            if (detikBerjalan >= duration) {
                clearInterval(timerInterval);
                localStorage.removeItem(pageKey); // hapus setelah habis
                // Pada 120 detik:
                // Math.ceil(120 / 20) = 6
                simpanJawabanKeServer(true, periodeSekarang);
                return;
            }

            let minutes = Math.floor(sisaDetik / 60);
            let seconds = sisaDetik % 60;
            timerEl.innerText = `🕓 Sisa waktu: ${minutes}:${seconds < 10 ? '0'+seconds : seconds}`;

            // ==========================================
            // AUTOSAVE SETIAP 20 DETIK
            // ==========================================

            if (
                detikBerjalan % 20 === 0 &&
                periodeSekarang > periodeTerakhir
            ) {

                periodeTerakhir = periodeSekarang;

                simpanJawabanKeServer(
                    false,
                    periodeSekarang
                );
            }
        }

        timerInterval = setInterval(updateTimer, 1000);
        updateTimer();

        // 🔹 Opsional: hapus saat logout
        function clearTimerOnLogout() {
            localStorage.removeItem(pageKey);
        }

        // init
        showPage(1);
    </script>
@endsection
