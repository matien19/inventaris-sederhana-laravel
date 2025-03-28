<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.main');
});

Route::get('/products', [ProductController::class, 'index'])->name('index');
Route::post('/products/add', [ProductController::class, 'store'])->name('add.product');

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('a.transaksi');
Route::get('/transaksi/detail/{id}', [TransaksiController::class, 'detail'])->name('a.transaksi.detail');
Route::post('/transaksi/detail/store/{id}/{produkId}', [TransaksiController::class, 'detail_store'])->name('a.transaksi.detail.store');

