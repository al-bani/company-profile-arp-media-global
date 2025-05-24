<?php

namespace App\Http\Controllers;

use App\Models\layanan;
use App\Http\Requests\StorelayananRequest;
use App\Http\Requests\UpdatelayananRequest;
use App\Models\perusahaan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layanans = layanan::all();
        return view('admin.layanan.homeLayanan', compact('layanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layanan.createLayanan', [
            'perusahaans' => perusahaan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_layanan = $request->id_perusahaan . '_' . $request->nama_layanan ;
        $request->merge([
            'id_layanan' => $id_layanan,
            // 'password' => bcrypt($request->password) // hash password juga di sini
        ]);
        layanan::create($request->all());
        return redirect('/dashboard/layanan')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(layanan $layanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(layanan $layanan)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
         layanan::where('id', $id)
            ->update($request->except('_token', '_method'));
        return redirect('/dashboard/perusahaan')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        layanan::destroy($id);
        return redirect('/dashboard/layanan')->with('success', 'Data Berhasil dihapus');
    }
    public function edit(layanan $layanan)
    {
        return view('admin.layanan.layanan-edit',[
            'layanan' => $layanan
        ]);
    }
}
