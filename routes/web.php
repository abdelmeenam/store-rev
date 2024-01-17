<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductsController;


Route::get('/', [HomeController::class , 'index'])
    ->name('home');

Route::get('/products' , [ProductsController::class , 'index'])
    ->name('products.index');

// when laravel get this product it will do this Product::where('slug' = $slug)
Route::get('/products/{product:slug}' , [ProductsController::class , 'show'])
    ->name('products.show');

Route::resource('cart' ,CartController::class);

require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
