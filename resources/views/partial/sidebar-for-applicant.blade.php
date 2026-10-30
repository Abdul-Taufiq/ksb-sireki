<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="">

    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <a href="/tq/applicant/home" class="brand-link">
            <img src="{{ asset('img/logo-ksb.png') }}" alt="AdminLTE Logo" class="brand-image opacity-80 shadow"
                style="max-width: 45px; max-height: 45px" />
            <span class="brand-text fw-light">KSB | Si-Reki</span>
        </a>
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2" aria-label="Main navigation">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" data-accordion="false" id="navigation">

                <li class="nav-item">
                    <a href="/tq/applicant/home"
                        class="nav-link {{ request()->is('tq/applicant/home') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-houses"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- Test --}}
                <li class="nav-header">MASTER TEST</li>

                @foreach ($paket->paketkategori as $i => $relasi)
                    <li class="nav-item">
                        <a href="/tq/applicant/tes/{{ $relasi->kategori->nama_tes }}/{{ base64_encode($relasi->kategori->id) }}"
                            class="nav-link {{ request()->is('tq/applicant/tes/' . $relasi->kategori->nama_tes . '/' . base64_encode($relasi->kategori->id)) ? 'active' : '' }}"
                            onclick="clearTimerOnLogout()">
                            <i class="nav-icon bi bi-file-earmark-text"></i>
                            <p>{{ $relasi->kategori->nama_tes }}</p>
                        </a>
                    </li>
                @endforeach


            </ul>
            <!--end::Sidebar Menu-->

        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->


@if (Auth::guard('pelamar')->check())
    <input type="hidden" id="id_pelamar" value="{{ encrypt(Auth::guard('pelamar')->user()->id_pelamar) }}">
    <input type="hidden" id="waktu_aplikasi" value="{{ $paket->waktu_aplikasi }}">
@endif

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // =====================================
    // KONFIGURASI TIMER
    // =====================================

    let durasi = document.getElementById("waktu_aplikasi").value;
    // let durasi = 1000;
    let satuan = 'Menit';

    if (satuan === 'Menit') {
        durasi *= 60;
    } else if (satuan === 'Detik') {
        durasi = durasi;
    } else {
        console.error('Satuan waktu tidak dikenali');
    }

    const timerBlade = document.getElementById('timerApps');
    let timerIntervals = null;

    const idPelamar = document.getElementById('id_pelamar')?.value;

    // Gunakan key yang sama di SEMUA halaman
    const KunciHalaman = 'endTime_Apps';

    // =====================================
    // SIMPAN WAKTU BERAKHIR SATU KALI
    // =====================================

    let endTime = localStorage.getItem(KunciHalaman);

    if (endTime === null) {
        endTime = Date.now() + (durasi * 1000);
        localStorage.setItem(KunciHalaman, String(endTime));
    } else {
        endTime = parseInt(endTime, 10);
    }

    let logoutSedangDiproses = false;

    // =====================================
    // UPDATE TIMER
    // =====================================

    function updateTimer() {
        if (!timerBlade || logoutSedangDiproses) return;

        endTime = parseInt(localStorage.getItem(KunciHalaman), 10);

        if (!Number.isFinite(endTime)) {
            timerBlade.innerText = 'Sesi timer tidak ditemukan.';
            clearInterval(timerIntervals);
            return;
        }

        let durasiLeft = Math.floor(
            (endTime - Date.now()) / 1000
        );

        if (durasiLeft <= 0) {
            clearInterval(timerIntervals);

            timerBlade.innerText =
                '🕓 Sisa waktu Aplikasi sudah habis, Anda tidak dapat mengakses Aplikasi!';

            logoutPelamar();
            return;
        }

        let minutes = Math.floor(durasiLeft / 60);
        let seconds = durasiLeft % 60;

        timerBlade.innerText =
            `🕓 Sisa waktu Aplikasi: ${minutes}:${String(seconds).padStart(2, '0')}`;
    }

    // =====================================
    // LOGOUT SAAT WAKTU HABIS
    // =====================================

    function logoutPelamar() {
        if (logoutSedangDiproses) return;

        logoutSedangDiproses = true;
        clearInterval(timerIntervals);

        Swal.fire({
            title: 'Sesi Berakhir',
            text: 'Waktu Anda telah habis. Anda akan keluar dari aplikasi.',
            icon: 'warning',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: true,
            showCancelButton: false,
            showCloseButton: false,
            confirmButtonText: 'OK'
        }).then(function(result) {
            if (!result.isConfirmed) return;

            $.ajax({
                url: '{{ route('pelamar.logout') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    data: idPelamar
                },
                success: function() {
                    // Hapus timer setelah logout berhasil
                    localStorage.removeItem(KunciHalaman);

                    // Bersihkan data lain yang menggunakan ID pelamar
                    Object.keys(localStorage).forEach(function(key) {
                        if (idPelamar && key.includes(idPelamar)) {
                            localStorage.removeItem(key);
                        }
                    });

                    Object.keys(localStorage).forEach(function(key) {
                        // cek apakah key diawali dengan "endTimes_"
                        if (key.startsWith("endTimes_")) {
                            localStorage.removeItem(key);
                        }
                    });

                    window.location.replace('/tq/applicant/login');
                },
                error: function() {
                    logoutSedangDiproses = false;

                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat logout. Tekan OK untuk mencoba kembali.',
                        icon: 'error',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        confirmButtonText: 'OK'
                    }).then(function() {
                        logoutPelamar();
                    });
                }
            });
        });
    }

    // =====================================
    // MULAI TIMER
    // =====================================

    updateTimer();
    timerIntervals = setInterval(updateTimer, 1000);

    // Jangan hapus KunciHalaman saat pindah halaman.
    // Hapus hanya setelah logout berhasil.
</script>
