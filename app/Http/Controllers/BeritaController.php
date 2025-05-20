<?php

namespace App\Http\Controllers;

use App\Models\berita;
use App\Http\Requests\StoreberitaRequest;
use App\Http\Requests\UpdateberitaRequest;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beritas = berita::all();
        return view('admin.berita.homeBerita', compact('beritas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.berita.createBerita');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        berita::create($request->all());
        return redirect('/dashboard/berita')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(berita $berita)
    {
        //
    }

    public function edit()
    {
        return view('admin.berita.berita-edit');
    }


    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(berita $berita)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        berita::where('id', $id)
            ->update($request->except('_token', '_method'));
        return redirect('/dashboard/berita')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        berita::destroy($id);
        return redirect('/dashboard/berita')->with('success', 'Data Berhasil dihapus');
    }
}
