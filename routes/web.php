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

//dosen
use App\Http\Controllers\ProfilDosenController;
use App\Http\Controllers\MahasiswaDosenController;
use App\Http\Controllers\MonitoringDosenController;


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
            Route::get('/{id}', [LowonganController::class, 'show'])->name('show');
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
        // Route::prefix('profile')->group(function () {
        //     Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        //     Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        //     Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
        // });

        Route::prefix('profil')->name('dosen.profil.')->group(function () {
            Route::get('/dosen', [profilDosenController::class, 'index'])->name('index');
                Route::get('/dosen', [ProfilDosenController::class, 'index'])->name('index');
                Route::get('/dosen/edit/{id}', [ProfilDosenController::class, 'edit'])->name('edit');
                Route::put('/dosen/update/{id}', [ProfilDosenController::class, 'update'])->name('update');
                Route::get('/dosen/edit_preferensi/{id}', [ProfilDosenController::class, 'editPreferensi'])->name('edit_preferensi');
                Route::put('/dosen/update_preferensi/{id}', [ProfilDosenController::class, 'updatePreferensi'])->name('update_preferensi');
        });

        Route::prefix('mahasiswa')->name('dosen.mahasiswa.')->group(function () {
            Route::get('/dosen', [MahasiswaDosenController::class, 'index'])->name('index');
            Route::get('/dosen/{id}', [MahasiswaDosenController::class, 'show'])->name('show');
        });

        Route::prefix('monitoring')->name('dosen.monitoring.')->group(function () {
            Route::get('/dosen', [MonitoringDosenController::class, 'index'])->name('index');
            Route::get('/dosen/{id}', [MonitoringDosenController::class, 'show'])->name('show');
            Route::get('/dosen/{id}/harian', [MonitoringDosenController::class, 'show_harian'])->name('show_harian');
            Route::get('/dosen/{id}/harian/{harian}/edit', [MonitoringDosenController::class, 'edit_harian'])->name('edit_harian');
            Route::get('/dosen/{id}/create', [MonitoringDosenController::class, 'create_feedback'])->name('create_feedback');
            Route::put('/dosen/{id}/update', [MonitoringDosenController::class, 'update_feedback'])->name('update_feedback');
        });


    });

     // HANYA MAHASISWA
    Route::middleware('auth','role:mahasiswa')->group(function () {
        Route::get('/dashboard/mahasiswa', [DashboardController::class, 'mahasiswa'])->name('dashboard.mahasiswa');

        // Route::get('profil/edit', [ProfilMahasiswaController::class, 'editProfil'])->name('profil.edit-profil');
        // Route::put('profil/update', [ProfilMahasiswaController::class, 'updateInformasi'])->name('profil.update-profil');
        // Route::get('preferensi/edit', [ProfilMahasiswaController::class, 'editPreferensi'])->name('preferensi.edit-prefensi');
        // Route::put('preferensi/update', [ProfilMahasiswaController::class, 'updatePreferensi'])->name('preferensi.update-prefensi');
        // PROFILE(dari breeze)                              
        // Route::prefix('profil')->name('mahasiswa.profil.')->group(function () {
        //     Route::get('/', [ProfileController::class, 'index'])->name('index');
        //     Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        //     Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        //     Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
        // });

        Route::prefix('profil')->name('mahasiswa.profil.')->group(function () {
            Route::get('/mahasiswa', [ProfilMahasiswaController::class, 'index'])->name('index');
            Route::get('/mahasiswa/edit/{id}', [ProfilMahasiswaController::class, 'edit'])->name('edit');
            Route::put('/mahasiswa/update/{id}', [ProfilMahasiswaController::class, 'update'])->name('update');
            Route::get('/mahasiswa/edit_preferensi/{id}', [ProfilMahasiswaController::class, 'editPreferensi'])->name('edit_preferensi');
            Route::put('/mahasiswa/update_preferensi/{id}', [ProfilMahasiswaController::class, 'updatePreferensi'])->name('update_preferensi');
        });

        Route::prefix('lowongan')->name('mahasiswa.lowongan.')->group(function () {
            Route::get('/mahasiswa/mahasiswa', [LowonganMahasiswaController::class, 'index'])->name('index');
            Route::get('/mahasiswa/{id}', [LowonganMahasiswaController::class, 'show'])->name('show');
        });

        Route::prefix('pengajuan')->name('mahasiswa.pengajuan.')->group(function () {
            Route::get('/mahasiswa', [PengajuanMahasiswaController::class, 'index'])->name('index');
            Route::get('/mahasiswa/{id}', [PengajuanMahasiswaController::class, 'show'])->name('show');
            Route::post('/mahasiswa/store', [PengajuanMahasiswaController::class, 'store'])->name('store');
        });

        Route::prefix('monitoring')->name('mahasiswa.monitoring.')->group(function () {
            Route::get('/mahasiswa', [MonitoringMahasiswaController::class, 'index'])->name('index');
            Route::get('/mahasiswa/create', [MonitoringMahasiswaController::class, 'create'])->name('create');
            Route::post('/mahasiswa/store', [MonitoringMahasiswaController::class, 'store'])->name('store');
            Route::get('/mahasiswa/{id}/show', [MonitoringMahasiswaController::class, 'show'])->name('show');
            Route::get('/mahasiswa/{id}/create_harian', [MonitoringMahasiswaController::class, 'create_harian'])->name('create_harian');
            Route::post('/mahasiswa/{id}/store_harian', [MonitoringMahasiswaController::class, 'store_harian'])->name('store_harian');
            Route::get('/mahasiswa/monitoring/{mingguan}/harian/{harian}/edit', [MonitoringMahasiswaController::class, 'edit_harian'])->name('edit_harian');
            Route::get('/mahasiswa/{mingguan}/harian/{harian}/detail', [MonitoringMahasiswaController::class, 'detail_harian'])->name('detail_harian');
            Route::put('/mahasiswa/{id}/update_harian', [MonitoringMahasiswaController::class, 'update_harian'])->name('update_harian');
            
        });
    });

require __DIR__.'/auth.php';
