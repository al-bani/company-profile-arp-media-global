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
use App\Http\Controllers\companyProfile;
use App\Models\admin;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [companyProfile::class, 'index']);
Route::get('/berita', [companyProfile::class, 'berita']);
Route::get('/detail', [companyProfile::class, 'detail']);
Route::get('/kontak', [companyProfile::class, 'kontak']);
Route::get('/layanan', [companyProfile::class, 'layanan']);
Route::get('/portofolio', [companyProfile::class, 'portofolio']);
Route::get('/struktur', [companyProfile::class, 'struktur']);

// khusus admin
Route::get('/login', [DashboardController::class, 'login']);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/dashboard/homePerusahaan', [PerusahaanController::class, 'index']);
Route::get('/dashboard/profile', [profileController::class, 'index']);
// Khusus Admin
Route::get('/dashboard/admin', [AdminController::class, 'index']);
Route::get('/dashboard/createAkun', [AdminController::class, 'create']);
Route::get('/dashboard/akunAdmin', [AdminController::class, 'index']);
Route::get('/dashboard/admin/edit', [AdminController::class, 'edit'])->name('admin');
// Khusus Partner
Route::get('/dashboard/homePartner', [PartnerController::class, 'index']);
Route::get('/dashboard/createPartner', [PartnerController::class, 'create']);
Route::get('/dashboard/partner/edit', [PartnerController::class, 'edit'])->name('partner');

// Route::get('/dashboard/perusahaan/edit', [PerusahaanController::class, 'edit'])->name('perusahaan');
// Khusus berita
Route::get('/dashboard/homeBerita', [BeritaController::class, 'index']);
Route::get('/dashboard/berita', [BeritaController::class, 'create']);
Route::get('/dashboard/berita/edit', [BeritaController::class, 'edit'])->name('berita');
// Khusus Layanan
Route::get('/dashboard/homeLayanan', [LayananController::class, 'index']);
Route::get('/dashboard/createLayanan', [LayananController::class, 'create']);
Route::get('/dashboard/layanan/edit', [LayananController::class, 'edit'])->name('layanan');
// Khusus Portofolio
Route::get('/dashboard/homePortofolio', [PortofolioController::class, 'index']);
Route::get('/dashboard/createPortofolio', [PortofolioController::class, 'create']);
Route::get('/dashboard/portofolio/edit', [PortofolioController::class, 'edit'])->name('portofolio');
// Khusus Banner
Route::get('/dashboard/homeBanner', [BannerController::class, 'index']);

//admin
// Khusus perusahaan
Route::resource('/dashboard/perusahaan', PerusahaanController::class);
Route::resource('/dashboard/akunAdmin', AdminController::class);
Route::resource('/dashboard/partner', PartnerController::class);
Route::resource('/dashboard/berita', BeritaController::class);
Route::resource('/dashboard/layanan', LayananController::class);
Route::resource('/dashboard/portofolio', PortofolioController::class);
Route::resource('/dashboard/banner', BannerController::class);