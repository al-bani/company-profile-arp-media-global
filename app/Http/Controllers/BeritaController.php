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

        return view('admin.berita.homeBerita', [
            'beritas' => berita::all(),
            'beritaFotos'=> berita_foto::all()
        ]);
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
        // Buat id_berita yang unik dengan menambahkan timestamp
        $id_berita = 'berita' . '_' . $request->id_perusahaan . '_' . time();
        $request->merge([
            'id_berita' => $id_berita,
            'penulis' => "wd",
        ]);

        // Simpan data berita
        $berita = berita::create($request->all());

        // Handle file uploads
        if ($request->has('foto')) {
            foreach ($request->foto as $item) {
                if (isset($item['foto']) && $item['foto'] instanceof \Illuminate\Http\UploadedFile) {
                    $filename = time() . '_' . $item['foto']->getClientOriginalName();
                    $destination = 'image/upload/foto';
                    $item['foto']->move(public_path($destination), $filename);

                    // Simpan ke tabel berita_foto
                    berita_foto::create([
                        'id_berita' => $berita->id_berita,
                        'id_berita_foto' => 'img' . $berita->id_berita . ($item['judul_foto'] ?? ''),
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
        $berita = berita::findOrFail($id);
        $data = $request->except('_token', '_method', 'foto');

        // Update id_berita if needed
        if ($request->id_perusahaan !== $berita->id_perusahaan) {
            $data['id_berita'] = 'berita' . '_' . $request->id_perusahaan . '_' . $id;
        }

        // Handle file uploads
        if ($request->has('foto')) {
            foreach ($request->foto as $item) {
                if (isset($item['foto']) && $item['foto'] instanceof \Illuminate\Http\UploadedFile) {
                    // Hapus foto lama jika ada
                    $oldFoto = berita_foto::where('id_berita', $berita->id_berita)->first();
                    if ($oldFoto && file_exists(public_path($oldFoto->foto))) {
                        unlink(public_path($oldFoto->foto));
                    }

                    $filename = time() . '_' . $item['foto']->getClientOriginalName();
                    $destination = 'image/upload/foto';
                    $item['foto']->move(public_path($destination), $filename);

                    // Update atau buat baru berita_foto
                    berita_foto::updateOrCreate(
                        ['id_berita' => $berita->id_berita],
                        [
                            'id_berita_foto' => 'img' . $berita->id_berita . ($item['judul_foto'] ?? ''),
                            'judul_foto' => $item['judul_foto'] ?? '',
                            'foto' => $destination . '/' . $filename,
                        ]
                    );
                }
            }
        }

        $berita->update($data);
        return redirect('/dashboard/berita')->with('success', 'Berita berhasil diperbarui');
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