<?php

use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class , 'index'])->name('home');





//Route::get('/back/dashboard' ,[\App\Http\Controllers\DashboardController::class , 'index'] );




require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
