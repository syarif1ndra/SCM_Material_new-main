<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\KontrakController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\DetailProyekController;
use App\Http\Controllers\MaterialPemasokController;
use App\Http\Controllers\OrderMaterialController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Dashboard user biasa (dengan autentikasi)
Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup rute untuk pengguna dengan middleware 'auth'
Route::middleware('auth')->group(function () {
    // Rute profil pengguna
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Rute pemasok untuk user
    Route::prefix('user/pemasok')->name('user.pemasok.')->group(function () {
        Route::get('/', [PemasokController::class, 'index'])->name('index');
        Route::get('/create', [PemasokController::class, 'create'])->name('create');
        Route::post('/store', [PemasokController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PemasokController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PemasokController::class, 'update'])->name('update');
        Route::delete('/{id}', [PemasokController::class, 'destroy'])->name('destroy');
    });

    Route::get('/pengiriman', [PengirimanController::class, 'indexForUser'])->name('pengiriman.index');

});

// Route untuk kontrak dan material untuk admin dan user dengan hak akses
Route::middleware(['auth'])->group(function () {
    // Kontrak admin
    Route::prefix('admin/kontrak')->name('admin.kontrak.')->group(function () {
        Route::get('/', [KontrakController::class, 'index'])->name('index');
        Route::get('/create', [KontrakController::class, 'create'])->name('create');
        Route::post('/store', [KontrakController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [KontrakController::class, 'edit'])->name('edit');
        Route::put('/{id}', [KontrakController::class, 'update'])->name('update');
        Route::delete('/{id}', [KontrakController::class, 'destroy'])->name('destroy');
    });

    // Material pemasok
    Route::prefix('user/material')->name('user.material.')->group(function () {
        Route::get('/', [MaterialPemasokController::class, 'index'])->name('index');
        Route::get('/create', [MaterialPemasokController::class, 'create'])->name('create');
        Route::post('/', [MaterialPemasokController::class, 'store'])->name('store');
        Route::get('/{material}', [MaterialPemasokController::class, 'show'])->name('show');
        Route::get('/{material}/edit', [MaterialPemasokController::class, 'edit'])->name('edit');
        Route::put('/{material}', [MaterialPemasokController::class, 'update'])->name('update');
        Route::delete('/{material}', [MaterialPemasokController::class, 'destroy'])->name('destroy');
    });
});

// Rute untuk admin menggunakan 'admin' middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard admin
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Rute proyek admin
    Route::prefix('proyek')->name('proyek.')->group(function () {
        Route::get('/', [ProyekController::class, 'index'])->name('index');
        Route::get('/create', [ProyekController::class, 'create'])->name('create');
        Route::post('/', [ProyekController::class, 'store'])->name('store');
        Route::get('/{proyek}', [ProyekController::class, 'show'])->name('show');
        Route::get('/{proyek}/edit', [ProyekController::class, 'edit'])->name('edit');
        Route::put('/{proyek}', [ProyekController::class, 'update'])->name('update');
        Route::delete('/{proyek}', [ProyekController::class, 'destroy'])->name('destroy');
    });

    // Rute detail proyek admin
    Route::prefix('detailproyek')->name('detailproyek.')->group(function () {
        Route::get('/', [DetailProyekController::class, 'index'])->name('index')->middleware('can:manage-projects');
        Route::get('/create', [DetailProyekController::class, 'create'])->name('create')->middleware('can:manage-projects');
        Route::post('/', [DetailProyekController::class, 'store'])->name('store')->middleware('can:manage-projects');
        Route::get('/{id}/edit', [DetailProyekController::class, 'edit'])->name('edit')->middleware('can:manage-projects');
        Route::put('/{id}', [DetailProyekController::class, 'update'])->name('update')->middleware('can:manage-projects');
        Route::delete('/{id}', [DetailProyekController::class, 'destroy'])->name('destroy')->middleware('can:manage-projects');
    });

    // Rute pengiriman admin
    Route::resource('pengiriman', PengirimanController::class)->names([
        'index' => 'pengiriman.index',
        'create' => 'pengiriman.create',
        'store' => 'pengiriman.store',
        'edit' => 'pengiriman.edit',
        'update' => 'pengiriman.update',
        'destroy' => 'pengiriman.destroy'
    ]);
});

// Import file auth
require __DIR__ . '/auth.php';
