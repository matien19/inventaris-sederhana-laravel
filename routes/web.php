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

