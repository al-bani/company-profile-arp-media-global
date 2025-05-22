<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class companyProfile extends Controller
{
    public function index()
    {
        return view('company-profile.homepage');
    }

    public function berita()
    {
        return view('company-profile.berita');
    }

    public function detail()
    {
        return view('company-profile.detail');
    }

    public function kontak()
    {
        return view('company-profile.kontak');
    }

    public function layanan()
    {
        return view('company-profile.layanan');
    }
    public function portofolio()
    {
        return view('company-profile.portofolio-detail');
    }

    public function struktur()
    {
        return view('company-profile.struktur');
    }

}
