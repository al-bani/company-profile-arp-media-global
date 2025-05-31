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
        // return view('company-profile.homepage');

        $id_perusahaan = 'induk_ARP Global Media_2102220087754'; // atau bisa dari session, auth, atau parameter

        // session(['id_perusahaan' => $id_perusahaan]);
        $perusahaan = Perusahaan::with([
            'banner',
            'layanan',
            'partner',
            'berita',
            'portofolio.portofolioFoto'
        ])->where('id_perusahaan', $id_perusahaan)->first();

        $banners = $perusahaan->banner;
        $layanans = $perusahaan->layanan;
        $partners = $perusahaan->partner;
        $beritas = $perusahaan->berita;
        $portofolios = $perusahaan->portofolio;
        $anak = perusahaan::all();
        // dd($anak);
        // dd($perusahaan->banner);

        if (!$perusahaan) {
            abort(404, 'Perusahaan tidak ditemukan.');
        }
        return view('company-profile.homePage', [
            'perusahaans' => $perusahaan,
            'banners' => $banners,
            'layanans' => $layanans,
            'partners' => $partners,
            'beritas' => $beritas,
            'portofolios' => $portofolios,
            'anaks' => $anak
        ]);
    }

    public function show($nama_perusahaan)
    {
        // return view('company-profile.homepage');

        // $nama_perusahan = 'induk_ARP Global Media_2102220087754'; // atau bisa dari session, auth, atau parameter
        $perusahaan = Perusahaan::with([
            'banner',
            'layanan',
            'partner',
            'berita',
            'portofolio.portofolioFoto'
        ])->where('nama_perusahaan', $nama_perusahaan)->first();


        if (!$perusahaan) {
            abort(404, 'Perusahaan tidak ditemukan.');
        }
        // Update session jika ingin perusahaan berubah di session juga
        // session(['id_perusahaan' => $perusahaan->id_perusahaan]);

        // dd($perusahaan);
        $banners = $perusahaan->banner;
        $layanans = $perusahaan->layanan;
        $partners = $perusahaan->partner;
        $beritas = $perusahaan->berita;
        $portofolios = $perusahaan->portofolio;
        $anak = perusahaan::all();
        // dd($anak);
        // dd($perusahaan->banner);

        return view('company-profile.homePage', [
            'perusahaans' => $perusahaan,
            'banners' => $banners,
            'layanans' => $layanans,
            'partners' => $partners,
            'beritas' => $beritas,
            'portofolios' => $portofolios,
            'anaks' => $anak
        ]);
    }




    public function berita()
    {
        return view('company-profile.berita');
    }

    public function detail($nama_perusahaan)
    {
        // return view('company-profile.detail');

        if (!$nama_perusahaan) {
            abort(404, 'Perusahaan belum dipilih.');
        }

        $perusahaan = Perusahaan::all()
            ->where('nama_perusahaan', $nama_perusahaan)
            ->first();

        if (!$perusahaan) {
            abort(404, 'Perusahaan tidak ditemukan.');
        }

        return view('company-profile.detail', [
            'perusahaans' => $perusahaan,
        ]);
    }

    public function kontak()
    {
        return view('company-profile.kontak');
    }

    public function layanan()
    {
        return view('company-profile.layanan');
    }
    public function portofolio($nama_perusahaan)
    {
        // return view('company-profile.portofolio');


        if (!$nama_perusahaan) {
            abort(404, 'Perusahaan belum dipilih.');
        }

        $perusahaan = Perusahaan::with('portofolio')
            ->where('nama_perusahaan', $nama_perusahaan)
            ->first();

        if (!$perusahaan) {
            abort(404, 'Perusahaan tidak ditemukan.');
        }

        return view('company-profile.portofolio', [
            'perusahaans' => $perusahaan,
            'portofolios' => $perusahaan->portofolio
        ]);
    }

    public function ujiCoba()
    {
        // return view('company-profile.ujicobaHomepage', [
        //     'perusahaans' => perusahaan::all(),
        //     'banners' => banner::all(),
        //     'layanans' => layanan::all(),
        //     'partners' => partner::all(),
        //     'beritas' => berita::all(),
        //     'portofolios' => portofolio::all(),
        //     'beritaFotos' => berita_foto::all(),
        //     'portofolioFoto' => portofolio_foto::all()
        // ]);

        // ALTERNATE

        $id_perusahaan = 'induk_ARP Global Media_2102220087754'; // atau bisa dari session, auth, atau parameter
        $perusahaan = Perusahaan::with([
            'banner',
            'layanan',
            'partner',
            'berita.beritaFoto',
            'portofolio.portofolioFoto'
        ])->where('id_perusahaan', $id_perusahaan)->first();

        if (!$perusahaan) {
            abort(404, 'Perusahaan tidak ditemukan.');
        }

        return view('company-profile.ujicobaHomepage', [
            'perusahaans' => $perusahaan
        ]);
    }
    public function struktur()
    {
        return view('company-profile.struktur');
    }
}
