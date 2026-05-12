<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::post('/consultation', [ConsultationController::class, 'store'])->name('consultation.store');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

Route::prefix('admin')->name('admin.')->group(function () {
	Route::get('/login', [AdminController::class, 'loginForm'])->name('login');
	Route::post('/login', [AdminController::class, 'login'])->name('login.attempt');
	Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

	Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
	Route::get('/{section}', [AdminController::class, 'index'])->name('index');
	Route::get('/{section}/create', [AdminController::class, 'create'])->name('create');
	Route::post('/{section}', [AdminController::class, 'store'])->name('store');
	Route::get('/{section}/{id}/edit', [AdminController::class, 'edit'])->name('edit');
	Route::match(['put', 'patch'], '/{section}/{id}', [AdminController::class, 'update'])->name('update');
	Route::delete('/{section}/{id}', [AdminController::class, 'destroy'])->name('destroy');
});

