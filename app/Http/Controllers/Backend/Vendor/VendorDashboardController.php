<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorDashboardController extends Controller
{

    public function index()
    {
        return view("Backend.vendor.dashboard.index");
    }
}