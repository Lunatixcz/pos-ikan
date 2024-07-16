<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\IkanController;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use App\Models\Customer;
use App\Models\Ikan;
use App\Models\Pembelian;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/admin', function () {

    $ikans = Ikan::all();

    return view('dashboard', compact('ikans'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(LaporanController::class)->group(function () {
        Route::get('/laporan', 'index')->name('laporan.index');
        Route::get('/generate-pdf', 'generatePDF')->name('generate.pdf');
    });

    Route::resources([
        'ikan' => IkanController::class,
        'customer' => CustomerController::class,
        'supplier' => SupplierController::class,
        'pembelian' => PembelianController::class,
        'penjualan' => PenjualanController::class,
    ]);
});

require __DIR__ . '/auth.php';
