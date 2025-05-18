<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }
    public function login()
    {
        return view('admin.login');
    }
}