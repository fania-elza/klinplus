<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/layanan', function () {
  return view('layanan.index');
})->name('layanan');

Route::get('/order', function () {
   return view('order');
})->name('order');

Route::get('/jadwal', function () {
   return view('jadwal');
})->name('jadwal');

Route::get('/pembayaran', function () {
   return view('pembayaran');
})->name('pembayaran');

Route::get('/riwayat', function () {
   return view('riwayat');
})->name('riwayat');

Route::resource('pelanggan', PelangganController::class);

Route::get('/petugas', function () {
   return view('petugas.index');
})->name('petugas');