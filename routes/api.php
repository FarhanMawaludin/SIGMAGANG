<?php

use App\Http\Controllers\Api\JenisMagangController;
use App\Http\Controllers\Api\PeriodeController;
use App\Http\Controllers\Api\PerushaanController;
use App\Http\Controllers\Api\ProdiController;
use App\Http\Controllers\Api\SkillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/prodi', [ProdiController::class, 'index']);
    Route::post('/prodi', [ProdiController::class, 'store']);
    Route::get('/prodi/{prodi}', [ProdiController::class, 'show']);
    Route::put('/prodi/{prodi}', [ProdiController::class, 'update']);
    Route::delete('/prodi/{prodi}', [ProdiController::class, 'destroy']);

    Route::get('/periode', [PeriodeController::class, 'index']);
    Route::post('/periode', [PeriodeController::class, 'store']);
    Route::get('/periode/{periode}', [PeriodeController::class, 'show']);
    Route::put('/periode/{periode}', [PeriodeController::class, 'update']);
    Route::delete('/periode/{periode}', [PeriodeController::class, 'destroy']);

    Route::get('/jenismagang', [JenisMagangController::class, 'index']);
    Route::post('/jenismagang', [JenisMagangController::class, 'store']);
    Route::get('/jenismagang/{jenisMagang}', [JenisMagangController::class, 'show']);
    Route::put('/jenismagang/{jenisMagang}', [JenisMagangController::class, 'update']);
    Route::delete('/jenismagang/{jenisMagang}', [JenisMagangController::class, 'destroy']);
    
    Route::get('/perusahaan', [PerushaanController::class, 'index']);
    Route::post('/perusahaan', [PerushaanController::class, 'store']);
    Route::get('/perusahaan/{perusahaan}', [PerushaanController::class, 'show']);
    Route::put('/perusahaan/{perusahaan}', [PerushaanController::class, 'update']);
    Route::delete('/perusahaan/{perusahaan}', [PerushaanController::class, 'destroy']);

    Route::get('/skill', [SkillController::class, 'index']);
    Route::post('/skill', [SkillController::class, 'store']);
    Route::get('/skill/{skill}', [SkillController::class, 'show']);
    Route::put('/skill/{skill}', [SkillController::class, 'update']);
    Route::delete('/skill/{skill}', [SkillController::class, 'destroy']);
});