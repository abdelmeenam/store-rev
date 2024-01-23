<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;

Route::group([ 'middleware' => ['auth:admin' , 'verified'] ,  'prefix' => 'admin/dashboard', 'as' => 'dashboard.'] , function () {
    //-------Profile
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');


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
    Route::get('/products/trash', [ProductsController::class , 'trash'])
        ->name('products.trash');
    Route::post('/products/{id}/restore', [ProductsController::class,'restore'])
        ->name('products.restore');
    Route::delete('/products/{id}/force-delete', [ProductsController::class,'forceDelete'])
        ->name('products.force-delete');

    Route::resource('/products', ProductsController::class);

});



//Another way to define groups
//Route::middleware('auth')->as('dashboard')->prefix('dashboard')->group(function (){
//
//})
