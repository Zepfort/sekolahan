<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\GuruController;
use App\Http\Controllers\Api\MapelController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\SiswaController;
use App\Http\Controllers\Api\JadwalController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);    // Route login
Route::post('/register', [AuthController::class, 'register']);    // Route register

Route::middleware('jwt.verify')->group(function () {  // Middleware
    Route::post('/logout', [AuthController::class, 'logout']);  // Route logout
    Route::get('/profile', [AuthController::class, 'profile']); // Route profile
    Route::apiResource('users', UserController::class);
    Route::apiResource('guru', GuruController::class);
    Route::apiResource('mapel', MapelController::class);
    Route::apiResource('kelas', KelasController::class)->parameters([
        'kelas' => 'kelas'
    ]);
    Route::apiResource('siswa', SiswaController::class);
    Route::apiResource('jadwal', JadwalController::class);
});
