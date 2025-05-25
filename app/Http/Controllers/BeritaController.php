<?php

namespace App\Http\Controllers;

use App\Models\berita;
use App\Http\Requests\StoreberitaRequest;
use App\Http\Requests\UpdateberitaRequest;
use App\Models\berita_foto;
use App\Models\perusahaan;
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
        return view('admin.berita.createBerita', [
            'perusahaans' => perusahaan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_berita = 'berita' . '_' . $request->id_perusahaan . '_' . $request->id;
        $request->merge([
            'id_berita' => $id_berita,
        ]);
        berita::create($request->all());


        if ($request->has('foto')) {
            foreach ($request->foto as $item) {
                if (isset($item['foto']) && $item['foto'] instanceof \Illuminate\Http\UploadedFile) {
                    $filename = time() . '_' . $item['foto']->getClientOriginalName();
                    $destination = 'image/upload/foto';
                    $item['foto']->move(public_path($destination), $filename);

                    berita_foto::create([
                        'id_berita' => $request->id_berita,
                        'id_berita_foto' => 'img'.$request->id_berita.$item['judul_foto'],
                        'judul_foto' => $item['judul_foto'] ?? '',
                        'foto' => $destination . '/' . $filename,
                    ]);
                }
            }
        }
        return redirect('/dashboard/berita')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(berita $berita)
    {
        //
    }

    public function edit(berita $berita)
    {
        dd($berita->all());
        return view('admin.berita.berita-edit', [
            'berita' => $berita,
            'perusahaans' => perusahaan::all()
        ]);
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
