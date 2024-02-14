<?php
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/vendor','as' => 'vendor.','middleware' => ['auth:vendor','verified'] ], function () {
    //Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');



    });

?>


