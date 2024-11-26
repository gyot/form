<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\FormDataController;
use App\Http\Livewire\PagesController;
use App\Http\Livewire\HomeController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// --------------------------------------------------------------------------
Route::get('/{id_kegiatan}/{status}/{kegiatan}', [FormDataController::class, 'index']);
// Route::get('/{id_kegiatan}', [PagesController::class, 'createWordDocument']);
Route::post('/simpan', [FormDataController::class, 'store'])->name('form_data.store');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/kegiatan',[HomeController::class, 'kegiatan']);
