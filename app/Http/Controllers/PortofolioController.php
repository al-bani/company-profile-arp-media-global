<?php

namespace App\Http\Controllers;

use App\Models\portofolio;
use App\Http\Requests\StoreportfolioRequest;
use App\Http\Requests\UpdateportfolioRequest;
use App\Models\perusahaan;
use App\Models\portofolio_foto;
use App\Models\timelinePortofolio;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portofolios = portofolio::all();

        return view('admin.portofolio.homePortofolio', compact('portofolios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.portofolio.createPortofolio', [
            'perusahaans' => perusahaan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->foto);
        $id_portofolio =  $request->id_perusahaan . '_' . $request->nama_project;
        $waktu = $request->jam_mulai . '-' . $request->jam_selesai;
        $request->merge([
            'id_portofolio' => $id_portofolio,
            'waktu' => $waktu
        ]);
        portofolio::create($request->all());

        // dd($request->timeline);
        // Simpan timeline jika ada
        if ($request->has('timeline')) {
            foreach ($request->timeline as $item) {
                if (!empty($item['tanggal']) || !empty($item['deskripsi'])) {
                    timelinePortofolio::create([
                        'timeline_id' => 'tl-' . $request->nama_project . $item['tanggal'], // Pastikan ada relasi
                        'id_portofolio' => $request->id_portofolio,
                        'tanggal' => $item['tanggal'],
                        'deskripsi' => $item['deskripsi'],
                    ]);
                }
            }
        }

        if ($request->has('foto')) {
            foreach ($request->foto as $index => $item) {
                if (isset($item['foto']) && $item['foto'] instanceof \Illuminate\Http\UploadedFile) {
                    $filename = time() . '_' . $item['foto']->getClientOriginalName();
                    $destination = 'image/upload/foto';
                    $item['foto']->move(public_path($destination), $filename);

                    portofolio_foto::create([
                        'id_portofolio' => $request->id_portofolio,
                        'id_portofolio_foto' => 'img'.$request->id_portofolio.$item['judul_foto'],
                        'judul_foto' => $item['judul_foto'] ?? '',
                        'foto' => $destination . '/' . $filename,
                    ]);
                }
            }
        }
        return redirect('/dashboard/portofolio')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(portfolio $portfolio)
    // {
    //     //
    // }
    public function edit(portofolio $portofolio)
    {
        return view('admin.portofolio.portofolio-edit', [
            'portofolio' => $portofolio
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        portofolio::where('id', $id)
            ->update($request->except('_token', '_method'));
        return redirect('/dashboard/portofolio')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        portofolio::destroy($id);
        return redirect('/dashboard/portofolio')->with('success', 'Data Berhasil dihapus');
    }
}
