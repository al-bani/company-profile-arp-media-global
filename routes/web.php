<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
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
Route::get('/homePerusahaan', [PerusahaanController::class, 'index']);
Route::get('/profile', [profileController::class, 'index']);
// Khusus Admin
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/createAkun', [AdminController::class, 'create']);
Route::get('/akunAdmin', [AdminController::class, 'index']);
Route::get('/admin/edit', [AdminController::class, 'edit'])->name('admin');
// Khusus Partner
Route::get('/homePartner', [PartnerController::class, 'index']);
Route::get('/createPartner', [PartnerController::class, 'create']);
Route::get('/partner/edit', [PartnerController::class, 'edit'])->name('partner');
// Khusus perusahaan
Route::get('/perusahaan', [PerusahaanController::class, 'tambah'])->name('perusahaan');
Route::get('/perusahaan/edit', [PerusahaanController::class, 'edit'])->name('perusahaan');
// Khusus berita
Route::get('/homeBerita', [BeritaController::class, 'index']);
Route::get('/berita', [BeritaController::class, 'create']);
Route::get('/berita/edit', [BeritaController::class, 'edit'])->name('berita');
// Khusus Layanan
Route::get('/homeLayanan', [LayananController::class, 'index']);
Route::get('/createLayanan', [LayananController::class, 'create']);
Route::get('/layanan/edit', [LayananController::class, 'edit'])->name('layanan');
// Khusus Portofolio
Route::get('/homePortofolio', [PortofolioController::class, 'index']);
Route::get('/createPortofolio', [PortofolioController::class, 'create']);
Route::get('/portofolio/edit', [PortofolioController::class, 'edit'])->name('portofolio');
// Khusus Banner
Route::get('/homeBanner', [BannerController::class, 'index']);
