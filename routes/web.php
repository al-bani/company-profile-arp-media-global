<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PortofolioController;
use App\Models\admin;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index']);
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/homePerusahaan', [PerusahaanController::class, 'index']);
Route::get('/akunAdmin', [AdminController::class, 'index']);
Route::get('/createAkun', [AdminController::class, 'create']);
Route::get('/homePartner', [PartnerController::class, 'index']);
Route::get('/createPartner', [PartnerController::class, 'create']);
Route::get('/profile', [profileController::class, 'index']);
Route::get('/perusahaan', [PerusahaanController::class, 'tambah'])->name('perusahaan');
Route::get('/homeBerita', [BeritaController::class, 'index']);
Route::get('/berita', [BeritaController::class, 'create']);
Route::get('/homeLayanan', [LayananController::class, 'index']);
Route::get('/createLayanan', [LayananController::class, 'create']);
Route::get('/homePortofolio', [PortofolioController::class, 'index']);
Route::get('/createPortofolio', [PortofolioController::class, 'create']);

