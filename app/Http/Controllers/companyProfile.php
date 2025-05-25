<?php

namespace App\Http\Controllers;

use App\Models\banner;
use App\Models\berita;
use App\Models\berita_foto;
use App\Models\layanan;
use App\Models\partner;
use App\Models\perusahaan;
use App\Models\portofolio;
use App\Models\portofolio_foto;
use Illuminate\Http\Request;

class companyProfile extends Controller
{
    public function index()
    {
        return view('company-profile.homepage');
    }
    public function ujiCoba()
    {
        return view('company-profile.ujicobaHomepage', [
            'perusahaans' => perusahaan::all(),
            'banners' => banner::all(),
            'layanans' => layanan::all(),
            'partners' => partner::all(),
            'beritas' => berita::all(),
            'portofolios' => portofolio::all(),
            'beritaFotos' => berita_foto::all(),
            'portofolioFoto' => portofolio_foto::all()
        ]);

        // ALTERNATE

        // $id_perusahaan = 1; // atau bisa dari session, auth, atau parameter

        // $perusahaan = Perusahaan::with([
        //     'banner',
        //     'layanan',
        //     'partner',
        //     'berita.beritaFoto',         // Nested relasi: berita + foto
        //     'portofolio.portofolioFoto'  // Nested relasi: portofolio + foto
        // ])->findOrFail($id_perusahaan);

        // return view('company-profile.ujicobaHomepage', [
        //     'perusahaans' => $perusahaan
        // ]);
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
