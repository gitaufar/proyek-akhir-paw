<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\KuisController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/list_modul', [MainController::class, 'showLevel'])->name('list_modul.index');
Route::get('/community', [MainController::class, 'showComunity'])->name('community');
Route::get('/list_modul/materi', [MainController::class, 'showMateri'])->name('list_modul.materi');
Route::get('/materi/{id}', [MainController::class, 'getMateriAjax'])->name('materi');
Route::get('/kuis', [KuisController::class, 'showKuis'])->name('kuis');
Route::get('/api/jawaban/{idKuis}', [KuisController::class, 'getJawaban']);
Route::post('/api/jawaban', [KuisController::class, 'postJawaban']);

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/dashboard-admin', function () {
    return view('dashboard_admin');
})->middleware('auth');

use App\Http\Controllers\Admin\ModulController;

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/modul/create', [ModulController::class, 'create'])->name('modul.create');
    Route::post('/admin/modul', [ModulController::class, 'store'])->name('modul.store');
    Route::get('/admin/modul', [ModulController::class, 'index'])->name('modul.index');
    Route::get('/admin/modul/{id}/edit', [ModulController::class, 'edit'])->name('modul.edit');
    Route::put('/admin/modul/{id}', [ModulController::class, 'update'])->name('modul.update');
    Route::delete('/admin/modul/{id}', [ModulController::class, 'destroy'])->name('modul.destroy');
});
