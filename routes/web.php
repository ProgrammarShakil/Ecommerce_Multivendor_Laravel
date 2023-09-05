<?php

use App\Http\Controllers\AdminDashboard\AdminController;
use App\Http\Controllers\AdminDashboard\CategoryController;
use App\Http\Controllers\AdminDashboard\ProductController;
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

Route::prefix('admin_dashboard')->namespace('AdminDashboard')->name('admin_dashboard.')->middleware(['admin'])->group(function () {
    Route::get('index', [AdminController::class, 'index'])->name('index');


    // Category Routes
    Route::get('categories/index', [CategoryController::class, 'index'])->name('category.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('categories/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('categories/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('categories/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('categories/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    // Product Routes
    Route::get('Products/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('Products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('Products/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('Products/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('Products/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('Products/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
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
