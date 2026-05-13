<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::post('/consultation', [ConsultationController::class, 'store'])->name('consultation.store');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

Route::get('/robots.txt', function () {
	$content = "User-agent: *\nAllow: /\n\nSitemap: " . route('sitemap.xml');

	return response($content, 200)
		->header('Content-Type', 'text/plain; charset=UTF-8');
})->name('robots.txt');

Route::get('/sitemap.xml', function () {
	$urls = collect([
		route('home'),
		route('products'),
	]);

	$xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
	$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

	foreach ($urls as $url) {
		$xml .= '<url><loc>' . e($url) . '</loc><changefreq>weekly</changefreq><priority>0.8</priority></url>';
	}

	$xml .= '</urlset>';

	return response($xml, 200)
		->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('sitemap.xml');

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

