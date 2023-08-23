<?php

use App\Http\Controllers\authController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [authController::class, 'LoginForm'])->name('login');
Route::post('/login', [authController::class, 'ProcessLogin']);

Route::get('/image-upload', [authController::class, 'ImageUPload'])->name('image-upload');
Route::post('/image-upload', [authController::class, 'ImageUPloadProcess']);

Route::get('/register', [authController::class, 'RegisterForm'])->name('register');
Route::post('/register', [authController::class, 'ProcessRegister']);
