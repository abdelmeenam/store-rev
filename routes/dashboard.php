<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\StoresController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\VendorsController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;

Route::group(['middleware' => ['auth:admin', 'verified'],  'prefix' => 'admin/dashboard', 'as' => 'dashboard.'], function () {
    //-------Profile
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');


    // Home Dashboard
    Route::get('/', [DashboardController::class, 'index'])
        ->name('home');

    // users routes
    Route::resource('/users', CategoriesController::class);

    // Categories
    Route::get('/categories/trash', [CategoriesController::class, 'trash'])->name('categories.trash');
    Route::get('/categories/{id}/restore', [CategoriesController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/{id}/force-delete', [CategoriesController::class, 'forceDelete'])->name('categories.force-delete');
    Route::resource('/categories', CategoriesController::class);

    // Products
    Route::get('/products/trash', [ProductsController::class, 'trash'])->name('products.trash');
    Route::post('/products/{id}/restore', [ProductsController::class, 'restore'])->name('products.restore');
    Route::delete('/products/{id}/force-delete', [ProductsController::class, 'forceDelete'])->name('products.force-delete');
    Route::resource('/products', ProductsController::class);


    // Stores
    Route::get('/stores/trash', [StoresController::class, 'trash'])->name('stores.trash');
    Route::post('/stores/{id}/restore', [StoresController::class, 'restore'])->name('stores.restore');
    Route::delete('/stores/{id}/force-delete', [StoresController::class, 'forceDelete'])->name('stores.force-delete');
    Route::resource('/stores', StoresController::class);


    // Vendors
    Route::get('/vendors/trash', [VendorsController::class, 'trash'])->name('vendors.trash');
    Route::post('/vendors/{id}/restore', [VendorsController::class, 'restore'])->name('vendors.restore');
    Route::delete('/vendors/{id}/force-delete', [VendorsController::class, 'forceDelete'])->name('vendors.force-delete');
    Route::resource('/vendors', VendorsController::class);
});



//Another way to define groups
//Route::middleware('auth')->as('dashboard')->prefix('dashboard')->group(function (){
//
//})