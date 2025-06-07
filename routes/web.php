<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\KuisController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/list_modul', [MainController::class, 'showModul'])->name('list_modul.index');
Route::get('/community', [MainController::class, 'showComunity'])->name('community');
Route::get('/list_modul/materi', [MainController::class, 'showMateri'])->name('list_modul.materi');
Route::get('/materi/{id}', [MainController::class, 'getMateriAjax'])->name('materi');
Route::get('/kuis', [KuisController::class, 'showKuis'])->name('kuis');
Route::get('/api/jawaban/{idKuis}', [KuisController::class, 'getJawaban']);


Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/api/jawaban', [KuisController::class, 'postJawaban']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/dashboard-admin', function () {
    return view('dashboard_admin');
})->middleware('auth');
