<?php

namespace App\Http\Controllers;

use App\Models\partner;
use App\Models\perusahaan;
use App\Models\portofolio;
use App\Models\visitor;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(Auth::check(), Auth::user());
        //  dd(Auth::guard('admin')->check(), Auth::guard('admin')->user());
        $perusahaanList = Perusahaan::withCount('portofolio')->whereHas('portofolio')->get();
        $portfolio = [
            'nama' => $nama_perusahaan = $perusahaanList->pluck('nama_perusahaan')->toArray(),
            'jumlah' => $jumlah_portofolio = $perusahaanList->pluck('portofolio_count')->toArray(),
            'project_selesai' => portofolio::where('status_project', 'done')->count()
        ];

        $visitor = [
            'total_visitor' => visitor::sum('jumlah_visit'),
            'total_data' => visitor::count(),
            'data'=> Visitor::orderBy('tanggal', 'desc')->take(7)->get(['tanggal', 'jumlah_visit'])
        ];
        $partner = partner::count();
        $perusahaan = perusahaan::count();

        return view('admin.dashboard.index', compact('visitor', 'partner', 'perusahaan', 'portfolio'));
    }
    public function login()
    {
        return view('admin.login');
    }
}
