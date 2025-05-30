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
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
// login
//Login
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/', [companyProfile::class, 'index']);
Route::get('/ujiCoba', [companyProfile::class, 'ujiCoba']);
Route::get('/berita', [companyProfile::class, 'berita']);
Route::get('/detail', [companyProfile::class, 'detail']);
Route::get('/kontak', [companyProfile::class, 'kontak']);
Route::get('/layanan', [companyProfile::class, 'layanan']);
Route::get('/portofolio', [companyProfile::class, 'portofolio']);
Route::get('/struktur', [companyProfile::class, 'struktur']);

// khusus admin
// Route::get('/login', [DashboardController::class, 'login']);

// Route::get('/dashboard/homePerusahaan', [PerusahaanController::class, 'index']);
Route::get('/dashboard/profile', [profileController::class, 'index']);
// Khusus Admin
// Route::get('/dashboard/admin', [AdminController::class, 'index']);
// Route::get('/dashboard/createAkun', [AdminController::class, 'create']);
// Route::get('/dashboard/akunAdmin', [AdminController::class, 'index']);
// Route::get('/dashboard/admin/edit', [AdminController::class, 'edit'])->name('admin');
// // Khusus Partner
// Route::get('/dashboard/homePartner', [PartnerController::class, 'index']);
// Route::get('/dashboard/createPartner', [PartnerController::class, 'create']);
// Route::get('/dashboard/partner/edit', [PartnerController::class, 'edit'])->name('partner');

// // Route::get('/dashboard/perusahaan/edit', [PerusahaanController::class, 'edit'])->name('perusahaan');
// // Khusus berita
// Route::get('/dashboard/homeBerita', [BeritaController::class, 'index']);
// Route::get('/dashboard/berita', [BeritaController::class, 'create']);
// Route::get('/dashboard/berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
// Route::put('/dashboard/berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');
// // Khusus Layanan
// Route::get('/dashboard/homeLayanan', [LayananController::class, 'index']);
// Route::get('/dashboard/createLayanan', [LayananController::class, 'create']);
// Route::get('/dashboard/layanan/edit', [LayananController::class, 'edit'])->name('layanan');
// // Khusus Portofolio
// Route::get('/dashboard/homePortofolio', [PortofolioController::class, 'index']);
// Route::get('/dashboard/createPortofolio', [PortofolioController::class, 'create']);
// Route::get('/dashboard/portofolio/edit', [PortofolioController::class, 'edit'])->name('portofolio');
// // Khusus Banner
// Route::get('/dashboard/homeBanner', [BannerController::class, 'index']);

// // Khusus FAQ
// Route::get('/dashboard/homeFaq', [FaqController::class, 'index']);
// Route::get('/dashboard/faq/create', [FaqController::class, 'create'])->name('faq.create');
// Route::post('/dashboard/faq', [FaqController::class, 'store'])->name('faq.store');
// Route::get('/dashboard/faq/{faq}/edit', [FaqController::class, 'edit'])->name('faq.edit');
// Route::put('/dashboard/faq/{faq}', [FaqController::class, 'update'])->name('faq.update');
// Route::delete('/dashboard/faq/{faq}', [FaqController::class, 'destroy'])->name('faq.destroy');

// // Khusus Email
// Route::get('/dashboard/homeEmail', [EmailController::class, 'index']);
// Route::get('/dashboard/email', [EmailController::class, 'create']);
// Route::get('/dashboard/email/{email}/edit', [EmailController::class, 'edit'])->name('email.edit');
// Route::put('/dashboard/email/{email}', [EmailController::class, 'update'])->name('email.update');

//admin
// Khusus perusahaan
Route::get('/login', [LoginController::class, 'index'])->middleware('guest:admin')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:admin');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth:admin');
Route::resource('/dashboard/perusahaan', PerusahaanController::class)->middleware('auth:admin');
Route::resource('/dashboard/akunAdmin', AdminController::class)->middleware('auth:admin');
Route::resource('/dashboard/partner', PartnerController::class)->middleware('auth:admin');
Route::resource('/dashboard/berita', BeritaController::class)->middleware('auth:admin');
Route::resource('/dashboard/layanan', LayananController::class)->middleware('auth:admin');
Route::resource('/dashboard/portofolio', PortofolioController::class)->middleware('auth:admin');
Route::resource('/dashboard/banner', BannerController::class)->middleware('auth:admin');
Route::resource('/dashboard/faq', FaqController::class)->middleware('auth:admin');
Route::resource('/dashboard/email', EmailController::class)->middleware('auth:admin');

// admin
// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth:admin');
// Route::resource('/dashboard/perusahaan', PerusahaanController::class);
// Route::resource('/dashboard/akunAdmin', AdminController::class);
// Route::resource('/dashboard/partner', PartnerController::class);
// Route::resource('/dashboard/berita', BeritaController::class);
// Route::resource('/dashboard/layanan', LayananController::class);
// Route::resource('/dashboard/portofolio', PortofolioController::class);
// Route::resource('/dashboard/banner', BannerController::class);
// Route::resource('/dashboard/faq', FaqController::class);
// Route::resource('/dashboard/email', EmailController::class);
