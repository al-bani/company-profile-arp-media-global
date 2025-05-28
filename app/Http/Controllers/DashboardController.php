<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(Auth::check(), Auth::user());
        //  dd(Auth::guard('admin')->check(), Auth::guard('admin')->user());
        return view('admin.dashboard.index');
    }
    public function login()
    {
        return view('admin.login');
    }
}
