<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pendaftarancontroller;
use App\Http\Controllers\wawancaracontroller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembayaranController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/siswa', [pendaftarancontroller::class, 'SPMB'])->name('SPMB.index');
Route::get('/siswa/pendaftaran', [pendaftarancontroller::class, 'pendaftaran'])->name('SPMB.pendaftaran');
Route::post('/siswa', [pendaftarancontroller::class, 'store'])->name('siswa.store');
Route::delete('/siswa/{id}', [pendaftarancontroller::class, 'destroy'])->name('siswa.destroy');

Route::get('/wawancara', [wawancaracontroller::class, 'wawancara'])->name('wawancara.index');
Route::post('/wawancara', [wawancaracontroller::class, 'store'])->name('wawancara.store');
Route::delete('/wawancara/{wawancara}', [wawancaracontroller::class, 'destroy'])->name('wawancara.destroy');

Route::get('/pembayaran', [pembayarancontroller::class, 'index'])->name('pembayaran.index');
Route::post('/pembayaran', [pembayarancontroller::class, 'store'])->name('pembayaran.store');
Route::delete('/pembayaran/{id}', [pembayarancontroller::class, 'destroy'])->name('pembayaran.destroy');
