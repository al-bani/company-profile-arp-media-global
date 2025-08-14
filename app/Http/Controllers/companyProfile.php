<?php

namespace App\Http\Controllers;

use App\Models\banner;
use App\Models\berita;
use App\Models\berita_foto;
use App\Models\email;
use App\Models\layanan;
use App\Models\partner;
use App\Models\perusahaan;
use App\Models\Faq;
use App\Models\portofolio;
use App\Models\portofolio_foto;
use App\Models\visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class companyProfile extends Controller
{

    public function index()
    {
        // return view('company-profile.homepage');

        $tanggal_hari_ini = date('y-m-d');

        // Ambil data visitor hari ini
        $visitors = visitor::where('tanggal', $tanggal_hari_ini)->first();

        if (!$visitors) {
            // Jika belum ada, buat baru
            $visitors = new visitor();
            $visitors->tanggal = $tanggal_hari_ini;
            $visitors->jumlah_visit = 1;
            $visitors->save();
        } else {
            // Jika sudah ada, tambah jumlah visit
            $visitors->jumlah_visit += 1;
            $visitors->save();
        }

        $id_perusahaan = 'induk_ARP Global Media_2102220087754'; // atau bisa dari session, auth, atau parameter

        // session(['id_perusahaan' => $id_perusahaan]);
        $perusahaan = Perusahaan::with([
            'banner',
            'layanan',
            'partner',
            'berita',
            'portofolio',
            'faq',
            'kbli'
        ])->where('id_perusahaan', $id_perusahaan)->first();

        $banners = $perusahaan->banner;
        $layanans = $perusahaan->layanan;
        $partners = $perusahaan->partner;
        $beritas = $perusahaan->berita;
        $portofolios = $perusahaan->portofolio;
        $faqs = $perusahaan->faq;
        $kblis = $perusahaan->kbli;
        $anak = perusahaan::all();
        // dd($anak);
        // dd($perusahaan->banner);

        // $data_faqs = Faq::all()->map(function ($item) {
        //     return [
        //         'q' => $item->pertanyaan,
        //         'a' => $item->jawaban,
        //     ];
        // })->toArray();

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
            'anaks' => $anak,
            'faqs' => $faqs,
            'kblis' => $kblis
            // 'faqs' => $data_faqs
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
            'portofolio',
            'faq',
            'kbli'
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
        $faqs = $perusahaan->faq;
        $kblis = $perusahaan->kbli;
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
            'anaks' => $anak,
            'faqs' => $faqs,
            'kblis' => $kblis

        ]);
    }




    public function kbli($nama_perusahaan)
    {
        // return view('company-profile.berita');
        if (!$nama_perusahaan) {
            abort(404, 'Perusahaan belum dipilih.');
        }

        $perusahaan = Perusahaan::with('kbli')
            ->where('nama_perusahaan', $nama_perusahaan)
            ->first();

        if (!$perusahaan) {
            abort(404, 'Perusahaan tidak ditemukan.');
        }

        return view('company-profile.detailKbli', [
            'perusahaans' => $perusahaan,
            'kblis' => $perusahaan->kbli
        ]);
    }

    public function berita($nama_perusahaan)
    {
        // return view('company-profile.berita');
        if (!$nama_perusahaan) {
            abort(404, 'Perusahaan belum dipilih.');
        }

        $perusahaan = Perusahaan::with('berita')
            ->where('nama_perusahaan', $nama_perusahaan)
            ->first();


        if (!$perusahaan) {
            abort(404, 'Perusahaan tidak ditemukan.');
        }

        return view('company-profile.berita', [
            'perusahaans' => $perusahaan,
            'beritas' => $perusahaan->berita
        ]);
    }
    public function beritaDetail($nama_perusahaan, $id)
    {
        // return view('company-profile.berita');
        if (!$nama_perusahaan) {
            abort(404, 'Perusahaan belum dipilih.');
        }

        $perusahaan = Perusahaan::with('berita')
            ->where('nama_perusahaan', $nama_perusahaan)
            ->first();

        if (!$perusahaan) {
            abort(404, 'Perusahaan tidak ditemukan.');
        }
        $berita = berita::where('id', $id)
            ->first();

        $beritaAll = berita::all();
        return view('company-profile.detailBerita', [
            'perusahaans' => $perusahaan,
            'beritas' => $berita,
            'beritaAlls' => $beritaAll
        ]);
    }

    public function detail($nama_perusahaan)
    {
        // return view('company-profile.detail');

        if (!$nama_perusahaan) {
            abort(404, 'Perusahaan belum dipilih.');
        }

        $perusahaan = Perusahaan::with('struktur')
            ->where('nama_perusahaan', $nama_perusahaan)
            ->first();

        if (!$perusahaan) {
            abort(404, 'Perusahaan tidak ditemukan.');
        }

        return view('company-profile.detail', [
            'perusahaans' => $perusahaan,
            'strukturs' => $perusahaan->struktur,
        ]);
    }

    public function kontak($nama_perusahaan)
    {
        // return view('company-profile.kontak');
        if (!$nama_perusahaan) {
            abort(404, 'Perusahaan belum dipilih.');
        }

        $perusahaan = Perusahaan::where('nama_perusahaan', $nama_perusahaan)
            ->first();

        if (!$perusahaan) {
            abort(404, 'Perusahaan tidak ditemukan.');
        }

        return view('company-profile.kontak', [
            'perusahaans' => $perusahaan,

        ]);
    }
    public function kontakPost($nama_perusahaan, Request $request)
    {
        if (!$nama_perusahaan) {
            abort(404, 'Perusahaan belum dipilih.');
        }

        $perusahaan = Perusahaan::where('nama_perusahaan', $nama_perusahaan)->first();
        if (!$perusahaan) {
            abort(404, 'Perusahaan tidak ditemukan.');
        }

        $request->merge(['id_perusahaan' => $perusahaan->id_perusahaan]);

        // Tambahkan validasi untuk CAPTCHAs
        $validateData = $request->validate([
            'id_perusahaan' => 'required',
            'nama' => 'required|string',
            'email' => 'required|email',
            'pesan' => 'required|string',
        ]);

        // Verifikasi ke Google

        // Simpan data
        Email::create($validateData);

        return redirect()->back()->with('success', 'Pesan berhasil dikirim.');
    }

    public function layanan($nama_perusahaan)
    {
        if (!$nama_perusahaan) {
            abort(404, 'Perusahaan belum dipilih.');
        }

        $perusahaan = Perusahaan::with('layanan')
            ->where('nama_perusahaan', $nama_perusahaan)
            ->first();

        if (!$perusahaan) {
            abort(404, 'Perusahaan tidak ditemukan.');
        }

        return view('company-profile.layanan', [
            'perusahaans' => $perusahaan,
            'layanans' => $perusahaan->layanan
        ]);
        // return view('company-profile.layanan');
    }
    public function portofolio($nama_perusahaan)
    {
        if (!$nama_perusahaan) {
            abort(404, 'Perusahaan belum dipilih.');
        }

        $perusahaan = Perusahaan::with('portofolio.portofolio_Foto') // relasi eager loading
            ->where('nama_perusahaan', $nama_perusahaan)
            ->first();

        if (!$perusahaan) {
            abort(404, 'Perusahaan tidak ditemukan.');
        }

        $banners = Banner::where('id_perusahaan', $perusahaan->id_perusahaan)->get();


        return view('company-profile.portofolio', [
            'perusahaans' => $perusahaan,
            'portofolios' => $perusahaan->portofolio,
            // Tidak perlu portofolioFotos terpisah, bisa diakses langsung di view:
            // $portofolio->portofolioFoto


        ]);
    }

    public function portofolioDetail($nama_perusahaan, $id)
    {
        if (!$nama_perusahaan) {
            abort(404, 'Perusahaan belum dipilih.');
        }

        $perusahaan = Perusahaan::where('nama_perusahaan', $nama_perusahaan)->first();

        if (!$perusahaan) {
            abort(404, 'Perusahaan tidak ditemukan.');
        }

        $portofolio = Portofolio::with(['portofolio_foto', 'portofolio_timeline'])
            ->where('id', $id)
            ->first();

        if (!$portofolio) {
            abort(404, 'Portofolio tidak ditemukan.');
        }

        return view('company-profile.portofolio-detail', [
            'perusahaans' => $perusahaan,
            'portofolio' => $portofolio
        ]);
    }

    // public function ujiCoba()
    // {
    //     // return view('company-profile.ujicobaHomepage', [
    //     //     'perusahaans' => perusahaan::all(),
    //     //     'banners' => banner::all(),
    //     //     'layanans' => layanan::all(),
    //     //     'partners' => partner::all(),
    //     //     'beritas' => berita::all(),
    //     //     'portofolios' => portofolio::all(),
    //     //     'beritaFotos' => berita_foto::all(),
    //     //     'portofolioFoto' => portofolio_foto::all()
    //     // ]);

    //     // ALTERNATE

    //     $id_perusahaan = 'induk_ARP Global Media_2102220087754'; // atau bisa dari session, auth, atau parameter
    //     $perusahaan = Perusahaan::with([
    //         'banner',
    //         'layanan',
    //         'partner',
    //         'berita.beritaFoto',
    //         'portofolio.portofolioFoto'
    //     ])->where('id_perusahaan', $id_perusahaan)->first();

    //     if (!$perusahaan) {
    //         abort(404, 'Perusahaan tidak ditemukan.');
    //     }

    //     return view('company-profile.ujicobaHomepage', [
    //         'perusahaans' => $perusahaan
    //     ]);
    // }
    public function struktur($nama_perusahaan)
    {
        if (!$nama_perusahaan) {
            abort(404, 'Perusahaan belum dipilih.');
        }

        $perusahaan = Perusahaan::with('struktur')
            ->where('nama_perusahaan', $nama_perusahaan)
            ->first();

        if (!$perusahaan) {
            abort(404, 'Perusahaan tidak ditemukan.');
        }
        return view('company-profile.struktur', [
            'perusahaans' => $perusahaan,
            'strukturs' => $perusahaan->struktur
        ]);
    }

    public function faq($nama_perusahaan)

    {
        if (!$nama_perusahaan) {
            abort(404, 'Perusahaan belum dipilih.');
        }

        $perusahaan = Perusahaan::with('faq')
            ->where('nama_perusahaan', $nama_perusahaan)
            ->first();

        if (!$perusahaan) {
            abort(404, 'Perusahaan tidak ditemukan.');
        }
        return view('company-profile.faq', [
            'perusahaans' => $perusahaan,
            'faqs' => $perusahaan->faq
        ]);
    }
}
