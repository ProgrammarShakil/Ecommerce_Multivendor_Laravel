<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\authController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [authController::class, 'LoginForm'])->name('login');
Route::post('/login', [authController::class, 'ProcessLogin']);


Route::get('/register', [authController::class, 'RegisterForm'])->name('register');
Route::post('/register', [authController::class, 'ProcessRegister']);

Route::prefix('dashboard')->namespace('Admin')->middleware(['auth', 'admin'])->name('dashboard.')->group((function () {
    Route::get('/index', [DashboardController::class, 'dashboard'])->name('index');
}));
