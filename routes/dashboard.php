<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Models\Product;

Route::group(['middleware' => ['auth' , 'verified'], 'prefix' => 'dashboard', 'as' => 'dashboard.'], function () {

    // Home Dashboard
    Route::get('/', [DashboardController::class, 'index'])
        ->name('home');

    // users routes
    Route::resource('/users', CategoriesController::class);

    // Categories
    Route::get('/categories/trash', [CategoriesController::class , 'trash'])
        ->name('categories.trash');
    Route::get('/categories/{id}/restore', [CategoriesController::class,'restore'])
        ->name('categories.restore');
    Route::delete('/categories/{id}/force-delete', [CategoriesController::class,'forceDelete'])
        ->name('categories.force-delete');
    Route::resource('/categories', CategoriesController::class);

    // products
    Route::resource('/products', ProductsController::class);
    Route::get('/products/trash', [ProductsController::class , 'trash'])
        ->name('products.trash');
    Route::get('/products/{id}/restore', [ProductsController::class,'restore'])
        ->name('products.restore');
    Route::delete('/products/{id}/force-delete', [ProductsController::class,'forceDelete'])
        ->name('products.force-delete');
    Route::resource('/products', ProductsController::class);
});



//Another way to define groups
//Route::middleware('auth')->as('dashboard')->prefix('dashboard')->group(function (){
//
//})
