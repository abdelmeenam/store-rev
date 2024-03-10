<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Vendor\VendorDashboardController;


Route::group(['middleware' => ['auth:vendor', 'verified'],  'prefix' => 'vendor/dashboard', 'as' => 'vendor.'], function () {

    // Home Dashboard
    Route::get('/', [VendorDashboardController::class, 'index'])->name('home');
});