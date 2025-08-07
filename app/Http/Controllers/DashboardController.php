<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard1()
    {
        return view('dashboard.dashboard1');
    }

    public function dashboard2()
    {
        return view('dashboard.dashboard2');
    }

    public function dashboard3()
    {
        return view('dashboard.dashboard3');
    }


}
