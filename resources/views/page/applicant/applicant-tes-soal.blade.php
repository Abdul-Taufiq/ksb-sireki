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
                            @if ($nama_tes == 'DISC')
                                <iframe src="https://forms.gle/npaN3iPKauJfGrsk7" frameborder="1" width="100%"
                                    height="480px"></iframe>
                            @elseif ($nama_tes == 'MBTI')
                                <iframe src="https://forms.gle/e83Hsem4qjr7SHCp9" frameborder="1" width="100%"
                                    height="480px"></iframe>
                            @else
                                @foreach ($soal as $index => $item)
                                    <div class="soal d-none">
                                        <strong>Soal {{ $index + 1 }}</strong> :
                                        <div class="m-3 p-4 bg-secondary-subtle p-3 rounded">
                                            {!! $item->pertanyaan !!}
                                        </div>

                                        <input type="hidden" name="id_soal_{{ $loop->iteration }}"
                                            id="id_soal_{{ $loop->iteration }}" value="{{ base64_encode($item->id) }}"
                                            class="form-control">

                                        <input type="hidden" name="nama_tes_{{ $loop->iteration }}"
                                            id="nama_tes_{{ $loop->iteration }}" value="{{ $item->nama_tes }}"
                                            class="form-control">

                                        <label for="jawaban_{{ $loop->iteration }}">Jawaban Anda:</label>

                                        @php
                                            $opsiArray = json_decode($item->opsi_jawaban, true) ?? [];

                                            // buang elemen ke-5 kalau nilainya "-"
                                            if (isset($opsiArray[4]) && $opsiArray[4] === '-') {
                                                unset($opsiArray[4]);
                                            }

                                            // reset index array setelah unset
                                            $opsiArray = array_values($opsiArray);
                                        @endphp

                                        @if (!empty($opsiArray) && !collect($opsiArray)->every(fn($val) => $val === '-'))
                                            @php
                                                // acak isi array
                                                shuffle($opsiArray);
                                            @endphp

                                            @foreach ($opsiArray as $index => $opsi)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="jawaban_{{ $loop->parent->iteration }}"
                                                        id="jawaban_{{ $loop->parent->iteration }}_{{ $index }}"
                                                        value="{{ $opsi }}">
                                                    <label class="form-check-label"
                                                        for="jawaban_{{ $loop->parent->iteration }}_{{ $index }}">
                                                        {{ $opsi }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        @else
                                            <textarea id="jawaban_{{ $loop->iteration }}" name="jawaban_{{ $loop->iteration }}" cols="10" rows="3"
                                                class="form-control"></textarea>
                                        @endif


                                        <hr>
                                    </div>
                                @endforeach
                            @endif
                        </div>


                        <input type="hidden" id="nama_tes" name="nama_tes" value="{{ $nama_tes }}">
                        @if ($nama_tes == 'DISC' || $nama_tes == 'MBTI')
                            <div class="d-flex justify-content-end mt-3">
                                <button type="button" class="btn btn-success" onclick="selesai()">Selesai</button>
                            </div>
                        @else
                            <div class="d-flex justify-content-between mt-3">
                                <button type="button" class="btn btn-info" onclick="gotoEmpty()">Cek Soal
                                    Kosong</button>
                                <button type="button" class="btn btn-secondary" onclick="prevPage()">Previous</button>
                                <button type="button" class="btn btn-primary" onclick="nextPage()">Next</button>
                                <button type="button" class="btn btn-success" onclick="selesai()">Selesai</button>
                            </div>
                        @endif
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
        const perPage = 5; // Set to 1 for Kraepelin test
        const soalEls = document.querySelectorAll(".soal");
        const totalPages = Math.ceil(soalEls.length / perPage);

        function showPage(page) {
            soalEls.forEach(el => el.classList.add("d-none"));
            soalEls.forEach((el, i) => {
                if (i >= (page - 1) * perPage && i < page * perPage) {
                    el.classList.remove("d-none");
                }
            });
            currentPage = page;
        }

        function nextPage() {
            if (currentPage < totalPages) showPage(currentPage + 1);
        }

        function prevPage() {
            if (currentPage > 1) showPage(currentPage - 1);
        }

        function gotoEmpty() {
            let emptyIndex = Array.from(soalEls).findIndex(el => {
                // ambil semua input dan textarea dalam satu soal
                let radios = el.querySelectorAll("input[type=radio]");
                let textareas = el.querySelectorAll("textarea");

                // cek radio: minimal ada satu yang checked
                let radioValid = radios.length === 0 || Array.from(radios).some(r => r.checked);

                // cek textarea: semua harus ada isi
                let textareaValid = Array.from(textareas).every(t => t.value.trim() !== "");

                // soal dianggap kosong kalau radio tidak valid ATAU textarea tidak valid
                return !(radioValid && textareaValid);
            });

            if (emptyIndex !== -1) {
                let page = Math.floor(emptyIndex / perPage) + 1;
                showPage(page);
            } else {
                Swal.fire({
                    title: "Ready to save!",
                    text: "Semua soal sudah terisi!",
                    icon: "success",
                });
            }
        }



        function selesai() {
            // Jika semua input diperlukan sudah terisi, tampilkan konfirmasi simpan
            Swal.fire({
                title: "Yakin Ingin Menyelesaikan Tes?",
                html: `PASTIKAN SEMUA SOAL SUDAH TERJAWAB DENGAN BENAR DAN JANGAN LEWATKAN SOAL SATUPUN!`,
                icon: "info",
                theme: document.body.classList.contains("darkmode") ?
                    "dark" : "light",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Simpan!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    clearTimerOnLogout();

                    document.getElementById('formJawaban').submit();
                }
            });
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

        // Gunakan key unik per halaman (misalnya berdasarkan path URL)
        let pageKey = "endTimes_" + window.location.pathname;

        // Jika belum ada endTime tersimpan → set baru
        if (!localStorage.getItem(pageKey)) {
            let endTime = Date.now() + (duration * 1000);
            localStorage.setItem(pageKey, endTime);
        }

        function updateTimer() {
            let endTime = parseInt(localStorage.getItem(pageKey));
            let durationLeft = Math.floor((endTime - Date.now()) / 1000);

            if (durationLeft < 0) {
                clearInterval(timerInterval);
                localStorage.removeItem(pageKey); // hapus setelah habis
                document.getElementById('formJawaban').submit();
                return;
            }

            let minutes = Math.floor(durationLeft / 60);
            let seconds = durationLeft % 60;
            timerEl.innerText = `🕓 Sisa waktu: ${minutes}:${seconds < 10 ? '0'+seconds : seconds}`;
        }

        timerInterval = setInterval(updateTimer, 1000);
        updateTimer(); // render pertama kali


        // Opsional: hapus timer saat logout/pindah halaman
        function clearTimerOnLogout() {
            localStorage.removeItem(pageKey);
        }

        // init
        showPage(1);
    </script>
@endsection
