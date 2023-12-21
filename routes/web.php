<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});





//Route::get('/back/dashboard' ,[\App\Http\Controllers\DashboardController::class , 'index'] );




require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';