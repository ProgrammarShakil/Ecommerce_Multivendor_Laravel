<?php

use App\Http\Controllers\AdminDashboard\AdminDashboardController;
use App\Http\Controllers\AdminDashboard\CategoryController;
use App\Http\Controllers\AdminDashboard\ProductController;
use App\Http\Controllers\adminLoginController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\UserDashboard\BlogController;
use App\Http\Controllers\UserDashboard\RolePermissionController;
use App\Http\Controllers\UserDashboard\UserController;
use App\Http\Controllers\UserDashboard\UserDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes();

#------------------------- Start Admin Routes -----------------------#

Route::get('admin/login', [adminLoginController::class, 'adminLoginForm'])->name('admin_login_form');
Route::post('admin/login', [adminLoginController::class, 'adminLogin'])->name('admin_login');

Route::post('admin/logout', [adminLoginController::class, 'adminLogOut'])->name('admin_logout');

Route::prefix('admin_dashboard')->name('admin_dashboard.')->middleware(['admin'])->group(function () {
    Route::get('index', [AdminDashboardController::class, 'index'])->name('index');


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
Route::get('/shop', [FrontendController::class, 'shop'])->name('frontend.shop');
Route::get('/shop/details', [FrontendController::class, 'shopDetails'])->name('frontend.shop_details');
Route::get('/cart', [FrontendController::class, 'cart'])->name('frontend.cart');
Route::get('/checkout', [FrontendController::class, 'checkout'])->name('frontend.checkout');
Route::get('/contact', [FrontendController::class, 'contact'])->name('frontend.contact');
Route::get('/categories/{id}', [FrontendController::class, 'categories'])->name('frontend.categories');

Route::get('verify/{token}', [FrontendController::class, 'userVerification'])->name('verify');

#----------------------- End Frontend Routes   -----------------------#


#----------------------- Start User Routes -----------------------#

Route::prefix('user_dashboard')->name('user_dashboard.')->middleware(['auth'])->group(function () {
    Route::get('/index', [UserDashboardController::class, 'index'])->name('index');

    // Blog Routes
    Route::get('/blog/index', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');

    // Role Permission Routes
    Route::resource('/role_permission', RolePermissionController::class)->names('role_permission');

    // User Routes
    Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
});

#----------------------- End User Routes   -----------------------#
