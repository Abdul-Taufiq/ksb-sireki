<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\PenjadwalanController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/sss', function () {
//     echo "Hallo";
// });

// Route::fallback(function () {
//     return view('errors.404');
// });


Route::get('/', [PelamarController::class, 'dashboard'])->name('dashboard');

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('route:cache');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});


Route::get('calon/create', [PelamarController::class, 'create'])->name('calon-create');
Route::post('calon/store', [PelamarController::class, 'store'])->name('calon-store');


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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['permission']], function () {
    // HAK AKSES Admin
    Route::group(['middleware' => ['auth', 'ceklevel:Admin TSI,Direktur']], function () {

        Route::resource('loker', LokerController::class);
        Route::resource('pelamar', PelamarController::class);
        Route::resource('penjadwalan', PenjadwalanController::class);
        Route::resource('user', UserController::class);
        Route::get('/test-admin', [QuizController::class, 'view']);
        Route::get('/test-admin/{id}/edit', [QuizController::class, 'edit']);
        Route::patch('/test-admin/{id}', [QuizController::class, 'update']);
        Route::post('/update-status', [PelamarController::class, 'updateStatus'])->name('status-pelamar');
    });
});

Route::get('/test-calon-karyawan-ksb', [QuizController::class, 'index'])->middleware('quiz');
Route::get('/test-selesai', [QuizController::class, 'QuizSelesai']);
Route::get('/test-start', [QuizController::class, 'QuizStart']);
Route::post('/test-check', [QuizController::class, 'QuizCheck']);

Route::get('/example', [ExampleController::class, 'index'])->name('quiz.result');
Route::post('/store', [ExampleController::class, 'store'])->name('example-store');
Route::get('/quiz', [ExampleController::class, 'show'])->name('quiz.show');
Route::post('/quiz', [ExampleController::class, 'submit'])->name('quiz.submit');
