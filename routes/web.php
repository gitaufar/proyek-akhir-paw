<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;

Route::get('/list_modul', [MainController::class, 'showModul'])->name('list_modul');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Protected route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');
