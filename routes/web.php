<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Antrian;
use App\Models\RekamMedis;
use App\Http\Livewire\DaftarUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\Admin\KartuController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DaftarRekamMedisController;
use App\Http\Controllers\Admin\AdminAntrianController;
use App\Http\Controllers\Admin\DaftarPembayaranController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Livewire\DaftarPembayaran;

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

Route::get('/', function () {
    return view('landing');
})->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/services', function () {
    return view('services');
})->name('services');



Route::get('/dashboard', function () {
    if(auth()->user()->role == 1) {
        return AntrianController::index();
    } else if (auth()->user()->role == 3) {
        return view('Dokter/accessRekamMedis',[
            // 'pasien_first' => Antrian::oldest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->whereIn('status', [2])->first(),
            'pasien_first' => Antrian::oldest()->where('tanggal_antrian', Carbon::now()->format('Y-m-d'))->whereIn('status', [2])->first(),
            'rekam_mediss' => RekamMedis::latest()->get(),
        ]);
    } else {
        return DashboardController::index();
        //Sementara
    }
})->middleware('auth')->name('dashboard');


// Route Auth
Route::prefix('auth')->name('auth.')->middleware('guest')->group(function () {
    Route::GET('/login', [LoginController::class, 'index'])->name('login.index');
    Route::POST('/login/store', [LoginController::class, 'store'])->name('login.store');

    Route::GET('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::POST('/register/store', [RegisterController::class, 'store'])->name('register.store');
});
Route::GET('auth/logout', [LoginController::class, 'logout'])->name('auth.logout')->middleware('auth');

// Route Pasien
Route::prefix('pasien')->name('pasien.')->middleware('auth')->group(function () {
    Route::POST('/antrian/store', [AntrianController::class, 'store'])->name('antrian.store');
});

// Route Admin
Route::prefix('admin')->name('admin.')->middleware('auth','admin')->group(function () {
    Route::GET('users', [UsersController::class, 'index'])->name('users.index');
    Route::POST('users/store', [UsersController::class, 'store'])->name('users.store');
    Route::POST('users/update', [UsersController::class, 'edit'])->name('users.edit');
    Route::POST('users/destroy', [UsersController::class, 'destroy'])->name('users.destroy');

    Route::GET('antrian', [AdminAntrianController::class, 'index'])->name('antrian.index');
    Route::POST('antrian/verifikasipasien', [AdminAntrianController::class, 'verifikasiPasien'])->name('antrian.verifikasiPasien');
    Route::POST('antrian/verifikasisemua', [AdminAntrianController::class, 'verifikasiSemua'])->name('antrian.verifikasiSemua');
    Route::POST('antrian/verifikasicancel', [AdminAntrianController::class, 'verifikasiCancel'])->name('antrian.verifikasiCancel');
    Route::POST('antrian/verifikasicancelsemua', [AdminAntrianController::class, 'verifikasiCancelSemua'])->name('antrian.verifikasiCancelSemua');

    Route::POST('antrian/expiredcancel', [AdminAntrianController::class, 'expiredCancel'])->name('antrian.expiredCancel');
    Route::POST('antrian/expiredcancelsemua', [AdminAntrianController::class, 'expiredCancelSemua'])->name('antrian.expiredCancelSemua');
    Route::POST('antrian/store', [AdminAntrianController::class, 'store'])->name('antrian.store');
    Route::POST('antrian/next', [AdminAntrianController::class, 'next'])->name('antrian.next');
    Route::POST('antrian/notComing', [AdminAntrianController::class, 'notComing'])->name('antrian.notComing');

    Route::GET('pembayaran', [DaftarPembayaranController::class, 'index'])->name('pembayaran.index');

    Route::get('/kartu', [KartuController::class, 'show'])->name('kartu');
    Route::get('/invoice', [InvoiceController::class, 'show'])->name('invoice');
});

// Route Dokter
Route::prefix('dokter')->name('dokter.')->middleware('auth','dokter')->group(function () {
    Route::POST('rekammedis/store', [RekamMedisController::class, 'store'])->name('rekamMedis.store');
    Route::POST('rekammedis/update', [RekamMedisController::class, 'edit'])->name('rekamMedis.edit');
    Route::POST('rekammedis/destroy', [RekamMedisController::class, 'destroy'])->name('rekamMedis.destroy');
    Route::GET('rekammedis', [DaftarRekamMedisController::class, 'index'])->name('rekamMedis.index');
    Route::GET('rekammedis/details/{slug}', [DaftarRekamMedisController::class, 'show'])->name('rekamMedis.show');
    Route::POST('daftarrekammedis/store', [DaftarRekamMedisController::class, 'store'])->name('DaftarRekamMedis.store');
});
