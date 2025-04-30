<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Api\KotaController;

// Route dasar
Route::get('/', function () {
    return view('welcome');
});

// Route untuk testing
Route::get('/cek', function () {
    return view('coba');
});

// Route untuk view statis
Route::get('/layanan/view', function () {
    return view('layanan.index');
})->name('layanan.view');

Route::resource('orders', OrderController::class);

Route::get('/jadwal', function () {
    return view('jadwal.index');
})->name('jadwal');

Route::get('/pembayaran', function () {
    return view('pembayaran.index');
})->name('pembayaran');

Route::get('/riwayat', function () {
    return view('riwayat.index');
})->name('riwayat');

// Route resource
Route::resource('pelanggan', PelangganController::class);
Route::resource('layanan', LayananController::class);
Route::resource('petugas', PetugasController::class)
    ->parameters(['petugas' => 'petugas:id_petugas']);


Route::get('/kota', [KotaController::class, 'index']);
