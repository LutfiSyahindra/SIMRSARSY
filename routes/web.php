<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\simrs\display\apotekwsController;
use App\Http\Controllers\simrs\display\PoliController;
use App\Http\Controllers\simrs\display\PoliWsController;
use App\Http\Controllers\simrs\PetugasPanggil\poliPanggilController;
use App\Http\Controllers\simrs\Users\rolesController;
use App\Http\Controllers\simrs\Users\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('SIMRS.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::prefix('simrs')->group(function () {
        // Display Poli
        Route::get('/display/poli', [PoliController::class, 'index'])->name('display.poli');
        Route::get('/display/poli/data', [PoliController::class, 'data'])->name('display.poli.data');
        Route::get('/display/poli/lastdata', [PoliController::class, 'lastdata'])->name('display.poli.lastdata');
        Route::get('/display/poliws', [PoliWsController::class, 'index'])->name('display.poliws');

        // Display Apotek
        Route::get('/display/apotek', [apotekwsController::class, 'index'])->name('display.apotek');
        Route::get('/display/panggil-apotek', [apotekwsController::class, 'panggilAntrean'])->name('display.panggilapotek');
        Route::put('/display/update-apotek', [apotekwsController::class, 'updateAntrean'])->name('display.updateapotek');
        Route::get('/display/nonracikan', [apotekwsController::class, 'dataNonracikan'])->name('display.nonracikan');
        Route::get('/display/racikan', [apotekwsController::class, 'dataracikan'])->name('display.racikan');

        // petugasPanggil
        Route::get('/petugasPanggil/poliPanggil', [poliPanggilController::class, 'index'])->name('petugasPanggil.poliPanggil');
        Route::get('/petugasPanggil/getPoli', [poliPanggilController::class, 'getDataPoli'])->name('petugasPanggil.getPoli');
        Route::get('/petugasPanggil/getPasien', [poliPanggilController::class, 'getDataPasien'])->name('petugasPanggil.getPasien');
        Route::get('/petugasPanggil/getDokter', [poliPanggilController::class, 'getDataDokter'])->name('petugasPanggil.getDokter');
        Route::post('/petugasPanggil/panggilPasien', [poliPanggilController::class, 'panggilPasien'])->name('petugasPanggil.panggilPasien');

        // Users
        Route::get('/users/index', [UsersController::class, 'index'])->name('users.index');
        Route::get('/users/table', [UsersController::class, 'table'])->name('users.table');
        Route::post('/users/store', [UsersController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}/update', [UsersController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}/delete', [UsersController::class, 'destroy'])->name('users.delete');

        // Roles
        Route::get('/roles/index', [rolesController::class, 'index'])->name('roles.index');
        Route::get('/roles/table', [rolesController::class, 'table'])->name('roles.table');
        Route::post('/roles/store', [rolesController::class, 'store'])->name('roles.store');
        Route::get('/roles/{id}/edit', [rolesController::class, 'edit'])->name('roles.edit');
        Route::put('/roles/{id}/update', [rolesController::class, 'update'])->name('roles.update');
        Route::delete('/roles/{id}/delete', [rolesController::class, 'destroy'])->name('roles.delete');

    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
