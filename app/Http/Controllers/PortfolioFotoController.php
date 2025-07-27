<?php

namespace App\Http\Controllers;

use App\Models\portofolio_foto;
use App\Http\Requests\Storeportfolio_fotoRequest;
use App\Http\Requests\Updateportfolio_fotoRequest;
use App\Models\perusahaan;
use Illuminate\Http\Request;

class PortfolioFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portofolios = portofolio_foto::all();
        return view('admin.perusahaan.homePerusahaan', compact('perusahaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.portofolio.create-portofolio');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_portofolio =  $request->id_perusahaan . '_' . $request->nama_portofolio;
        $request->merge([
            'id_portofolio' => $id_portofolio,
        ]);
        portofolio_foto::create($request->all());
        return redirect('/dashboard/portofolio_foto')->with('success', 'Data Berhasil Ditambahkan');
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
    public function edit()
    {
        return view('admin.portofolio.edit-perusahaan', []);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $portofolioFoto = portofolio_foto::findOrFail($id);

        // Hapus file foto jika ada
        if ($portofolioFoto->foto && file_exists(public_path('images/upload/portofolio/' . $portofolioFoto->foto))) {
            unlink(public_path('images/upload/portofolio/' . $portofolioFoto->foto));
        }

        $portofolioFoto->delete();
        return redirect('/dashboard/portofolio_foto')->with('success', 'Data Berhasil dihapus');
    }
}
