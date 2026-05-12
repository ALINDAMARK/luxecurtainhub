<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogPostController;
use App\Http\Controllers\Api\ContactInquiryController;
use App\Http\Controllers\Api\OrderController as OrderApiController;
use App\Http\Controllers\Api\ProductController as ProductApiController;
use App\Http\Controllers\Api\SiteImageController;
use App\Http\Controllers\Api\SuccessStoryController;
use App\Http\Middleware\RequireAdminKey;
use App\Http\Controllers\ConsultationController;

Route::get('/products', [ProductApiController::class, 'index']);
Route::get('/products/{product}', [ProductApiController::class, 'show']);
Route::post('/orders', [OrderApiController::class, 'store']);
Route::post('/consultations', [ConsultationController::class, 'store']);
Route::get('/blog-posts', [BlogPostController::class, 'index']);
Route::get('/success-stories', [SuccessStoryController::class, 'index']);
Route::get('/site-images/{slot}', [SiteImageController::class, 'show']);

Route::middleware(RequireAdminKey::class)->prefix('admin')->group(function () {
    Route::apiResource('products', ProductApiController::class);
    Route::apiResource('blog-posts', BlogPostController::class);
    Route::apiResource('success-stories', SuccessStoryController::class);
    Route::apiResource('site-images', SiteImageController::class)->except(['show']);
    Route::get('orders', [OrderApiController::class, 'index']);
    Route::get('consultations', [ContactInquiryController::class, 'index']);
});
