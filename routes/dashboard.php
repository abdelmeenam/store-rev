<?php
use App\Http\Controllers\Dashboard\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;

Route::group(['middleware' => ['auth', 'verified'] , 'prefix' => 'dashboard','as' => 'dashboard.'], function () {

    // Home Dashboard
    Route::get('/',[DashboardController::class , 'index'] )
        ->name('home');

    // Categories
    Route::resource('/categories' , CategoriesController::class);


});



//Another way to define groups
//Route::middleware('auth')->as('dashboard')->prefix('dashboard')->group(function (){
//
//})
