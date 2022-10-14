<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasKeluarController;
use App\Http\Controllers\KasMasukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Ketika sudah login
Route::group(['middleware' => 'auth'], function () {

    // logout dan dashboard
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'main'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'main'])->name('dashboard');
    Route::get('/user/status/{id}', [UserController::class, 'status'])->name('change-status');
    Route::group(['middleware' => 'isAdmin'], function () {
        //User
        Route::resource('/user', UserController::class)->names([
            'index' => 'user',
            'store' => 'store-user',
            'update' => 'update-user',
            'destroy' => 'destroy-user',
        ]);

        // Kas masuk
        Route::resource('/kas-masuk', KasMasukController::class)->names([
            'index' => 'kas-masuk',
            'create' => 'create-kas-masuk',
            'store' => 'store-kas-masuk',
            'edit' => 'edit-kas-masuk',
            'update' => 'update-kas-masuk',
            'destroy' => 'destroy-kas-masuk',
            'show' => 'show-kas-masuk',
        ]);

        // Kas keluar
        Route::resource('/kas-keluar', KasKeluarController::class)->names([
            'index' => 'kas-keluar',
            'create' => 'create-kas-keluar',
            'store' => 'store-kas-keluar',
            'edit' => 'edit-kas-keluar',
            'update' => 'update-kas-keluar',
            'destroy' => 'destroy-kas-keluar',
            'show' => 'show-kas-keluar',
        ]);
    });

    Route::get('/laporan-masuk', [LaporanController::class, 'masuk'])->name('laporan-masuk');
    Route::get('/laporan-keluar', [LaporanController::class, 'keluar'])->name('laporan-keluar');
    Route::get('/laporan-masuk-print', [LaporanController::class, 'printMasuk'])->name('laporan-masuk-print');
    Route::get('/laporan-keluar-print', [LaporanController::class, 'printKeluar'])->name('laporan-keluar-print');
});

// Ketika belum login
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'checkLogin'])->name('check-login');
});
