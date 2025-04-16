<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerusahaanController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index']);
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/homePerusahaan', [PerusahaanController::class, 'index']);
Route::get('/coba', [PerusahaanController::class, 'coba']);
Route::get('/perusahaan', [PerusahaanController::class, 'tambah'])->name('perusahaan');
