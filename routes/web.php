<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\BidangPerusahaanController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\JenisMagangController;

//mahasiswa
use App\Http\Controllers\LowonganMahasiswaController;
use App\Http\Controllers\ProfilMahasiswaController;
use App\Http\Controllers\MonitoringMahasiswaController;
use App\Http\Controllers\PengajuanMahasiswaController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index']);
// Route::middleware(['auth','verified'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });
    // HANYA ADMIN
    Route::middleware('auth','role:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // PROFILE(dari breeze)
        Route::prefix('profile')->group(function () {
            Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });

        // MANAJEMEN DATA
        Route::prefix('pengguna')->group(function () {
            Route::get('/', [PenggunaController::class, 'index'])->name('admin.pengguna.index');
            Route::get('/create', [PenggunaController::class, 'create'])->name('admin.pengguna.create');
            Route::post('/store', [PenggunaController::class, 'store'])->name('admin.pengguna.store');
            Route::get('/{id}', [PenggunaController::class, 'show'])->name('admin.pengguna.show');
            Route::get('/edit/{id}', [PenggunaController::class, 'edit'])->name('admin.pengguna.edit');
            Route::put('/update/{id}', [PenggunaController::class, 'update'])->name('admin.pengguna.update');
            Route::delete('/delete/{id}', [PenggunaController::class, 'destroy'])->name('admin.pengguna.destroy');
        });

        Route::prefix('perusahaan')->name('admin.perusahaan.')->group(function () {
            Route::get('/', [PerusahaanController::class, 'index'])->name('index');
            Route::get('/create', [PerusahaanController::class, 'create'])->name('create');
            Route::post('/', [PerusahaanController::class, 'store'])->name('store');
            Route::get('/{id}', [PerusahaanController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [PerusahaanController::class, 'edit'])->name('edit');
            Route::put('/{id}', [PerusahaanController::class, 'update'])->name('update');
            Route::delete('/{id}', [PerusahaanController::class, 'destroy'])->name('destroy');
        });
        
        Route::prefix('bidang_perusahaan')->name('admin.bidang_perusahaan.')->group(function () {
            Route::get('/', [BidangPerusahaanController::class, 'index'])->name('index');
            Route::get('/create', [BidangPerusahaanController::class, 'create'])->name('create');
            Route::post('/', [BidangPerusahaanController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [BidangPerusahaanController::class, 'edit'])->name('edit');
            Route::put('/{id}', [BidangPerusahaanController::class, 'update'])->name('update');
            Route::delete('/{id}', [BidangPerusahaanController::class, 'destroy'])->name('destroy');
        });
        

        Route::prefix('lowongan')->name('admin.lowongan.')->group(function () {
            Route::get('/', [LowonganController::class, 'index'])->name('index');
            Route::get('/create', [LowonganController::class, 'create'])->name('create');
            Route::post('/', [LowonganController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [LowonganController::class, 'edit'])->name('edit');
            Route::put('/{id}', [LowonganController::class, 'update'])->name('update');
            Route::delete('/{id}', [LowonganController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('jenismagang')->name('jenismagang.')->group(function () {
            Route::get('/', [JenisMagangController::class, 'index'])->name('index');
            Route::get('/create', [JenisMagangController::class, 'create'])->name('create');
            Route::post('/', [JenisMagangController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [JenisMagangController::class, 'edit'])->name('edit');
            Route::put('/{id}', [JenisMagangController::class, 'update'])->name('update');
            Route::delete('/{id}', [JenisMagangController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('skill')->name('skill.')->group(function () {
            Route::get('/', [SkillController::class, 'index'])->name('index');
            Route::get('/create', [SkillController::class, 'create'])->name('create');
            Route::post('/', [SkillController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [SkillController::class, 'edit'])->name('edit');
            Route::put('/{id}', [SkillController::class, 'update'])->name('update');
            Route::delete('/{id}', [SkillController::class, 'destroy'])->name('destroy');
        });
        // // MANAJEMEN MAGANG
        Route::prefix('periode')->group(function () {
            Route::get('/', [PeriodeController::class, 'index'])->name('admin.periode.index');
            Route::get('/create', [PeriodeController::class, 'create'])->name('admin.periode.create');
            Route::post('/', [PeriodeController::class, 'store'])->name('admin.periode.store');
            Route::get('/{id}/edit', [PeriodeController::class, 'edit'])->name('admin.periode.edit');
            Route::put('/{id}', [PeriodeController::class, 'update'])->name('admin.periode.update');
            Route::delete('/{id}', [PeriodeController::class, 'destroy'])->name('admin.periode.destroy');
        });

         Route::prefix('programstudi')->name('programstudi.')->group(function () {
            Route::get('/', [ProgramStudiController::class, 'index'])->name('index');
            Route::get('/create', [ProgramStudiController::class, 'create'])->name('create');
            Route::post('/', [ProgramStudiController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ProgramStudiController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ProgramStudiController::class, 'update'])->name('update');
            Route::delete('/{id}', [ProgramStudiController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('pengajuan')->group(function () {
            Route::get('/', [PengajuanController::class, 'index'])->name('admin.pengajuan.index');
            Route::get('/{id}/edit', [PengajuanController::class, 'edit'])->name('admin.pengajuan.edit');
            Route::put('/{id}', [PengajuanController::class, 'update'])->name('admin.pengajuan.update');
        });

        Route::prefix('statistik')->group(function () {
            Route::get('/', [StatistikController::class, 'index'])->name('statistik.index');
        });

    });

    // HANYA DOSEN
    Route::middleware('auth','role:dosen_pembimbing')->group(function () {
        Route::get('/dashboard/dosen', [DashboardController::class, 'dosen'])->name('dashboard.dosen');
        // PROFILE(dari breeze)
        Route::prefix('profile')->group(function () {
            Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });

        


    });
     // HANYA MAHASISWA
    Route::middleware('auth','role:mahasiswa')->group(function () {
        Route::get('/dashboard/mahasiswa', [DashboardController::class, 'mahasiswa'])->name('dashboard.mahasiswa');
        // PROFILE(dari breeze)
        // Route::prefix('profil')->name('mahasiswa.profil.')->group(function () {
        //     Route::get('/', [ProfileController::class, 'index'])->name('index');
        //     Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        //     Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        //     Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
        // });

        Route::prefix('profil')->name('mahasiswa.profil.')->group(function () {
            Route::get('/mahasiswa', [profilMahasiswaController::class, 'index'])->name('index');
        });

        Route::prefix('lowongan')->name('mahasiswa.lowongan.')->group(function () {
            Route::get('/mahasiswa', [LowonganMahasiswaController::class, 'index'])->name('index');
            Route::get('/mahasiswa/{id}', [LowonganMahasiswaController::class, 'show'])->name('show');
        });

        Route::prefix('pengajuan')->name('mahasiswa.pengajuan.')->group(function () {
            Route::get('/mahasiswa', [PengajuanMahasiswaController::class, 'index'])->name('index');
        });

        Route::prefix('monitoring')->name('mahasiswa.monitoring.')->group(function () {
            Route::get('/mahasiswa', [MonitoringMahasiswaController::class, 'index'])->name('index');
        });
    });

require __DIR__.'/auth.php';
