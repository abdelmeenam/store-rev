<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;


class DashboardController extends Controller
{
    public function index()
    {
        return view("back.dashboard.index");
    }
}
