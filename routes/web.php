<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HealthServiceController;
use App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Website Informasi SIP-Kes
|--------------------------------------------------------------------------
*/

// ==================== HALAMAN PUBLIK ====================
Route::get('/', [PublicController::class, 'index'])->name('public.home');
Route::get('/informasi', [PublicController::class, 'informations'])->name('public.informations');
Route::get('/informasi/{slug}', [PublicController::class, 'informationDetail'])->name('public.information.detail');
Route::get('/faskes', [PublicController::class, 'services'])->name('public.services');
Route::get('/kontak', [PublicController::class, 'contact'])->name('public.contact');
Route::post('/kontak', [PublicController::class, 'storeContact'])->name('public.contact.store');

// ==================== AUTENTIKASI ADMIN ====================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ==================== PANEL ADMINISTRATOR ====================
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Informasi Kesehatan
    Route::resource('informations', InformationController::class);

    // CRUD Kategori
    Route::resource('categories', CategoryController::class)->except(['create', 'show', 'edit']);

    // CRUD Fasilitas Kesehatan
    Route::resource('services', HealthServiceController::class);

    // Manajemen Pesan Publik
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{id}/reply', [MessageController::class, 'reply'])->name('messages.reply');
    Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');

    // Profil & Pengaturan Sistem Dinamis
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/settings', [ProfileController::class, 'updateSettings'])->name('settings.update');
});
