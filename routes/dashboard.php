<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;

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
});



//Another way to define groups
//Route::middleware('auth')->as('dashboard')->prefix('dashboard')->group(function (){
//
//})
