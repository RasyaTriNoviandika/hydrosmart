<?php

use App\Http\Controllers\HydroSmartController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Hydro Smart
|--------------------------------------------------------------------------
*/

// Halaman utama - Pilih volume air
Route::get('/', [HydroSmartController::class, 'index'])->name('index');

// Detail produk
Route::get('/product/{id}', [HydroSmartController::class, 'detail'])->name('detail');

// Proses pembelian
Route::post('/product/{id}/purchase', [HydroSmartController::class, 'purchase'])->name('purchase');

// Halaman pembayaran dengan QR Code
Route::get('/payment/{id}', [HydroSmartController::class, 'payment'])->name('payment');

// Konfirmasi pembayaran (simulasi)
Route::post('/payment/{id}/confirm', [HydroSmartController::class, 'confirmPayment'])->name('confirm');

// Halaman sukses
Route::get('/success/{id}', [HydroSmartController::class, 'success'])->name('success');

// Riwayat transaksi
Route::get('/history', [HydroSmartController::class, 'history'])->name('history');

// API check status (untuk auto-refresh)
Route::get('/api/transaction/{id}/status', [HydroSmartController::class, 'checkStatus'])->name('check-status');