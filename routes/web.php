<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\CurrencyController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\Front\Auth\TwoFactorAuthController;


Route::get('/', [HomeController::class , 'index'])
    ->name('home');
Route::get('/products' , [ProductsController::class , 'index'])
    ->name('products.index');

// when laravel get this product it will do this Product::where('slug' = $slug)
Route::get('/products/{product:slug}' , [ProductsController::class , 'show'])->name('products.show');

Route::resource('cart' ,CartController::class);

Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');
Route::post('checkout', [CheckoutController::class, 'store']);

Route::get('auth/user/2fa', [TwoFactorAuthController::class, 'index'])->name('front.2fa');
Route::post('currency', [CurrencyController::class, 'store'])->name('currency.store');


//require __DIR__ . '/auth.php';           // breeze routes
require __DIR__ . '/dashboard.php';
require __DIR__.'/vendor.php';
