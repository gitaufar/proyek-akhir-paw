<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\Admin\ModulController;

// =====================
// Halaman Awal
// =====================
Route::get('/', function () {
    return view('login');
});

// =====================
// Autentikasi
// =====================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// =====================
// Dashboard (Autentikasi Diperlukan)
// =====================
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/dashboard-admin', function () {
        return view('dashboard_admin');
    });

    // Akurasi Kuis
    Route::get('/api/akurasi/{modulId}', [KuisController::class, 'getAkurasi'])->name('akurasi');
    Route::post('/api/quiz-selesai', [KuisController::class, 'postQuizSelesai']);

    // Modul (Admin)
    Route::prefix('admin/modul')->name('modul.')->group(function () {
        Route::get('/', [ModulController::class, 'index'])->name('index');
        Route::get('/create', [ModulController::class, 'create'])->name('create');
        Route::post('/', [ModulController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ModulController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ModulController::class, 'update'])->name('update');
        Route::delete('/{id}', [ModulController::class, 'destroy'])->name('destroy');
    });
});

// =====================
// Modul & Materi
// =====================
Route::get('/list_modul', [MainController::class, 'showLevel'])->name('list_modul.index');
Route::get('/list_modul/materi', [MainController::class, 'showMateri'])->name('list_modul.materi');
Route::get('/materi/{id}', [MainController::class, 'getMateriAjax'])->name('materi');

// =====================
// Kuis
// =====================
Route::get('/kuis', [KuisController::class, 'showKuis'])->name('kuis');
Route::get('/api/jawaban/{idKuis}', [KuisController::class, 'getJawaban']);
Route::post('/api/jawaban', [KuisController::class, 'postJawaban']);

// =====================
// Komunitas
// =====================
Route::get('/community', [MainController::class, 'showComunity'])->name('community');