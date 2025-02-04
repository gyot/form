<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\FormDataController;
use App\Http\Livewire\PagesController;
use App\Http\Livewire\HomeController;
use App\Http\Livewire\AgendaKegiatanController;
use App\Http\Controllers\AuthController;
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

Route::get('/login', function () {
    return abort(404);
});
// --------------------------------------------------------------------------
Route::get('/form/{id_kegiatan}/{status}/{kegiatan}', [FormDataController::class, 'index']);
Route::get('/get-biodata/{id_kegiatan}', [PagesController::class, 'createWordDocument']);
Route::post('/simpan_biodata', [FormDataController::class, 'store'])->name('form_data.store');
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->prefix('home')->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
//     Route::get('/kegiatan',[HomeController::class, 'kegiatan']);
// });

Route::get('/generate-docx', [PagesController::class, 'tes_tabel']);


// Route::middleware(['auth'])->prefix('home')->group(function () {
//     // Route::get('/dashboard', function () {
//     //     return view('dashboard');
//     // })->name('dashboard');
//     // Route::get('/kegiatan',[AgendaKegiatanController::class, 'index'])->name('agenda.index');
//     // Route::post('/tambah-kegiatan', [AgendaKegiatanController::class, 'store'])->name('kegiatan.store');
// });

Route::middleware(['auth'])->prefix('home')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/kegiatan',[AgendaKegiatanController::class, 'index'])->name('agenda.index');
    Route::get('/data-kegiatan', [AgendaKegiatanController::class, 'dataApiKegaitan']);
    Route::post('/tambah-kegiatan', [AgendaKegiatanController::class, 'store'])->name('kegiatan.store');
    Route::get('/kegiatan/detail/{id}',[AgendaKegiatanController::class,'detail']);
    Route::get('/kegiatan/ubah/status/{id}/{status}',[AgendaKegiatanController::class,'ubahstatus']);
    Route::get('/kegiatan/detail/json/{id}',[AgendaKegiatanController::class,'detailJson']);
    Route::get('/kegiatan/ubah/status/{id}',[AgendaKegiatanController::class,'ubahstatus']);
    Route::get('/kegiatan/hapus/{id}', [AgendaKegiatanController::class,'destroy'])->name('hapus');
});

Route::get('/laman-masuk', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/laman-masuk', [AuthController::class, 'lamanMasuk']);
Route::post('/laman-keluar', [AuthController::class, 'logout'])->name('logout');
// Auth::routes(['register' => false]);