<?php

namespace App\Http\Controllers;

use App\Models\partner;
use App\Models\perusahaan;
use App\Models\visitor;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(Auth::check(), Auth::user());
        //  dd(Auth::guard('admin')->check(), Auth::guard('admin')->user());

        $total_visit = visitor::sum('jumlah_visit');
        $count_perusahaan = perusahaan::count();
        $count_partner = partner::count();

        $dashboard_information = [
            'total_visit' => $total_visit,
            'count_perusahaan' => $count_perusahaan,
            'count_partner' => $count_partner,
        ];

        return view('admin.dashboard.index', compact('dashboard_information',));
    }
    public function login()
    {
        return view('admin.login');
    }
}
