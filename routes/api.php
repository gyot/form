<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\AgendaKegiatanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/kegiatan', [AgendaKegiatanController::class, 'dataApiKegaitan']);
Route::get('/kegiatan/detail/json/{id}',[AgendaKegiatanController::class,'detailJson']);
Route::get('/kegiatan/ubah/status/{id}',[AgendaKegiatanController::class,'ubahstatus']);
Route::get('/kegiatan/hapus/{id}', [AgendaKegiatanController::class,'destroy'])->name('hapus');
