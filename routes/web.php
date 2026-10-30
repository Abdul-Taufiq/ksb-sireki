<?php

use App\Http\Controllers\Applicant\ApplicantController;
use App\Http\Controllers\Applicant\QuizKrapelinController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HasilTestPesertaController, LoginController, HelperController, PelamarController, LokerController, PrintDokumenController, PrintResumeController};
use App\Http\Controllers\Applicant\LoginApplicantController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Quiz\{BankSoalController, IndexBankSoalController, JadwalController, KategoriSoalController, KraepelinController, PaketSoalController};
use App\Models\Quiz\PaketSoal;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;




Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('optimize:clear');
    return 'DONE'; //Return anything
});

Route::get('/', [PelamarController::class, 'dashboard'])->name('dashboard');
Route::get('/show-loker/{id}', [PelamarController::class, 'dashboardShow']);

Route::get('pelamar/create/{id}', [PelamarController::class, 'create'])->name('pelamar-create');
Route::post('pelamar/store', [PelamarController::class, 'store'])->name('pelamar-store');
Route::get('pelamar/show/{id}', [PelamarController::class, 'showData'])->name('pelamar-show');
Route::get('get-data-pelamar', [PelamarController::class, 'getDataPelamar']);


// Login
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'postlogin']);
Route::get('/refereshcapcha', [HelperController::class, 'refereshCaptcha']);


// Lupa Password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


// Register
// Route::get('/register', [RegisterController::class, 'index']);
Auth::routes(['verify' => true]);


Auth::routes();


// HALAMAN LOGIN FOR APPLICANT
Route::get('tq/applicant/login', function () {
    return view('page.applicant.login-applicant', ['title' => 'Login Applicant']);
})->name('applicant.login');

Route::post('applicant/login', [LoginApplicantController::class, 'loginApplicant'])->name('applicant.login.post');

// For Admin
Route::group(['middleware' => ['permission', 'auth:web']], function () {
    // HAK AKSES Admin
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::group(['middleware' => ['ceklevel:SUPER USER, DIREKTUR']], function () {
        Route::resource('applicant', PelamarController::class)->except(['index', 'show']);

        // Bank soal
        Route::prefix('bank-soal')->group(function () {
            Route::prefix('psikotes')->group(function () {
                Route::get('sesiOne', [IndexBankSoalController::class, 'sesiOne'])->name('sesi-one.index');
                Route::get('pengetahuan-perbankan', [IndexBankSoalController::class, 'pengetahuanPerbankan'])->name('pengetahuan-perbankan.index');
                Route::get('analogi-verbal', [IndexBankSoalController::class, 'analogiVerbal'])->name('analogi-verbal.index');
                Route::get('hitung-cepat', [IndexBankSoalController::class, 'hitungCepat'])->name('hitung-cepat.index');
                Route::get('tes-integritas', [IndexBankSoalController::class, 'tesIntegritas'])->name('tes-integritas.index');
                Route::get('tes-informasi-singkat', [IndexBankSoalController::class, 'tesInfoSingkat'])->name('tes-informasi-singkat.index');
                Route::get('tes-penalaran-analitik', [IndexBankSoalController::class, 'tesPenalaran'])->name('tes-penalaran-analitik.index');
                Route::get('tes-kemampuan-verbal', [IndexBankSoalController::class, 'tesKemampuanVerbal'])->name('tes-kemampuan-verbal.index');
                Route::get('tes-ketelitian', [IndexBankSoalController::class, 'tesKetelitian'])->name('tes-ketelitian.index');
                Route::get('tes-kemampuan-kuantitatif', [IndexBankSoalController::class, 'tesKemampuanKuantitatif'])->name('tes-kemampuan-kuantitatif.index');
                Route::get('kraepelin', [KraepelinController::class, 'index'])->name('kraepelin.index');
            });

            Route::prefix('jabatan')->group(function () {
                Route::get('analis-kredit', [IndexBankSoalController::class, 'jabatanAnalis'])->name('analis-kredit.index');
                Route::get('audit-internal', [IndexBankSoalController::class, 'jabatanAudit'])->name('audit-internal.index');
                Route::get('marketing', [IndexBankSoalController::class, 'jabatanMarketing'])->name('marketing.index');
                Route::get('bidang-perkreditan', [IndexBankSoalController::class, 'jabatanPerkreditan'])->name('bidang-perkreditan.index');
                Route::get('bidang-legal', [IndexBankSoalController::class, 'jabatanLegal'])->name('bidang-legal.index');
                Route::get('remedial', [IndexBankSoalController::class, 'jabatanRemedial'])->name('remedial.index');
            });

            Route::prefix('kepribadian')->group(function () {
                Route::get('swot', [IndexBankSoalController::class, 'swot'])->name('swot.index');
                Route::get('disc', [IndexBankSoalController::class, 'disc'])->name('disc.index');
                Route::get('mbti', [IndexBankSoalController::class, 'mbti'])->name('mbti.index');
            });

            Route::get('sesi-tes/create/{tes}/{jns_tes}/{id_kategori}', [BankSoalController::class, 'create'])->name('sesi-tes.create');
            Route::get('sesi-tes-import/create/{tes}/{jns_tes}/{id_kategori}', [BankSoalController::class, 'createImport'])->name('sesi-tes.import');
            Route::post('sesi-tes', [BankSoalController::class, 'store'])->name('sesi-tes.store');
            Route::post('sesi-tes-import', [BankSoalController::class, 'storeImport'])->name('sesi-tes.store.import');
            Route::get('sesi-tes/{id}/edit/{tes}/{jns_tes}/{id_kategori}', [BankSoalController::class, 'edit'])->name('sesi-tes.edit');
            Route::patch('sesi-tes/{id}', [BankSoalController::class, 'update'])->name('sesi-tes.update');
            Route::delete('sesi-tes/{id}', [BankSoalController::class, 'destroy'])->name('sesi-tes.destroy');

            Route::get('kraepelin/create', [KraepelinController::class, 'create'])->name('kraepelin.create');
            Route::post('kraepelin', [KraepelinController::class, 'store'])->name('kraepelin.store');
            Route::get('kraepelin/{id}/edit', [KraepelinController::class, 'edit'])->name('kraepelin.edit');
            Route::patch('kraepelin/{id}', [KraepelinController::class, 'update'])->name('kraepelin.update');
            Route::delete('kraepelin/{id}', [KraepelinController::class, 'destroy'])->name('kraepelin.destroy');
        });

        // paket
        Route::prefix('setting-tes')->group(function () {
            Route::resource('paket-soal', PaketSoalController::class)->except(['index', 'show']);
            Route::resource('kategori-soal', KategoriSoalController::class)->except(['index', 'show']);
        });

        // Penjadwalan
        Route::resource('penjadwalan', JadwalController::class)->except(['index', 'show']);

        // print resume
        Route::get('/print-resume/{idPelamar}', [PrintResumeController::class, 'create'])->name('resume.create');
        Route::post('/print-resume', [PrintResumeController::class, 'store'])->name('resume.store');
        Route::get('/print-resume/{idPelamar}/print', [PrintResumeController::class, 'print'])->name('resume.print');



        // print document
        Route::resource('print-document', PrintDokumenController::class);
        Route::get('print-document/pakta-integritas/{id}', [PrintDokumenController::class, 'printPaktaIntegritas'])->name('print-document.pakta-integritas');
        Route::post('print-document/update-data-pelamar', [PrintDokumenController::class, 'updateData'])->name('print-document.update-data');
        Route::get('print-document/kode-etik/{id}', [PrintDokumenController::class, 'printKodeEtik'])->name('print-document.kode-etik');
        Route::get('print-document/sp-penyerahan-jamker/{id}', [PrintDokumenController::class, 'printSPPenyerahanJamker'])->name('print-document.sp-penyerahan-jamker');
        Route::get('print-document/ba-penyerahan-jamker/{id}', [PrintDokumenController::class, 'printBAPenyerahanJamker'])->name('print-document.ba-penyerahan-jamker');
        Route::get('print-document/sp-slik/{id}', [PrintDokumenController::class, 'printSPSLIK'])->name('print-document.sp-slik');
        Route::get('print-document/surat-pernyataan/{id}', [PrintDokumenController::class, 'printSuratPernyataan'])->name('print-document.surat-pernyataan');
    });

    // yang penting udah login dan bukan pelamar
    // Semua user login boleh akses index
    Route::resource('loker', LokerController::class);
    Route::resource('applicant', PelamarController::class)->only(['index', 'show']);
    Route::get('sesi-tes/show/{id}', [BankSoalController::class, 'show'])->name('sesi-tes.show');
    // update status pelamar
    Route::post('applicant/change-status', [PelamarController::class, 'changeStatus'])->name('applicant.changeStatus');

    // Setting Test
    Route::prefix('setting-tes')->group(function () {
        Route::resource('paket-soal', PaketSoalController::class)->only(['index', 'show']);
        Route::resource('kategori-soal', KategoriSoalController::class)->only(['index', 'show']);
    });

    // Penjadwalan
    Route::resource('penjadwalan', JadwalController::class)->only(['index', 'show']);

    // hasil test peserta
    Route::resource('hasil-test-peserta', HasilTestPesertaController::class)->only(['index', 'show']);
    Route::get('hasil-test-peserta-detail/{idPeserta}/{idSoal}', [HasilTestPesertaController::class, 'showDetail'])->name('hasil-test-peserta-detail.show');
    Route::get('hasil-test-peserta-detail/ganti-jawaban/{id}/{is_correct}/{kategori_soal}', [HasilTestPesertaController::class, 'gantiJawaban'])->name('hasil-test-peserta-detail.ganti-jawaban');
});

// For Pelamar/Applicant yang udah login
Route::group(['middleware' => ['permission', 'auth:pelamar']], function () {
    Route::prefix('tq/applicant')->group(function () {
        Route::get('home', function () {
            $paket = PaketSoal::with('paketkategori.kategori')->findOrFail(auth('pelamar')->user()->id_paket_soal);
            // dd($paket);
            // dd(auth('pelamar')->user()->id_paket_soal);

            return view('home-applicant', ['title' => 'Home Applicant', 'paket' => $paket]);
        })->name('applicant.home');

        // banksoal
        Route::get('tes/{nama_tes}/{id}', [ApplicantController::class, 'index'])->name('applicant.view');
        Route::post('tes/soal/cek-kode', [ApplicantController::class, 'cekKodeSoal'])->name('applicant.cek.kode');
        Route::any('tes/soal/{id}/{nama_tes}', [ApplicantController::class, 'soal'])->name('applicant.soal');

        // soal dan jawaban
        Route::post('/simpan-jawaban', [ApplicantController::class, 'simpanJawaban'])->name('simpan.jawaban');
        Route::post('/kraepelin/autosave', [ApplicantController::class, 'autosaveKraepelin'])->name('kraepelin.autosave');
        Route::get('/kraepelin/selesai', function () {
            return redirect()
                ->route('applicant.home')
                ->with(
                    'AlertSuccess',
                    'Jawaban berhasil disimpan'
                );
        })->name('kraepelin.selesai');


        Route::post('/pelamar/logout', [LoginApplicantController::class, 'logoutApplicant'])->name('pelamar.logout');
    });
});
