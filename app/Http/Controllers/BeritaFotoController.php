<?php

namespace App\Http\Controllers;

use App\Models\berita_foto;
use App\Http\Requests\Storeberita_fotoRequest;
use App\Http\Requests\Updateberita_fotoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('foto')) {
            $extension = $request->file('foto')->getClientOriginalExtension();
            $randomString = md5(uniqid(rand(), true));
            $filename = time() . '_' . $randomString . '.' . $extension;
            $destination = 'images/upload';
            $request->file('foto')->move(public_path($destination), $filename);
            $data['foto'] = $filename;
        }

        berita_foto::create($data);

        return redirect('/dashboard/uploader')->with('success', 'Gambar berhasil diupload.');
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
    public function destroy($id)
    {
        $berita_foto = berita_foto::findOrFail($id);

        // Hapus file fisik jika ada
        if ($berita_foto->foto && file_exists(public_path('images/upload/' . $berita_foto->foto))) {
            unlink(public_path('images/upload/' . $berita_foto->foto));
        }

        $berita_foto->delete();
        return redirect('/dashboard/uploader')->with('success', 'Gambar berhasil dihapus');
    }
}