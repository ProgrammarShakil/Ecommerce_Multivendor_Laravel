<?php

use App\Http\Controllers\AdminDashboard\AdminController;
use App\Http\Controllers\adminLoginController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\UserDashboard\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes();

#------------------------- Start Admin Routes -----------------------#

Route::get('admin/login', [adminLoginController::class, 'adminLoginForm'])->name('admin_login_form');
Route::post('admin/login', [adminLoginController::class, 'adminLogin'])->name('admin_login');
Route::post('admin/logout', [adminLoginController::class, 'adminLogOut'])->name('admin_logout');

Route::prefix('admin_dashboard')->namespace('AdminDashboard')->name('admin_dashboard.')->middleware('admin')->group(function () {
    Route::get('index', [AdminController::class, 'index'])->name('index');
});

#---------------------- End Admin Routes -----------------------#


#----------------------- Start Frontend Routes -----------------------#

Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');

#----------------------- End Frontend Routes   -----------------------#


#----------------------- Start User Routes -----------------------#

Route::prefix('user_dashboard')->namespace('UserDashboard')->name('user_dashboard.')->middleware(['auth'])->group(function () {
    Route::get('/index', [UserController::class, 'index'])->name('index');
});

#----------------------- End User Routes   -----------------------#
