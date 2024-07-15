<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\IkanController;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use App\Models\Customer;
use App\Models\Pembelian;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resources([
        'ikan' => IkanController::class,
        'customer' => CustomerController::class,
        'supplier' => SupplierController::class,
        'pembelian' => PembelianController::class,
        'penjualan' => PenjualanController::class,
    ]);
});

require __DIR__ . '/auth.php';
