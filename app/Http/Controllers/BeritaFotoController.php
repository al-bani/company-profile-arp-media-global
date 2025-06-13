<?php

namespace App\Http\Controllers;

use App\Models\berita_foto;
use App\Http\Requests\Storeberita_fotoRequest;
use App\Http\Requests\Updateberita_fotoRequest;
use Illuminate\Support\Str;

class BeritaFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = berita_foto::latest()->get();
        return view("admin.uploader.uploader", compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storeberita_fotoRequest $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $file = $request->file('image');
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

        // Simpan di public/images
        $file->move(public_path('images'), $filename);

        // Simpan ke DB
        berita_foto::create([
            'foto' => $filename
        ]);

        return redirect()->route('uploader.index')->with('success', 'Gambar berhasil diupload.');
    }

    /**
     * Display the specified resource.
     */
    public function show(berita_foto $berita_foto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(berita_foto $berita_foto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateberita_fotoRequest $request, berita_foto $berita_foto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(berita_foto $berita_foto)
    {
        //
    }
}
