<?php

namespace App\Http\Controllers;

use App\Models\perusahaan;
use App\Http\Requests\StoreperusahaanRequest;
use App\Http\Requests\UpdateperusahaanRequest;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perusahaans = Perusahaan::all(); // Mengambil semua data

        // return view('admin.perusahaan.index', compact('dataPerusahaan'));
        return view('admin.perusahaan.homePerusahaan', compact('perusahaans'));
    }
    public function coba()
    {
        return view('admin.perusahaan.coba');
    }
    public function tambah()
    {
        return view('admin.perusahaan.perusahaan');
    }
    public function edit(perusahaan $perusahaan)
    {
        return view('admin.perusahaan.edit-perusahaan', [
            'perusahaan' => $perusahaan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.perusahaan.createPerusahaan");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        perusahaan::create($request->all());
        return redirect('/dashboard/perusahaan')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(perusahaan $perusahaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(perusahaan $perusahaan)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        perusahaan::where('id', $id)
            ->update($request->except('_token', '_method'));
        return redirect('/dashboard/perusahaan')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        perusahaan::destroy($id);
        return redirect('/dashboard/perusahaan')->with('success', 'Data Berhasil dihapus');
    }
}
